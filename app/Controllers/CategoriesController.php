<?php
namespace App\Controllers;

use App\Models\Category;
use Zog\Zog;
use Foxdb\DB;

class CategoriesController
{
  /**
   * Get categories data for API
   */
  public function indexData()
  {
    try {
      // Get all categories with parent information
      $categories = Category::allWithParent();

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

      return $this->jsonResponse([
        'ok' => true,
        'categories' => $categories,
        'stats' => $stats
      ]);
    } catch (\Exception $e) {
      error_log("Error in CategoriesController@indexData: " . $e->getMessage());
      return $this->jsonResponse([
        'ok' => false,
        'message' => 'Failed to load categories'
      ], 500);
    }
  }

  /**
   * Display categories page
   */
  public function index()
  {
    return Zog::render('page_loaders/admin/categories_loader.php', [
      'title' => 'Categories Management',
      'pageTitle' => 'Categories'
    ]);
  }

  /**
   * Get parent categories for form (API)
   */
  public function getParents()
  {
    try {
      $excludeId = $_POST['exclude_id'] ?? null;
      
      $query = Category::orderBy('name');
      
      if ($excludeId) {
        $query->where('id', '!=', $excludeId);
      }
      
      $categories = $query->get();

      return $this->jsonResponse([
        'ok' => true,
        'categories' => $categories
      ]);
    } catch (\Exception $e) {
      error_log("Error in CategoriesController@getParents: " . $e->getMessage());
      return $this->jsonResponse([
        'ok' => false,
        'message' => 'Failed to load parent categories'
      ], 500);
    }
  }

  /**
   * Get single category (API)
   */
  public function show($id)
  {
    try {
      $category = Category::find($id);

      if (!$category) {
        return $this->jsonResponse([
          'ok' => false,
          'message' => 'Category not found'
        ], 404);
      }

      return $this->jsonResponse([
        'ok' => true,
        'category' => $category
      ]);
    } catch (\Exception $e) {
      error_log("Error in CategoriesController@show: " . $e->getMessage());
      return $this->jsonResponse([
        'ok' => false,
        'message' => 'Failed to load category'
      ], 500);
    }
  }

  /**
   * Show create category page
   */
  public function create()
  {
    return Zog::render('page_loaders/admin/category_form_loader.php', [
      'title' => 'Add New Category',
      'pageTitle' => 'Add New Category'
    ]);
  }

  /**
   * Show edit category page
   */
  public function edit($id)
  {
    return Zog::render('page_loaders/admin/category_form_loader.php', [
      'title' => 'Edit Category',
      'pageTitle' => 'Edit Category'
    ]);
  }

