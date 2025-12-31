@raw(
  layout('layouts/admin.php', 'pages/admin/category_form.php', [
    'title' => ($category ?? null) ? 'Edit Category' : 'Add New Category',
    'pageTitle' => ($category ?? null) ? 'Edit Category' : 'Add New Category',
    'category' => $category ?? null,
    'parentCategories' => $parentCategories ?? []
  ])
)