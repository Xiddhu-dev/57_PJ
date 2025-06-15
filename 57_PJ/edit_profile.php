<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$admin = $_SESSION['admin'];
$query = "SELECT * FROM admin WHERE admin_name = '$admin' LIMIT 1";
$result = mysqli_query($connection, $query);
$adminData = mysqli_fetch_assoc($result);

// Handle profile update
if (isset($_POST['btnUpdate'])) {
    $newName = $_POST['admin_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $updateQuery = "UPDATE admin 
                    SET admin_name = '$newName', email = '$email', phone = '$phone', address = '$address' 
                    WHERE admin_name = '$admin'";
    mysqli_query($connection, $updateQuery);
    $_SESSION['admin'] = $newName;
    header("Location: profile.php");
    exit;
}

// Handle password change
if (isset($_POST['btnChangePassword'])) {
    $oldPass = $_POST['old_password'];
    $newPass = $_POST['new_password'];

    if (password_verify($oldPass, $adminData['password'])) {
        $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);
        $passQuery = "UPDATE admin SET password = '$hashedNewPass' WHERE admin_name = '$admin'";
        mysqli_query($connection, $passQuery);
        echo "<script>alert('Password updated successfully');</script>";
    } else {
        echo "<script>alert('Incorrect old password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg,rgb(225, 230, 236),rgb(2, 34, 101));
      min-height: 100vh;
      color: white;
    }
    .card {
      background-color: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
    }
    .form-control {
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      border: none;
    }
    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.15);
      color: white;
      border-color: #4ade80;
      box-shadow: 0 0 0 0.25rem rgba(74, 222, 128, 0.2);
    }
    .btn-primary {
      background-color: #4ade80;
      border: none;
    }
  </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h3 class="text-center text-white mb-4">👤 Admin Profile</h3>

      <div class="card p-4">
        <form action="" method="POST">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="admin_name" class="form-control" value="<?= $adminData['admin_name']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $adminData['email']; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= $adminData['phone']; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="<?= $adminData['address']; ?>">
          </div>
          <button type="submit" name="btnUpdate" class="btn btn-primary w-100">Update Profile</button>
        </form>
      </div>

      <div class="card p-4 mt-4">
        <h5>Change Password</h5>
        <form action="" method="POST">
          <div class="mb-3">
            <label class="form-label">Old Password</label>
            <input type="password" name="old_password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="new_password" class="form-control" required>
          </div>
          <button type="submit" name="btnChangePassword" class="btn btn-primary w-100">Change Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
