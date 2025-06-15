<?php
session_start();
include 'conn.php';

// Ensure admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

$admin_name = $_SESSION['admin'];
$query = "SELECT * FROM admin WHERE admin_name = '$admin_name'";
$result = mysqli_query($connection, $query);

if (!$result || mysqli_num_rows($result) !== 1) {
    echo "Admin not found.";
    exit();
}

$admin = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg,rgb(12, 53, 103),rgb(254, 254, 255));
        min-height: 100vh;
      color: #f3f4f6;
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      color: white;
    }

    .profile-card {
      background: linear-gradient(135deg,rgb(148, 170, 216),rgb(15, 44, 79));
      border-radius: 12px;
      border: 1px solid #374151;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      padding: 2rem;
      margin-top: 50px;
    }

    .profile-pic {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #2563eb;
      margin-bottom: 1rem;
    }

    .btn-edit {
      background-color: #2563eb;
      border: none;
    }

    .btn-edit:hover {
      background-color: #1e40af;
    }

    .info-label {
      font-weight: bold;
      color: #9ca3af;
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="profile-card text-center">
        <img src="https://i.pravatar.cc/150?img=1" class="profile-pic" alt="Admin Avatar">
        <h3><?= htmlspecialchars($admin['admin_name']) ?></h3>
        <p class="text-muted">Administrator</p>

        <hr class="text-secondary">

        <div class="text-start mt-4">
          <p><span class="info-label">Admin name:</span> <?= htmlspecialchars($admin['admin_name']) ?></p>
          <?php if (isset($admin['email'])): ?>
            <p><span class="info-label">Email:</span> <?= htmlspecialchars($admin['email']) ?></p>
          <?php endif; ?>
          <p><span class="info-label">Phone No. :</span> <?= $admin['phone'] ?? 'N/A' ?></p>
           <p><span class="info-label">Address:</span> <?= $admin['address'] ?? 'N/A' ?></p>
        </div>

        <a href="edit_profile.php" class="btn btn-edit mt-3">Edit Profile</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>
