<?php
include 'include/controller.php';
$usernameErr = $passwordErr="";
$session_username = $_SESSION['user_name'];
$session_role = $_SESSION['role'];
if(empty($_SESSION['user_name'])){
    header("location:login.php");
}
?>
<title>Register</title>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register user</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="container">
    <br>



    <div class="card mx-auto" style="width: 30rem; position: relative; left: 50%">
        <!--<form id="register_form" method="post"  autocomplete="off">
        <button type="submit" name="add" class="btn btn-primary">Add</button>
        </form> -->
        <div class="card-body">
            <h5 class="card-title"></h5>
            <form id="register_form" method="post"  autocomplete="off">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter Username" required><?php echo $usernameErr; ?>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">First name</label>
                    <input type="text" class="form-control" name="first_name" aria-describedby="emailHelp" placeholder="Enter first name" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Last name</label>
                    <input type="text" class="form-control" name="last_name" aria-describedby="emailHelp" placeholder="Enter last name" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password1" placeholder="Password" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Re-Enter Password</label>
                    <input type="password" class="form-control" name="password2" placeholder="Password" required><?php echo $passwordErr; ?>

                </div>
                <div class="form-group">
                    <label for="type">User Type</label>
                    <select name="role" class="form-control"  required>
                        <option value="">Choose User type</option>
                        <option value="0">Admin</option>
                        <option value="1">Engineer</option>
                        <option value="2">Shiftleader</option>
                        <option value="3">Line monitor</option>
                        <option value="9">Guest</option>
                    </select>

                </div>
                <button type="submit" name="register" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>


<?php
    if(isset($_POST['register'])){
    $username=$_POST['username'];
    $sql = "SELECT * FROM tbl_user WHERE username='$username'";
    $result = $conn->query($sql);

if ($result->num_rows == 0) {
    if ($_POST['password1']== $_POST['password2']) {
        $password=$_POST['password1'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $role=$_POST['role'];
        $sql = "INSERT INTO tbl_user (username,password,first_name,last_name,role) VALUES ('$username','$hash','$first_name','$last_name','$role')";
        if ($conn->query($sql) === TRUE) {
            echo '<script>window.location.href="main_menu.php"</script>';

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $passwordErr = '<div class="alert alert-warning">
    <strong>Login!</strong> Failed.
</div>';
    }} else {

    $usernameErr = '<div class="alert alert-warning">
    <strong>Login!</strong> Failed.
</div>';
    }};
?>

</body>
</html>
