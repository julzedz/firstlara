<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Product</title>
</head>
<body>
  <h1>Product11</h1>
  <form action={{ route("formsubmitted") }} method="post">
    @csrf
    <label for="fullname">Full Name:</label>
    <input class="" type="text" id="fullname" name="fullname" placeholder="Name" required>
    <br>
    <label for="email">E-mail:</label>
    <input type="text" id="email" name="email" placeholder="Email" required>
    <br>
    <button type="submit">Submit</button>
  </form>
</body>
</html>