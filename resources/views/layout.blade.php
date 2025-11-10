<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="/" class="navbar-brand">Employee Manager</a>
      <div class="navbar-nav">
        <a href="/employees" class="nav-link">Employees</a>
        <a href="/departments" class="nav-link">Departments</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
