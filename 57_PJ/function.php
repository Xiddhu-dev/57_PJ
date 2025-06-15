<?php
function addCategory()
{
    global $connection;
    $category_name = $_POST['category_name'];

    if ($category_name == "") {
        echo "<script>window.alert('Please Enter Category Name.')</script>";
    } else {
        $query = "SELECT * FROM category WHERE category_name='$category_name'";
        $go_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($go_query);
        if ($count > 0) {
            echo "<script>window.alert('Category already exists')</script>";
        } else {
            $query = "INSERT INTO category(category_name) VALUES('$category_name')";
            $go_query = mysqli_query($connection, $query);
            if (!$go_query) {
                die("QUERY FAILED: " . mysqli_error($connection));
            } else {
                echo "<script>window.alert('Category successfully inserted')</script>";
            }
        }
    }
}

function updatecategory()
{
    global $connection;
    $category_name = $_POST['updatecatname'];
    $category_id = $_GET['cid'];
    $query = "UPDATE category SET category_name='$category_name' WHERE category_id='$category_id'";
    $go_query = mysqli_query($connection, $query);
    if (!$go_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
    header("location:category.php");
}

function delcategory()
{
    global $connection;
    $category_id = $_GET['cid'];
    $query = "DELETE FROM category WHERE category_id='$category_id'";
    $go_query = mysqli_query($connection, $query);
    header("location:category.php");
}
function add_user()
{
    global $connection;

    $user_name = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $user_role = $_POST['usertype'];

    if ($password != $cpassword) {
        echo "<script>window.alert('Password and Confirm Password must be the same')</script>";
    } elseif ($user_name != "" && $password != "") {
        $query = "SELECT * FROM users WHERE user_name='$user_name'";
        $ch_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($ch_query);

        if ($count > 0) {
            echo "<script>window.alert('This user already exists')</script>";
        } else {
            $hashvalue = password_hash($password, PASSWORD_DEFAULT); // secure hash
            $query = "INSERT INTO users(user_name, password, user_role, created_at)
                      VALUES('$user_name','$hashvalue','$user_role',NOW())";
            $go_query = mysqli_query($connection, $query);

            if (!$go_query) {
                die('QUERY FAILED: ' . mysqli_error($connection));
            } else {
                header("location:userlist.php");
                exit();
            }
        }
    }
}


// function add_user()
// {
//     global $connection;
//     $customer_name = $_POST['username'];
//     $password = $_POST['password'];
//     $cpassword = $_POST['confirmpassword'];

//     if ($password != $cpassword) {
//         echo "<script>window.alert('Password and Confirm Password must be the same')</script>";
//     } elseif ($customer_name != "" && $password != "") {
//         $query = "SELECT * FROM customers WHERE customer_name='$customer_name'";
//         $ch_query = mysqli_query($connection, $query);
//         $count = mysqli_num_rows($ch_query);
//         if ($count > 0) {
//             echo "<script>window.alert('This admin already exists')</script>";
//         } else {
//             $hashvalue = md5($password);
//             $user_role = $_POST['usertype'];
//             $query = "INSERT INTO customers(customer_name, password, created_at) VALUES('$customer_name','$hashvalue','')";
//             $go_query = mysqli_query($connection, $query);
//             if (!$go_query) {
//                 die('QUERY FAILED: ' . mysqli_error($connection));
//             } else {
//                 header("location:userlist.php");
//             }
//         }
//     }
// }

function deluser()
{
    global $connection;
    $user_id = $_GET['uid'];
    $query = "DELETE FROM users WHERE user_id='$user_id'";
    $go_query = mysqli_query($connection, $query);
    header("location:userlist.php");
}

function admin_login()
{
    global $connection;
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];
    $hpass = md5($password);

    $query = "SELECT * FROM admin WHERE admin_name='$admin_name' AND password='$password' AND role='admin'";
    $go_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($go_query);

    if ($count == 1) {
        $_SESSION['admin'] = $admin_name;
        header('location:dashboard.php');
    } else {
        echo "<script>window.alert('Invalid Admin Name or Password')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

function add_product()
{
    global $connection;

    $product_name = $_POST['productsname'];
    $category_id = $_POST['catname'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $photo = $_FILES['photo']['name'];

    // Validation
    if (!is_numeric($price)) {
        echo "<script>alert('Please enter a numeric value for Price');</script>";
        return;
    }

    if (!is_numeric($qty)) {
        echo "<script>alert('Please enter a numeric value for Quantity');</script>";
        return;
    }

    if (empty($photo)) {
        echo "<script>alert('Please choose a product image');</script>";
        return;
    }

    if (!empty($product_name)) {
        // Check for duplicate product
        $check_query = "SELECT * FROM products WHERE product_name = '$product_name'";
        $check_result = mysqli_query($connection, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('This product already exists');</script>";
            return;
        }

        // Move photo & insert
        $target_dir = "../photo/";
        $target_file = $target_dir . basename($photo);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            $insert_query = "INSERT INTO products (product_name, category_id, price, qty, photo)
                             VALUES ('$product_name', '$category_id', '$price', '$qty', '$photo')";
            $result = mysqli_query($connection, $insert_query);

            if (!$result) {
                die("QUERY FAILED: " . mysqli_error($connection));
            } else {
                header("Location: productlist.php");
                exit();
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    }
}


function delproduct()
{
    global $connection;
    $pid = $_GET['pid'];
    $query = "DELETE FROM products WHERE product_id='$pid'";
    $go_query = mysqli_query($connection, $query);
    header("location:productlist.php");
}

function updateproduct()
{
    global $connection;
    $product_id = $_GET['pid'];
    $product_name = $_POST['productname'];
    $category_id = $_POST['catname'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $photo = $_FILES['photo']['name'];

    if (!$photo) {
        $query = "UPDATE products SET product_name='$product_name', category_id='$category_id', price='$price', qty='$qty' 
                  WHERE product_id='$product_id'";
    } else {
        $query = "UPDATE products SET product_name='$product_name', category_id='$category_id', price='$price', qty='$qty', photo='$photo' 
                  WHERE product_id='$product_id'";
    }

    $go_query = mysqli_query($connection, $query);
    if (!$go_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    } else {
        if ($photo) {
            move_uploaded_file($_FILES['photo']['tmp_name'], '../photo/' . $photo);
        }
    }

    header("location:productlist.php");
}
// function add_product()
// {
//     global $connection;

//     // Fixed names to match form input
//     $product_name = $_POST['productname'];
//     $category_id = $_POST['catname'];
//     $price = $_POST['price'];
//     $qty = $_POST['qty'];
//     $photo = $_FILES['photo']['name'];
//     $tmp_photo = $_FILES['photo']['tmp_name'];

//     // Validations
//     if (!is_numeric($price)) {
//         echo "<script>window.alert('Please enter a numeric value for Price')</script>";
//         return;
//     }

//     if (!is_numeric($qty)) {
//         echo "<script>window.alert('Please enter a numeric value for Quantity')</script>";
//         return;
//     }

//     if (empty($photo)) {
//         echo "<script>window.alert('Please choose a product image')</script>";
//         return;
//     }

//     if (!empty($product_name) && !empty($photo)) {
//         $query = "SELECT * FROM products WHERE product_name='$product_name'";
//         $ch_query = mysqli_query($connection, $query);
//         $count = mysqli_num_rows($ch_query);

//         if ($count > 0) {
//             echo "<script>window.alert('This product already exists')</script>";
//         } else {
//             $query = "INSERT INTO products (product_name, category_id, price, qty, photo)
//                       VALUES ('$product_name', '$category_id', '$price', '$qty', '$photo')";

//             $go_query = mysqli_query($connection, $query);

//             if (!$go_query) {
//                 die("QUERY FAILED: " . mysqli_error($connection));
//             } else {
//                 move_uploaded_file($tmp_photo, '../photo/' . $photo);
//                 header("Location: productlist.php");
//                 exit();
//             }
//         }
//     }
// }

?>
