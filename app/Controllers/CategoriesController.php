<?php
namespace App\Controllers;

use App\Models\Category;
use Zog\Zog;
use Foxdb\DB;

class CategoriesController
{

  public function indexData()
  {
    $categories = Category::allWithParent();
    // return 'ok';
    // Calculate statistics
    $stats = [
      'total' => Category::count(),
      'active' => Category::where('status', 'active')->count(),
      'inactive' => Category::where('status', 'inactive')->count(),
      'root' => Category::whereNull('parent_id')->count()
    ];

    // Add products count for each category
    foreach ($categories as $category) {
      $category->products_count = Category::countProducts($category->id);
    }

    return [
      'categories' => $categories,
      'stats' => $stats
    ];
  }
  /**
   * Display all categories
   */
  public function index()
  {

    return Zog::render('page_loaders/admin/categories_loader.php', $this->indexData());
  }

  /**
   * Show create category form
   */
  public function create()
  {
    try {
      // Get all categories except current one (for parent selection)
      $parentCategories = Category::orderBy('name')->get();

      return Zog::render('page_loaders/admin/category_form_loader.php', [
        'parentCategories' => $parentCategories
      ]);
    } catch (\Exception $e) {
      error_log("Error in CategoriesController@create: " . $e->getMessage());
      return $this->errorResponse('Failed to load form');
    }
  }

