<?php
namespace App\Models;

use Foxdb\Model;
use Foxdb\DB;

class Category extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'categories';

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  protected $timestamps = true;

  /**
   * The attributes that are visible in output
   *
   * @var array
   */
  protected $visible = [
    'id',
    'name',
    'slug',
    'description',
    'parent_id',
    'image',
    'icon',
    'status',
    'order',
    'meta_title',
    'meta_description',
    'meta_keywords',
    'created_at',
    'updated_at'
  ];

  /**
   * Get all active categories
   *
   * @return array
   */
  public static function active()
  {
    return self::where('status', 'active')->orderBy('order')->get();
  }

  /**
   * Get root categories (no parent)
   *
   * @return array
   */
  public static function roots()
  {
    return self::whereNull('parent_id')->orderBy('order')->get();
  }

  /**
   * Get child categories of a parent
   *
   * @param int $parentId
   * @return array
   */
  public static function children($parentId)
  {
    return self::where('parent_id', $parentId)->orderBy('order')->get();
  }

  /**
   * Get category with its parent information
   *
   * @param int $id
   * @return object|false
   */
  public static function withParent($id)
  {

    return DB::table('categories as c')
      ->leftJoin('categories as p', 'c.parent_id', '=', 'p.id')
      ->select(
        'c.*',
        'p.name as parent_name',
        'p.slug as parent_slug'
      )
      ->where('c.id', $id)
      ->first();
  }

  /**
   * Get all categories with their parent information
   *
   * @return array
   */
  public static function allWithParent()
  {

    return DB::query('SELECT
    c.*,
    p.name AS parent_name,
    p.slug AS parent_slug
FROM categories AS c
LEFT JOIN categories AS p
    ON c.parent_id = p.id
ORDER BY c.`order`;
', [], true);
    // return DB::table('categories as c')
    //   ->leftJoin('categories as p', 'c.parent_id', '=', 'p.id')
    //   ->select(
    //     'c.*',
    //     'p.name as parent_name',
    //     'p.slug as parent_slug'
    //   )
    //   ->orderBy('c.order')
    //   ->get();
  }

  /**
   * Get category hierarchy (tree structure)
   *
   * @return array
   */
  public static function tree()
  {
    $categories = self::orderBy('order')->get();
    return self::buildTree($categories);
  }

  /**
   * Build tree structure from flat array
   *
   * @param array $categories
   * @param int|null $parentId
   * @return array
   */
  private static function buildTree($categories, $parentId = null)
  {
    $branch = [];

    foreach ($categories as $category) {
      if ($category->parent_id == $parentId) {
        $children = self::buildTree($categories, $category->id);
        
        if ($children) {
          $category->children = $children;
        }
        
        $branch[] = $category;
      }
    }

    return $branch;
  }

  /**
   * Get category by slug
   *
   * @param string $slug
   * @return object|false
   */
  public static function findBySlug($slug)
  {
    return self::where('slug', $slug)->first();
  }

  /**
   * Count products in category
   *
   * @param int $categoryId
   * @return int
   */
  public static function countProducts($categoryId)
  {
    return DB::table('products')
      ->where('category_id', $categoryId)
      ->count();
  }

  /**
   * Generate unique slug from name
   *
   * @param string $name
   * @param int|null $excludeId
   * @return string
   */
  public static function generateSlug($name, $excludeId = null)
  {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
    $originalSlug = $slug;
    $counter = 1;

    while (true) {
      $query = self::where('slug', $slug);
      
      if ($excludeId) {
        $query->where('id', '!=', $excludeId);
      }
      
      $exists = $query->first();
      
      if (!$exists) {
        break;
      }
      
      $slug = $originalSlug . '-' . $counter;
      $counter++;
    }

    return $slug;
  }

  /**
   * Check if category has children
   *
   * @param int $categoryId
   * @return bool
   */
  public static function hasChildren($categoryId)
  {
    $count = self::where('parent_id', $categoryId)->count();
    return $count > 0;
  }

  /**
   * Get breadcrumb path for category
   *
   * @param int $categoryId
   * @return array
   */
  public static function breadcrumb($categoryId)
  {
    $breadcrumbs = [];
    $category = self::find($categoryId);

    while ($category) {
      array_unshift($breadcrumbs, [
        'id' => $category->id,
        'name' => $category->name,
        'slug' => $category->slug
      ]);

      if ($category->parent_id) {
        $category = self::find($category->parent_id);
      } else {
        break;
      }
    }

    return $breadcrumbs;
  }
}