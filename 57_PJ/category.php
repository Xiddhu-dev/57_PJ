<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'conn.php'; //database
include 'function.php'; // function def:

if (isset($_POST['btnaddcategory'])) {
    addCategory();
}
if (isset($_POST['btnupdatecategory'])) {
    updatecategory();
}
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    delcategory();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <style>
        body {
         background: linear-gradient(135deg,rgb(12, 53, 103),rgb(254, 254, 255));
            min-height: 100vh;
            color: white;
        }
        .card {
            background-color: #1e1e2f;
            border: none;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.4);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-3px);
        }
        .form-control, .btn {
            border-radius: 10px;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .table {
            color: #fff;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #2c2c3e;
        }
        .table-primary {
            background-color: #007bff !important;
        }
        .table-primary td {
            color: #fff;
        }
        a.btn {
            margin: 0 3px;
        }
        .btn-sm i {
      color: #007bff;
      transition: 0.2s;
    }

    .btn-sm:hover i {
      color: #0056b3;
      transform: scale(1.1);
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
        <div class="row">
            <!-- Add Category -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-info text-center text-white">New Category</div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Add Category" name="btnaddcategory" class="btn btn-outline-info">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Update Category (if editing) -->
                <?php 
                if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                    $category_id = $_GET['cid'];
                    $query = "SELECT * FROM category WHERE category_id='$category_id'";
                    $go_query = mysqli_query($connection, $query);
                    while ($out = mysqli_fetch_array($go_query)) {
                        $category_name = $out['category_name'];
                ?>
                <div class="card mb-4">
                    <div class="card-header bg-warning text-center text-dark">Update Category</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="updatecatname" class="form-control" value="<?php echo $category_name; ?>" required>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Update Category" name="btnupdatecategory" class="btn btn-outline-warning">
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>

            <!-- Display Categories Table -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="text-center  mb-3">All Categories</h5>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr class="table-primary">
                                <td>ID</td>
                                <td>Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM category";
                        $go_query = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_array($go_query)) {
                            $category_id = $row['category_id'];
                            $category_name = $row['category_name'];
                            echo "<tr>
                                <td>{$category_id}</td>
                                <td>{$category_name}</td>
                                <td>
                                    <a href='category.php?action=edit&cid={$category_id}' class='btn btn-sm'><i class='fa fa-edit' style='font-size:22px'></i></a>
                                    <a href='category.php?action=delete&cid={$category_id}' class='btn btn-sm'><i class='fa fa-trash-o' style='font-size:22px'></i></a>
                                </td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
