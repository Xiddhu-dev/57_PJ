<?php
session_start();
include 'conn.php';
include 'function.php';
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    delproduct();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product | Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    * {
      font-family: 'Inter', sans-serif;
    }

    body {
        background: linear-gradient(135deg,rgb(12, 53, 103),rgb(254, 254, 255));
        min-height: 100vh;
      color: white;
      padding: 30px;
    }

    .admin-header {
      
      padding: 20px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }

    .admin-header h2 {
      margin: 0;
      font-weight: 600;
      font-size: 26px;
      color: #343a40;
    }

    .admin-header span {
      color: #007bff;
      font-weight: 600;
    }

    .admin-table {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }

    table th {
      background: #007bff;
      color: #fff;
    }

    table td, table th {
      padding: 16px;
      text-align: center;
      vertical-align: middle;
    }

    table tr:hover {
      background-color: #f2f6fc;
    }

    .btn-sm i {
      color: #007bff;
      transition: 0.2s;
    }

    .btn-sm:hover i {
      color: #0056b3;
      transform: scale(1.1);
    }

    .img-thumbnails {
      border-radius: 10px;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      table {
        font-size: 14px;
      }
    }
    .product{
        margin-left:1250px ;
        
    }
    .product a{
        text-decoration:none;
    }
       .actions {
      margin-top: 0px;
      text-align: center;
      animation: fadeIn 1.2s ease-out forwards;
      
    }

    .actions a {
      margin-left:1200px;
      padding: 12px 22px;
      border-radius: 30px;
      background: #0056b3;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      transition: background 0.3s ease;
      margin-bottom:40px;
    }

    .actions a:hover {
      background: #117a8b;
    }
  </style>
</head>
<body>
    <?php include 'header.php'; ?>
  <div class="admin-header">

    <h2>
      Welcome admin,
      <span>
        <?php
        if (isset($_SESSION['admin'])) {
            echo $_SESSION['admin'];
        } else {
            header('Location: login.php');
            exit();
        }
        ?>
      </span>
    </h2>
     <div class="actions">
  <a href="addproduct.php"><i class="material-icons" style="font-size:20px">vertical_align_bottom &nbsp;</i>Add Product</a>
</div>
  </div>

  <div class="admin-table p-3">
    <div class="mb-3 text-end">
  <input type="text" id="searchInput" class="form-control w-25 d-inline-block" placeholder="Search products..." onkeyup="filterTable()" />
</div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Photo</th>
          <th>ID</th>
          <th>Product Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT products.product_id, products.product_name, products.price, products.qty, products.photo,
                  category.category_name
                  FROM products
                  JOIN category ON products.category_id = category.category_id
                  ORDER BY products.product_id DESC";
        $go_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($go_query)) {
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $category_name = $row['category_name'];
            $price = $row['price'];
            $qty = $row['qty'];
            $photo = $row['photo'];

            echo "<tr>";
            echo "<td><img src='../photo/{$photo}' class='img img-thumbnails' width='80' height='80'></td>";
            echo "<td>{$product_id}</td>";
            echo "<td>{$product_name}</td>";
            echo "<td>{$category_name}</td>";
            echo "<td>{$price}</td>";
            echo "<td>{$qty}</td>";
            echo "<td>
                    <a href='edit.php?action=edit&pid={$product_id}' class='btn btn-sm'><i class='fa fa-edit' style='font-size:22px'></i></a>
                    <a href='productlist.php?action=delete&pid={$product_id}' class='btn btn-sm'><i class='fa fa-trash-o' style='font-size:22px'></i></a>
                  </td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  
<script>
function filterTable() {
  const input = document.getElementById("searchInput");
  const filter = input.value.toLowerCase();
  const table = document.getElementById("productTable");
  const rows = table.getElementsByTagName("tr");

  for (let i = 1; i < rows.length; i++) {
    let text = rows[i].innerText.toLowerCase();
    rows[i].style.display = text.includes(filter) ? "" : "none";
  }
}
</script>
</body>
</html>
