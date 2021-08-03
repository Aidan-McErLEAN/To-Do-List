<html>
<head>
  <!-- BOOTSTRAP -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- CSS AND CLOCK SCRIPT -->
  <link href="/clock.css" rel="stylesheet">
  <link href="/app.css" rel="stylesheet">
  <script defer src="clock.js"></script>
</head>

<!-- NAV BAR -->
<body>
  <nav class="navbar navbar-dark bg-primary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a href="/"><img src="/images/logo.png" alt="TOO THE DO'S LOGO"></a>
      </div>
    </nav>
  </nav>

  <div class="container">
    <div class="row">
      <!-- FIRST COLUMN -->
      <div class="col1">
        @yield ('first col')
      </div>
      <!-- SECOND COLUMN -->
      <div class="col2 order-5">
        @yield ('third col')
      </div>
      <!-- THIRD COLUMN -->
      <div class="col3 order-1">
        @yield ('second col')
      </div>
    </div>
  </div>

@yield ('content')
</body>

</html>