  /**
   * Store new category
   */
  public function store()
  {
    try {
      // Validate required fields
      $errors = $this->validateCategory($_POST);

      if (!empty($errors)) {
        return $this->jsonResponse(['success' => false, 'errors' => $errors], 422);
      }

      // Generate slug if not provided
      $slug = $_POST['slug'] ?? Category::generateSlug($_POST['name']);

      // Check if slug already exists
      if (Category::where('slug', $slug)->first()) {
        return $this->jsonResponse([
          'success' => false,
          'errors' => ['slug' => 'This slug already exists']
        ], 422);
      }

      // Prepare data
      $data = [
        'name' => trim($_POST['name']),
        'slug' => $slug,
        'description' => $_POST['description'] ?? null,
        'parent_id' => !empty($_POST['parent_id']) ? (int) $_POST['parent_id'] : null,
        'image' => $_POST['image'] ?? null,
        'icon' => $_POST['icon'] ?? null,
        'status' => $_POST['status'] ?? 'active',
        'order' => isset($_POST['order']) ? (int) $_POST['order'] : 0,
        'meta_title' => $_POST['meta_title'] ?? null,
        'meta_description' => $_POST['meta_description'] ?? null,
        'meta_keywords' => $_POST['meta_keywords'] ?? null
      ];

      // Insert category
      $id = DB::table('categories')->insertGetId($data);

      return $this->jsonResponse([
        'success' => true,
        'message' => 'Category created successfully',
        'id' => $id,
        'redirect' => '/admin/categories'
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@store: " . $e->getMessage());
      return $this->jsonResponse([
        'success' => false,
        'message' => 'Failed to create category: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Show edit category form
   */
  public function edit($id)
  {
    try {
      $category = Category::find($id);

      if (!$category) {
        return $this->errorResponse('Category not found', 404);
      }

      // Get all categories except current one (for parent selection)
      $parentCategories = Category::where('id', '!=', $id)->orderBy('name')->get();

      return Zog::render('page_loaders/admin/category_form_loader.php', [
        'category' => $category,
        'parentCategories' => $parentCategories
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@edit: " . $e->getMessage());
      return $this->errorResponse('Failed to load category');
    }
  }

  /**
   * Update category
   */
  public function update($id)
  {
    try {
      $category = Category::find($id);

      if (!$category) {
        return $this->jsonResponse([
          'success' => false,
          'message' => 'Category not found'
        ], 404);
      }

      // Validate required fields
      $errors = $this->validateCategory($_POST);

      if (!empty($errors)) {
        return $this->jsonResponse(['success' => false, 'errors' => $errors], 422);
      }

      // Generate slug if not provided
      $slug = $_POST['slug'] ?? Category::generateSlug($_POST['name'], $id);

      // Check if slug already exists (excluding current category)
      $existingSlug = Category::where('slug', $slug)->where('id', '!=', $id)->first();
      if ($existingSlug) {
        return $this->jsonResponse([
          'success' => false,
          'errors' => ['slug' => 'This slug already exists']
        ], 422);
      }

      // Check for circular parent reference
      $parentId = !empty($_POST['parent_id']) ? (int) $_POST['parent_id'] : null;
      if ($parentId && $this->isCircularReference($id, $parentId)) {
        return $this->jsonResponse([
          'success' => false,
          'errors' => ['parent_id' => 'Cannot set category as its own descendant']
        ], 422);
      }

      // Prepare data
      $data = [
        'name' => trim($_POST['name']),
        'slug' => $slug,
        'description' => $_POST['description'] ?? null,
        'parent_id' => $parentId,
        'image' => $_POST['image'] ?? null,
        'icon' => $_POST['icon'] ?? null,
        'status' => $_POST['status'] ?? 'active',
        'order' => isset($_POST['order']) ? (int) $_POST['order'] : 0,
        'meta_title' => $_POST['meta_title'] ?? null,
        'meta_description' => $_POST['meta_description'] ?? null,
        'meta_keywords' => $_POST['meta_keywords'] ?? null
      ];

      // Update category
      DB::table('categories')->where('id', $id)->update($data);

      return $this->jsonResponse([
        'success' => true,
        'message' => 'Category updated successfully',
        'redirect' => '/admin/categories'
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@update: " . $e->getMessage());
      return $this->jsonResponse([
        'success' => false,
        'message' => 'Failed to update category: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Delete category
   */
  public function delete($id)
  {
    try {
      $category = Category::find($id);

      if (!$category) {
        return $this->jsonResponse([
          'success' => false,
          'message' => 'Category not found'
        ], 404);
      }

      // Check if category has children
      if (Category::hasChildren($id)) {
        return $this->jsonResponse([
          'success' => false,
          'message' => 'Cannot delete category with sub-categories. Delete sub-categories first.'
        ], 422);
      }

      // Check if category has products
      $productsCount = Category::countProducts($id);
      if ($productsCount > 0) {
        return $this->jsonResponse([
          'success' => false,
          'message' => "Cannot delete category with {$productsCount} products. Move or delete products first."
        ], 422);
      }

      // Delete category
      DB::table('categories')->where('id', $id)->delete();

      return $this->jsonResponse([
        'success' => true,
        'message' => 'Category deleted successfully'
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@delete: " . $e->getMessage());
      return $this->jsonResponse([
        'success' => false,
        'message' => 'Failed to delete category: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Bulk actions
   */
  public function bulkAction()
  {
    try {
      $action = $_POST['action'] ?? null;
      $ids = $_POST['ids'] ?? [];

      if (!$action || empty($ids)) {
        return $this->jsonResponse([
          'success' => false,
          'message' => 'Invalid request'
        ], 422);
      }

      $affected = 0;

      switch ($action) {
        case 'activate':
          $affected = DB::table('categories')
            ->whereIn('id', $ids)
            ->update(['status' => 'active']);
          break;

        case 'deactivate':
          $affected = DB::table('categories')
            ->whereIn('id', $ids)
            ->update(['status' => 'inactive']);
          break;

        case 'delete':
          // Check each category before deleting
          foreach ($ids as $id) {
            if (Category::hasChildren($id) || Category::countProducts($id) > 0) {
              continue; // Skip categories with children or products
            }
            DB::table('categories')->where('id', $id)->delete();
            $affected++;
          }
          break;

        default:
          return $this->jsonResponse([
            'success' => false,
            'message' => 'Unknown action'
          ], 422);
      }

      return $this->jsonResponse([
        'success' => true,
        'message' => "{$affected} categories {$action}d successfully",
        'affected' => $affected
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@bulkAction: " . $e->getMessage());
      return $this->jsonResponse([
        'success' => false,
        'message' => 'Failed to perform bulk action: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Get category tree (AJAX)
   */
  public function tree()
  {
    try {
      $tree = Category::tree();
      return $this->jsonResponse([
        'success' => true,
        'data' => $tree
      ]);
    } catch (\Exception $e) {
      error_log("Error in CategoriesController@tree: " . $e->getMessage());
      return $this->jsonResponse([
        'success' => false,
        'message' => 'Failed to load category tree'
      ], 500);
    }
  }

  /**
   * Validate category data
   */
  private function validateCategory($data)
  {
    $errors = [];

    if (empty($data['name'])) {
      $errors['name'] = 'Category name is required';
    } elseif (strlen($data['name']) > 255) {
      $errors['name'] = 'Category name must be less than 255 characters';
    }

    if (!empty($data['slug']) && !preg_match('/^[a-z0-9-]+$/', $data['slug'])) {
      $errors['slug'] = 'Slug can only contain lowercase letters, numbers, and hyphens';
    }

    if (!empty($data['description']) && strlen($data['description']) > 500) {
      $errors['description'] = 'Description must be less than 500 characters';
    }

    if (!empty($data['meta_title']) && strlen($data['meta_title']) > 255) {
      $errors['meta_title'] = 'Meta title must be less than 255 characters';
    }

    if (!empty($data['meta_description']) && strlen($data['meta_description']) > 500) {
      $errors['meta_description'] = 'Meta description must be less than 500 characters';
    }

    return $errors;
  }

  /**
   * Check for circular parent reference
   */
  private function isCircularReference($categoryId, $parentId)
  {
    if ($categoryId == $parentId) {
      return true;
    }

    $parent = Category::find($parentId);

    while ($parent && $parent->parent_id) {
      if ($parent->parent_id == $categoryId) {
        return true;
      }
      $parent = Category::find($parent->parent_id);
    }

    return false;
  }

  /**
   * Return JSON response
   */
  private function jsonResponse($data, $status = 200)
  {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
  }

  /**
   * Return error page
   */
  private function errorResponse($message, $code = 500)
  {
    http_response_code($code);
    return Zog::render('pages/error.php', [
      'title' => 'Error',
      'message' => $message,
      'code' => $code
    ]);
  }
}