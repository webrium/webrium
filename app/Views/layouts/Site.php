<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">

<head>
  <!-- Document metadata -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Page title -->
  <title>Welcome</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
  <link rel="shortcut icon" href="/favicon.ico" />

  <!-- Main app assets (Vite: CSS & JS) -->
  @raw( vite_assets() )
</head>

<body class="bg-base-200">
  <!-- Main content area -->
  <main class="p-6">
    <!-- Page content injected here -->
    @yield('content')
  </main>
</body>

</html>