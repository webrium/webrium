@raw(
  layout('layouts/admin.php', 'pages/admin/categories.php', [
    'title' => 'Categories Management',
    'pageTitle' => 'Categories',
    'stats' => $stats ?? [],
    'categories' => $categories ?? []
  ])
)