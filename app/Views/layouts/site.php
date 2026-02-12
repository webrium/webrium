<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Welcome</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
  <link rel="shortcut icon" href="/favicon.ico" />

  <!-- Main app assets -->
  @raw( vite_assets() )
</head>

<body class="bg-base-200">
  <main class="p-6">
    @yield('content')
  </main>
</body>

</html>