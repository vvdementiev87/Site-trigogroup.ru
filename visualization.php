<?php
include 'include/controller.php';
$session_username = $_SESSION['user_name'];
$session_role = $_SESSION['role'];
if(empty($_SESSION['user_name'])){
    header("location:login.php");
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Main menu</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css"

</head>

<body>




<div class="container">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><span class='glyphicon glyphicon-user' aria-hidden='true'></span>
            <?php echo $session_username . " ($session_role)"; ?> <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="#logout" data-toggle="modal"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout</a></li>
            <li><a href="#changepass" data-toggle="modal"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Change Password</a></li>
        </ul>
    </div>
    <div class="category-wrap">
        <h2>Main menu</h2>
         <ul>
         <li><a href="graph.php">Graph</a></li>
         <li><a href="graph1.php">MGraph 1</a></li>
         <li><a href="graph2.php">Graph 2</a></li>
         </ul>
    </div>
    <div id="logout" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Logout</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                    <div class="alert alert-danger">Are you Sure you want to logout
                        <strong>
                            <?php echo $_SESSION['user_name']; ?>?
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <a href="logout.php">
                            <button type="button" class="btn btn-danger">YES </button>
                        </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="changepass" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Current:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="current_password" required placeholder="Current Password" autofocus autocomplete="off"> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">New:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="new_password" required placeholder="New Password" autocomplete="off"> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Repeat:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="repeat_password" required placeholder="Repeat Password" autocomplete="off"> </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="change_pass">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
if(isset($_POST['change_pass'])){
    $sql = "SELECT password FROM tbl_user WHERE username='$session_username'";
    $result = $conn->query($sql);
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];
    $repeat_password=$_POST['repeat_password'];
    $hash_new_password= password_hash($new_password, PASSWORD_DEFAULT);

    $hash_current_password= password_hash($current_password, PASSWORD_DEFAULT);
    echo $hash_current_password;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo $row['password'];
            if(!password_verify($current_password, $row['password'])){
                echo "<script>window.alert('Invalid Password');</script>";
                $passwordErr = '<div class="alert alert-warning"><strong>Password!</strong> Invalid.</div>';
            } elseif($new_password != $repeat_password) {
                echo "<script>window.alert('Password Not Match!');</script>";
                $passwordErr = '<div class="alert alert-warning"><strong>Password!</strong> Not Match.</div>';
            } else{
                $sql = "UPDATE tbl_user SET password='$hash_new_password' WHERE username='$session_username'";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>window.alert('Password Successfully Updated');</script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
    } else {
        $usernameErr = '<div class="alert alert-danger"><strong>Username</strong> Not Found.</div>';
        $username = "";
    }
}




?>



</body>
</html>