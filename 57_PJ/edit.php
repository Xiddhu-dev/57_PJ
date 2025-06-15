<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_GET['action'])&& $_GET['action']=='edit')
{
   $pid=$_GET['pid'];
   $query="Select * from products where product_id='$pid'";
   $go_query=mysqli_query($connection,$query);
   while($row=mysqli_fetch_array($go_query))
   {
        $productid=$row['product_id'];//1
        $productname=$row['product_name'];//Asus Zenbook S 14
        $product_cat_id=$row['category_id'];//1
        $price=$row['price'];//5000000
        $qty=$row['qty'];//5
        $photo=$row['photo'];//zenbook.jpg
   }
}
if(isset($_POST['btnupdateproduct']))
{
       //function call
       updateproduct();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Welcome admin,
                    <span class="text-danger">
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
        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info text-center text-white">Update Product</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text"  name="productname" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="catnane" class="form-label">Catgory Name</label>
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
                                <input type="text" value="<?php echo $price ?>" name="price" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="text" value="<?php echo $qty ?>" name="qty" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="file" name="photo" id="" class="form-control">
                                <input type="hidden" name="existing-photo" class="form-control" value="<?php echo $photo ?>">
                                <img src='../photo/<?php echo $photo ?>' width='100' height='100'>
                                <p>Current Image:<?php echo $photo; ?></p>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Update Product" class="btn btn-outline-info" name="btnupdateproduct">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>