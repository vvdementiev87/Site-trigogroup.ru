<?php
include 'include/controller.php';
$session_username = $_SESSION['user_name'];
$session_role = $_SESSION['role'];
if(empty($_SESSION['user_name'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>MISSION LIST Ongoing</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <!-- Loader -->
    <link rel="stylesheet" href="css/loader.css">
    <script src="js/jquery-1.12.4.js"></script>
    <link rel="stylesheet" type="text/css" href="dashboard/vendor/font-awesome/css/font-awesome.min.css">
    <script>
        $(document).ready(function() {
                $('#example').DataTable({
                    "searching": true,
                    "order": [[ 0, "desc" ]],
                    "iDisplayLength": 50,
                    "aLengthMenu": [[ 25, 50, 100, 250, -1],[25,50,100,250,"All"]]
                    });
            $('.dataTables_length').addClass('bs-select');
            });


        </script>
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/responsive.bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>
</head>

<body onload="myFunction()" style="margin:0;">
    <div class="container">
        <div class="dropdown">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><span class='glyphicon glyphicon-triangle-left' aria-hidden='true'></span>Control<span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li onclick="location.href = 'main_menu.php'"><a href="#" data-toggle="modal"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Back</a></li>

                </ul>
            </div>

            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><span class='glyphicon glyphicon-user' aria-hidden='true'></span>
                <?php echo $session_username . " ($session_role)"; ?> <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#logout" data-toggle="modal"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout</a></li>
                <li><a href="#changepass" data-toggle="modal"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Change Password</a></li>
            </ul>
            <?php if ($session_role <2) { echo "<a href=\"#add\" data-toggle=\"modal\">
                <button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Data</button>
            </a>";}
            ?>

        </div>

        <br>
        <table id="example" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
                    $sql = "SELECT tbl_data.data_id, tbl_data.data_type, tbl_data.data_name, tbl_data.data_comment, tbl_data.data_email FROM tbl_data";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $data_id = $row['data_id'];
                            $data_type = $row['data_type'];
                            $data_name = $row['data_name'];
                            $data_comment = $row['data_comment'];
                            $data_email = $row['data_email'];
                ?>

                <tr>
                    <td>
                        <?php echo $data_id; ?>
                    </td>
                    <td>
                        <?php echo $data_type; ?>
                    </td>
                    <td>
                        <?php echo $data_name; ?>
                    </td>
                    <td>
                        <?php echo $data_comment; ?>
                    </td>
                    <td>
                        <?php echo $data_email; ?>
                    </td>
                    <td>
                            <?php if ($session_role <2) { echo "<a href='#edit".$data_id."' data-toggle='modal'>
                            <button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>
                        </a>";} ?>
                    </td>

                </tr>



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
                    <!--Edit Item Modal -->


                <div id="edit<?php echo $data_id ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <form method="post" class="form-horizontal" role="form">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Mission</h4>
                                        <input type="hidden" name="edit_data_id" value="<?php echo $data_id ?>">
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                           <label class="control-label col-sm-4" for="data_type">Data type:</label>
                                           <div class="col-sm-6">
                                           <p>
                                           <select  size="1" class="form-control" id="data_type" name="data_type" required">
                                           <option value="mission_tqf" <?php if ($data_type=='mission_tqf') echo 'selected' ?>>Renault responsible</option>
                                               <option value="cost_center" <?php if ($data_type=='cost_center') echo 'selected' ?>>Cost center</option>
                                           </select>
                                           </p>
                                           </div>
                                        </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-4" for="data_name">Data name:</label>
                                       <div class="col-sm-6">
                                       <input type="text" class="form-control" id="data_name" name="data_name" value="<?php echo $data_name ?>" placeholder="data name" required  autofocus> </div>
                                    </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="data_email">Email:</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" id="data_email" name="data_email" value="<?php echo $data_email ?>" placeholder="email" required  autofocus> </div>
                                        </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-4" for="data_comment">Comments:</label>
                                       <div class="col-sm-6">
                                       <textarea class="form-control" id="data_comment" name="data_comment"><?php echo ($data_comment); ?></textarea>
                                       </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                         <button type="submit" class="btn btn-primary" name="update_data"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                         <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                    </div>




               <?php
                        }}


                        if(isset($_POST['change_pass'])){
                            $sql = "SELECT password FROM tbl_user WHERE username='$session_username'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    if($row['password'] != $current_password){
                                        echo "<script>window.alert('Invalid Password');</script>";
                                        $passwordErr = '<div class="alert alert-warning"><strong>Password!</strong> Invalid.</div>';
                                    } elseif($new_password != $repeat_password) {
                                        echo "<script>window.alert('Password Not Match!');</script>";
                                        $passwordErr = '<div class="alert alert-warning"><strong>Password!</strong> Not Match.</div>';
                                    } else{
                                        $sql = "UPDATE tbl_user SET password='$new_password' WHERE username='$session_username'";

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







                if(isset($_POST['update_data'])){
                    $edit_data_id = $_POST['edit_data_id'];
                    $data_type = $_POST['data_type'];
                    $data_name = $_POST['data_name'];
                    $data_comment = $_POST['data_comment'];
                    $data_email = $_POST['data_email'];
                    $sql = "UPDATE tbl_data SET 
                                data_type='$data_type',
                                data_name='$data_name',
                                data_comment='$data_comment',
                                data_email='$data_email'                                
                                WHERE data_id='$edit_data_id'";
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>window.location.href="data.php"</script>';
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }


                    //Add Item
                    if(isset($_POST['add_data'])){


                        $data_type = $_POST['data_type'];
                        $data_name = $_POST['data_name'];
                        $data_comment = $_POST['data_comment'];
                        $data_email = $_POST['data_email'];
                        $sql = "INSERT INTO tbl_data (data_type,data_name,data_comment,data_email) VALUES ('$data_type','$data_name','$data_comment','$data_email')";

                             if ($conn->query($sql) === TRUE) {

                                echo '<script>window.location.href="data.php"</script>';

                             } else {
                                 echo "Error: " . $sql . "<br>" . $conn->error;
                             }
                }


                ?>

            </tbody>
        </table>
    </div>



    <!--Add Item Modal -->
    <div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form method="post" class="form-horizontal" role="form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add data</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="data_type">Data type:</label>
                            <div class="col-sm-4">
                                <p><select  size="1" class="form-control" id="data_type" name="data_type" required">
                                    <option selected value="mission_tqf">Renault responsible</option>
                                    <option selected value="cost_center">Cost center</option>
                                    </select></p>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="data_name">Data name:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="data_name" name="data_name" placeholder="data name" required></div>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="data_email">Email:</label>
                                <div class="col-sm-4">
                                    <input type="email" class="form-control" id="data_email" name="data_email" placeholder="data email" required></div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="data_comment">Comments:</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" id="data_comment" name="data_comment" autocomplete="off"></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="add_data"><span class="glyphicon glyphicon-plus"></span> Add</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Logout Modal -->
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

</body>

</html>
