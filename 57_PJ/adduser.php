<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_POST['btnadduser'])) {
    add_user();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add User - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
  <style>
    body {
       background: linear-gradient(135deg,rgb(12, 53, 103),rgb(254, 254, 255));
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      color: #f3f4f6;
    }

    h3 span {
      color: #007bff;
    }

    .card {
      background-color: #111827;
      border: 1px solid #374151;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.4);
    }

    .card-header {
      background-color: #2563eb;
      color: white;
      font-size: 1.3rem;
      font-weight: 600;
    }

    .form-control {
      background-color: #1f2937;
      border: 1px solid #374151;
      color: #f9fafb;
    }

    .form-control::placeholder {
      color: #9ca3af;
    }

    .form-label {
      font-weight: 500;
    }

    .btn-outline-warning {
      color: #facc15;
      border-color: #facc15;
    }

    .btn-outline-warning:hover {
      background-color: #facc15;
      color: #1f2937;
    }

    select.form-control option {
      background:rgb(234, 236, 238);
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12 mb-4">
        <h3>
          Welcome admin,
          <span>
            <?php
            if(isset($_SESSION['admin'])) {
              echo $_SESSION['admin'];
            } else {
              $_SESSION['admin']='';
            }
            ?>
          </span>
        </h3>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">➕ Add User/Admin</div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="mb-3">
                <label class="form-label"><i class="fa fa-user" style="font-size:23px"></i> Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required>
              </div>
              <div class="mb-3">
                <label class="form-label"><i class='fas fa-fingerprint' style='font-size:23px'></i> Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
              </div>
              <div class="mb-3">
                <label class="form-label"><i class='fas fa-shield-alt' style='font-size:23px'></i> Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Re-enter password" required>
              </div>
              <div class="mb-3">
                <label class="form-label"><i class='fas fa-id-card' style='font-size:23px'></i> User Type</label>
                <select name="usertype" class="form-control text-center" required>
                  <option value="">-- Select Role --</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
              </div>
              <div class="d-grid">
                <input type="submit" value="Add User" class="btn btn-outline-warning" name="btnadduser">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
