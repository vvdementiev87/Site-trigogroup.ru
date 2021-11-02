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
