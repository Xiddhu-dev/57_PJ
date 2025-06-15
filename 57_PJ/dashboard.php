<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    

    body {
        background: linear-gradient(135deg,rgb(12, 53, 103),rgb(254, 254, 255));
      color: #333;
      min-height: 100vh;
      padding: 40px 20px;
    }

    h2 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 40px;
      font-weight: 600;
    }

    h2 span {
      color: #007bff;
    }

    .dashboard {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 30px;
      animation: fadeIn 0.8s ease-out forwards;
    }

    .card {
      background-color: #fff;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.05);
      padding: 20px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      top:50px;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .card img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      margin-bottom: 15px;
      border-radius: 12px;
    }
    .card img {
  width: 100%;
  /* max-width: 120px; */
  height: 120px;
  object-fit: cover;
  margin: 0 auto 15px;
  display: block;
  border-radius: 12px;
}


    .card h3 {
      font-size: 1.1rem;
      color: #555;
      margin-bottom: 10px;
    }

    .card a {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 20px;
      background: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 25px;
      font-weight: 600;
      font-size: 0.95rem;
      transition: background 0.3s ease;
    }

    .card a:hover {
      background-color: #0056b3;
    }

    .badge {
      background-color: #343a40;
      padding: 4px 12px;
      border-radius: 999px;
      margin-left: 8px;
      font-size: 0.8rem;
      color: white;
    }

    .actions {
      margin-top: 150px;
      text-align: center;
      animation: fadeIn 1.2s ease-out forwards;
    }

    .actions a {
      margin: 0 10px;
      padding: 12px 22px;
      border-radius: 30px;
      background: #17a2b8;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      transition: background 0.3s ease;
    }

    .actions a:hover {
      background: #117a8b;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 600px) 
      h2 {
        font-size: 1.5rem;
      }
   
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3>Welcome Admin,
                    <span class="text-info">
                        <?php echo $_SESSION['admin'] ?? ''; ?>
                    </span>
                </h3>
            </div>
        </div>

    <div class="dashboard">
        <div class="card">
            <img src="photo/category.png" alt="Category" />
            <h3>Categories</h3>
            <a href="category.php">View Details <span class="badge">5</span></a>
        </div>
        <div class="card">
            <img src="photo/product.png" alt="Products" />
            <h3>Products</h3>
            <a href="productlist.php">View Details <span class="badge">5</span></a>
        </div>
        <div class="card">
            <img src="photo/user.png" alt="Users" />
            <h3>Users</h3>
            <a href="userlist.php">View Details <span class="badge">5</span></a>
        </div>
        <div class="card">
            <img src="photo/order.png" alt="Orders" />
            <h3>Orders</h3>
            <a href="order.php">View Details <span class="badge">5</span></a>
        </div>
    </div>

    <div class="actions">
    <a href="adduser.php"><i class='fas fa-user-plus' style='font-size:20px'></i>&nbsp;Add User</a>
    <a href="addproduct.php"><i class="material-icons" style="font-size:20px">vertical_align_bottom &nbsp;</i>Add Product</a>
    </div>

</body>
</html>
