<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_POST['btnaddproduct']))
{
    //fucntion 
    add_product();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<style>
     body {
      background: linear-gradient(135deg,rgb(12, 53, 103),rgb(254, 254, 255));
      min-height: 100vh;
      color: white;
    }
</style>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Welcome admin,
                    <span class="text-info">
                        <?php
                        if(isset($_SESSION['admin']))
                        {
                            echo $_SESSION['admin'];
                        }
                        else
                        {
                            $_SESSION['admin']='';
                        }
                        ?>
                    </span>
                </h2>
            </div>
        </div>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info text-center text-white">Add Product</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="productsname" class="form-label">Product Name</label>
                                <input type="text" name="productsname" id="" class="form-control" required> 
                            </div>
                            <div class="mb-3">
                                <label for="catname" class="form-label">Category Name</label>
                                <select name="catname" id="" class="form-control">
                                    <?php
                                    $query="SELECT * FROM category";//1 Asus
                                    $go_query=mysqli_query($connection,$query);
                                    while($row=mysqli_fetch_array($go_query))
                                    {
                                        $category_id=$row['category_id'];//1,2
                                        $category_name=$row['category_name'];//Asus,Lenovo
                                        echo "<option value={$category_id}>{$category_name}</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="text" name="price" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="text" name="qty" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Image Upload</label>
                                <input type="file" name="photo" id="" class="form-control">
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Add Product" class="btn btn-outline-info" name="btnaddproduct">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>