<?php
include 'conn.php';
include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Registration</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet" />
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      background: #0f172a;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow: hidden;
    }

    .bubbles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    .bubbles span {
      position: absolute;
      display: block;
      width: 20px;
      height: 20px;
      background: rgba(255, 255, 255, 0.08);
      bottom: -150px;
      border-radius: 50%;
      animation: rise 20s infinite ease-in;
    }

    .bubbles span:nth-child(1) { left: 10%; width: 40px; height: 40px; animation-duration: 15s; }
    .bubbles span:nth-child(2) { left: 20%; width: 20px; height: 20px; animation-duration: 18s; }
    .bubbles span:nth-child(3) { left: 30%; width: 25px; height: 25px; animation-duration: 16s; }
    .bubbles span:nth-child(4) { left: 50%; width: 35px; height: 35px; animation-duration: 21s; }
    .bubbles span:nth-child(5) { left: 65%; width: 15px; height: 15px; animation-duration: 22s; }
    .bubbles span:nth-child(6) { left: 75%; width: 30px; height: 30px; animation-duration: 19s; }
    .bubbles span:nth-child(7) { left: 85%; width: 20px; height: 20px; animation-duration: 23s; }
    .bubbles span:nth-child(8) { left: 95%; width: 35px; height: 35px; animation-duration: 17s; }

    @keyframes rise {
      0% { transform: translateY(0) scale(1); opacity: 0.2; }
      100% { transform: translateY(-1000px) scale(1.5); opacity: 0; }
    }

    .form-box {
      background-color: rgba(17, 24, 39, 0.9);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
      width: 100%;
      max-width: 700px;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    h2 {
      background: linear-gradient(to right, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-align: center;
      margin-bottom: 1rem;
    }

    .form-control {
      background-color: #1e293b;
      border: none;
      color: #fff;
    }

    .form-control:focus {
      background-color: #1e293b;
      color: #fff;
      box-shadow: 0 0 0 0.2rem rgba(0, 194, 255, 0.25);
    }

    .form-label {
      color: #ddd;
    }

    .btn-primary {
      background: linear-gradient(to right, #0072ff, #00c6ff);
      border: none;
      font-weight: bold;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #00c6ff, #0072ff);
    }

    a {
      color: #00c6ff;
    }

    a:hover {
      color: #fff;
    }

    .text-danger {
      font-size: 0.9rem;
    }

    .container {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      z-index: 2;
    }

    .row.g-3 .col-md-6 {
      margin-bottom: 1rem;
    }

    @media(max-width: 767px) {
      .row.g-3 {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
<?php
$errors = [];
$admin_name = $password = $cpassword = $email = $phone = $address = '';

if (isset($_POST['register'])) {
    $admin_name = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);

    if (empty($admin_name)) $errors['admin_name'] = "Username is required";
    if (empty($password)) $errors['password'] = "Password is required";
    if ($password !== $cpassword) $errors['cpassword'] = "Passwords do not match";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Invalid email";
    if (empty($phone)) $errors['phone'] = "Phone number is required";
    if (empty($address)) $errors['address'] = "Address is required";

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO admin (admin_name, password, email, phone, address) 
                  VALUES ('$admin_name', '$hashed_password', '$email', '$phone', '$address')";
        $run = mysqli_query($connection, $query);
        if ($run) {
            echo "<script>alert('Admin registered successfully!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Registration failed. Try again.');</script>";
        }
    }
}
?>

<div class="bubbles">
  <?php for ($i = 0; $i < 8; $i++): ?>
    <span></span>
  <?php endfor; ?>
</div>

<div class="container">
  <div class="form-box">
    <h2>Admin Register</h2>
    <form method="post">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($admin_name) ?>">
          <span class="text-danger"><?php echo $errors['admin_name'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email) ?>">
          <span class="text-danger"><?php echo $errors['email'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password">
          <span class="text-danger"><?php echo $errors['password'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
          <label class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="cpassword">
          <span class="text-danger"><?php echo $errors['cpassword'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone</label>
          <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone) ?>">
          <span class="text-danger"><?php echo $errors['phone'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($address) ?>">
          <span class="text-danger"><?php echo $errors['address'] ?? '' ?></span>
        </div>
      </div>
      <div class="mt-3">
        <button type="submit" class="btn btn-primary w-100" name="register">Register</button>
      </div>
      <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
    </form>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>
</html>
