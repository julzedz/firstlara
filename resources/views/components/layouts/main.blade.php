<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Product</title>
</head>
<body>
  <header>
    @yield('header')
  </header>
  <main>
    @yield('content')
  </main>
  <footer>
    <h2>This is the footer. 2025</h2>
  </footer>
</body>
</html>