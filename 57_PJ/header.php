<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Header</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    .navbar-custom {
      background: linear-gradient(135deg,rgb(12, 53, 103),rgb(90, 90, 91));
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
      
    }
   

body {
  margin: 0;
  padding: 0;
}

    .navbar-brand {
      font-weight: bold;
      font-size: 22px;
      color: #fff !important;
    }
    .nav-link {
      color: #fff !important;
      font-weight: 500;
      margin-right: 12px;
    }
    .nav-link:hover {
      color: #e2e6ea !important;
    }
    .dropdown-menu {
      min-width: 150px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">
      <i class="fas fa-store"></i> 57FashionAdmin
    </a>
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="productlist.php"><i class="fas fa-box"></i> Products</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-cog"></i> Admin
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
            <li><a class="dropdown-item" href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
