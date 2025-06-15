<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_GET['action']) &&  $_GET['action']=='delete')
    {
       deluser();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER | LIST</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   
   <style>
        body {
      background: linear-gradient(135deg,rgb(12, 53, 103),rgb(254, 254, 255));
      min-height: 100vh;
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
    </style>
</head>

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
        <div class="row mt-5 ">
            <table class="table table-condensed">
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Role</td>
                    <td>Action</td>
                </tr>
                <?php
                $query="SELECT * FROM users ORDER BY user_id DESC";
                $go_query=mysqli_query($connection,$query);
                while($row=mysqli_fetch_array($go_query))
                {
                    $user_id=$row['user_id'];
                    $user_name=$row['user_name'];
                    $user_role=$row['user_role'];
                    echo "<tr>";
                    echo "<td>{$user_id}</td>";
                    echo "<td>{$user_name}</td>";
                    echo "<td>{$user_role}</td>";
                    echo "<td>
                    
                    
                    <a href='userlist.php?action=delete&uid={$user_id}'><i class='fa fa-trash-o' style='font-size:20px'></i></a>
                    
                    </td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <div class="actions">
            <a href="adduser.php">Add User</a>
 
            </div>
        </div>
    </div>
</body>
</html>