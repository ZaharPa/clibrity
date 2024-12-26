<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Clibrity</title>

    @vite('resources/js/app.js')
    @routes
    @inertiaHead
  </head>
  <body class="bg-amber-800">
    @inertia
  </body>
</html>
