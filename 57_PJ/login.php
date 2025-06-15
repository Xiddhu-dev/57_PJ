<?php
session_start();
include 'conn.php';
include 'function.php';

if (isset($_POST['btnlogin'])) {
    $admin_name = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password'];
    $errors = [];

    if (empty($admin_name)) {
        $errors['username'] = "Username is required";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM admin WHERE admin_name = '$admin_name' LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) {
                $_SESSION['admin'] = $admin_name;
                header('Location: dashboard.php');
                exit;
            } else {
                echo "<script>alert('Wrong password.');</script>";
            }
        } else {
            echo "<script>alert('Admin not found.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden;
      font-family: 'Segoe UI', sans-serif;
    }

    body::before {
      content: '';
      position: absolute;
      width: 200%;
      height: 200%;
      background: #16213e;
      background-size: 400% 400%;
      animation: gradientMove 50s ease infinite;
      z-index: -2;
    }

    body::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
      background-size: 50px 50px;
      animation: floatDots 60s linear infinite;
      z-index: -1;
    }

    .bubbles {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
    }

    .bubbles span {
      position: absolute;
      display: block;
      width: 20px;
      height: 20px;
      background: rgba(255, 255, 255, 0.2);
      bottom: -150px;
      animation: rise 20s infinite ease-in;
      border-radius: 50%;
    }

    .bubbles span:nth-child(odd) {
      width: 30px;
      height: 30px;
      background: rgba(255, 255, 255, 0.1);
    }

    @keyframes rise {
      0% {
        transform: translateY(0);
        opacity: 0;
      }
      50% {
        opacity: 1;
      }
      100% {
        transform: translateY(-1000px);
        opacity: 0;
      }
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    @keyframes floatDots {
      0% { background-position: 0 0; }
      100% { background-position: 100px 100px; }
    }

    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes floatCard {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .login-card {
      backdrop-filter: blur(20px);
      background-color: rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 0 0.2rem rgba(0,194,255,0.25);
      border-radius: 16px;
      padding: 2rem;
      animation: fadeInUp 1s ease-in-out, floatCard 6s ease-in-out infinite;
    }

    .form-control, .form-label {
      background: transparent;
      color: white;
    }

    .form-control::placeholder {
      color: #ddd;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.1);
      color: white;
      border-color: #4ade80;
      box-shadow: 0 0 0 0.2rem rgba(74, 222, 128, 0.25);
    }

    .btn-light {
      background-color: #00c2ff;
      color: white;
      font-weight: bold;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-light:hover {
      background-color: #00a2d4;
    }

    .form-check-label, a {
      color: #ccc;
    }

    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: white;
      text-align: center;
      margin-bottom: 1rem;
      animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
      from {
        text-shadow: 0 0 5px #fff, 0 0 10px #00c2ff, 0 0 15px #00c2ff;
      }
      to {
        text-shadow: 0 0 10px #fff, 0 0 20px #00eaff, 0 0 30px #00eaff;
      }
    }
  </style>
</head>
<body>
  <div class="bubbles">
    <?php for ($i = 1; $i <= 18; $i++): ?>
      <span style="left:<?= rand(5, 100) ?>%; animation-delay: <?= rand(0, 18) ?>s;"></span>
    <?php endfor; ?>
  </div>

  <div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
      <div class="login-card">
        <div class="logo">57 Fashion shop</div>
        <h2 class="text-center text-white mb-4"> Login</h2>
        <form action="" method="post">
          <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="mb-3 position-relative">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword()">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-eye" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8a13.134 13.134 0 0 1-1.66 2.043C11.88 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5z"/>
              </svg>
            </span>
          </div>
          <div class="d-grid">
            <button type="submit" name="btnlogin" class="btn btn-light">Log In</button>
          </div>
        </form>
        <p class="text-white text-center mt-3">Don't have an account? <a href="signup.php" class="text-secondary">Sign up</a></p>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById("password");
      const icon = document.getElementById("eyeIcon");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.innerHTML = `
          <path d="M13.359 11.238..."/>
          <path d="M4.706 3.293..."/>
        `;
      } else {
        passwordField.type = "password";
        icon.innerHTML = `
          <path d="M16 8s-3-5.5..."/>
          <path d="M8 5.5a2.5 2.5..."/>
        `;
      }
    }
  </script>
</body>
</html>