  /**
   * Store new category (API)
   */
  public function store()
  {
    try {
      // Get JSON data
      $data = $this->getJsonInput();
      
      // Validate required fields
      $errors = $this->validateCategory($data);
      
      if (!empty($errors)) {
        return $this->jsonResponse([
          'ok' => false,
          'errors' => $errors,
          'message' => 'Validation failed'
        ], 422);
      }

      // Generate slug if not provided
      $slug = $data['slug'] ?? Category::generateSlug($data['name']);

      // Check if slug already exists
      if (Category::where('slug', $slug)->first()) {
        return $this->jsonResponse([
          'ok' => false, 
          'errors' => ['slug' => 'This slug already exists'],
          'message' => 'Slug already exists'
        ], 422);
      }

      // Prepare data
      $insertData = [
        'name' => trim($data['name']),
        'slug' => $slug,
        'description' => $data['description'] ?? null,
        'parent_id' => !empty($data['parent_id']) ? (int)$data['parent_id'] : null,
        'image' => $data['image'] ?? null,
        'icon' => $data['icon'] ?? null,
        'status' => $data['status'] ?? 'active',
        'order' => isset($data['order']) ? (int)$data['order'] : 0,
        'meta_title' => $data['meta_title'] ?? null,
        'meta_description' => $data['meta_description'] ?? null,
        'meta_keywords' => $data['meta_keywords'] ?? null
      ];

      // Insert category
      $id = DB::table('categories')->insertGetId($insertData);

      return $this->jsonResponse([
        'ok' => true,
        'message' => 'Category created successfully',
        'id' => $id
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@store: " . $e->getMessage());
      return $this->jsonResponse([
        'ok' => false,
        'message' => 'Failed to create category: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Update category (API)
   */
  public function update($id)
  {
    try {
      $category = Category::find($id);

      if (!$category) {
        return $this->jsonResponse([
          'ok' => false,
          'message' => 'Category not found'
        ], 404);
      }

      // Get JSON data
      $data = $this->getJsonInput();

      // Validate required fields
      $errors = $this->validateCategory($data);
      
      if (!empty($errors)) {
        return $this->jsonResponse([
          'ok' => false,
          'errors' => $errors,
          'message' => 'Validation failed'
        ], 422);
      }

      // Generate slug if not provided
      $slug = $data['slug'] ?? Category::generateSlug($data['name'], $id);

      // Check if slug already exists (excluding current category)
      $existingSlug = Category::where('slug', $slug)->where('id', '!=', $id)->first();
      if ($existingSlug) {
        return $this->jsonResponse([
          'ok' => false, 
          'errors' => ['slug' => 'This slug already exists'],
          'message' => 'Slug already exists'
        ], 422);
      }

      // Check for circular parent reference
      $parentId = !empty($data['parent_id']) ? (int)$data['parent_id'] : null;
      if ($parentId && $this->isCircularReference($id, $parentId)) {
        return $this->jsonResponse([
          'ok' => false,
          'errors' => ['parent_id' => 'Cannot set category as its own descendant'],
          'message' => 'Circular reference detected'
        ], 422);
      }

      // Prepare data
      $updateData = [
        'name' => trim($data['name']),
        'slug' => $slug,
        'description' => $data['description'] ?? null,
        'parent_id' => $parentId,
        'image' => $data['image'] ?? null,
        'icon' => $data['icon'] ?? null,
        'status' => $data['status'] ?? 'active',
        'order' => isset($data['order']) ? (int)$data['order'] : 0,
        'meta_title' => $data['meta_title'] ?? null,
        'meta_description' => $data['meta_description'] ?? null,
        'meta_keywords' => $data['meta_keywords'] ?? null
      ];

      // Update category
      DB::table('categories')->where('id', $id)->update($updateData);

      return $this->jsonResponse([
        'ok' => true,
        'message' => 'Category updated successfully'
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@update: " . $e->getMessage());
      return $this->jsonResponse([
        'ok' => false,
        'message' => 'Failed to update category: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Delete category (API)
   */
  public function delete($id)
  {
    try {
      $category = Category::find($id);

      if (!$category) {
        return $this->jsonResponse([
          'ok' => false,
          'message' => 'Category not found'
        ], 404);
      }

      // Check if category has children
      if (Category::hasChildren($id)) {
        return $this->jsonResponse([
          'ok' => false,
          'message' => 'Cannot delete category with sub-categories. Delete sub-categories first.'
        ], 422);
      }

      // Check if category has products
      $productsCount = Category::countProducts($id);
      if ($productsCount > 0) {
        return $this->jsonResponse([
          'ok' => false,
          'message' => "Cannot delete category with {$productsCount} products. Move or delete products first."
        ], 422);
      }

      // Delete category
      DB::table('categories')->where('id', $id)->delete();

      return $this->jsonResponse([
        'ok' => true,
        'message' => 'Category deleted successfully'
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@delete: " . $e->getMessage());
      return $this->jsonResponse([
        'ok' => false,
        'message' => 'Failed to delete category: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Bulk actions (API)
   */
  public function bulkAction()
  {
    try {
      $data = $this->getJsonInput();
      $action = $data['action'] ?? null;
      $ids = $data['ids'] ?? [];

      if (!$action || empty($ids)) {
        return $this->jsonResponse([
          'ok' => false,
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
            'ok' => false,
            'message' => 'Unknown action'
          ], 422);
      }

      return $this->jsonResponse([
        'ok' => true,
        'message' => "{$affected} categories {$action}d successfully",
        'affected' => $affected
      ]);

    } catch (\Exception $e) {
      error_log("Error in CategoriesController@bulkAction: " . $e->getMessage());
      return $this->jsonResponse([
        'ok' => false,
        'message' => 'Failed to perform bulk action: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Get category tree (API)
   */
  public function tree()
  {
    try {
      $tree = Category::tree();
      return $this->jsonResponse([
        'ok' => true,
        'data' => $tree
      ]);
    } catch (\Exception $e) {
      error_log("Error in CategoriesController@tree: " . $e->getMessage());
      return $this->jsonResponse([
        'ok' => false,
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
   * Get JSON input from request body
   */
  private function getJsonInput()
  {
    $json = file_get_contents('php://input');
    return json_decode($json, true) ?? [];
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
}