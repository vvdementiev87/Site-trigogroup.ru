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
                    <li onclick="location.href = 'missions_all.php'"><a href="#" data-toggle="modal"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Show all</a></li>
                </ul>
            </div>

            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><span class='glyphicon glyphicon-user' aria-hidden='true'></span>
                <?php echo $session_username . " ($session_role)"; ?> <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#logout" data-toggle="modal"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout</a></li>
                <li><a href="#changepass" data-toggle="modal"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Change Password</a></li>
            </ul>
            <?php if ($session_role <2) { echo "<a href=\"#add\" data-toggle=\"modal\">
                <button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Mission</button>
            </a>";}
            ?>

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
        $sql = "SELECT tbl_data.data_name FROM tbl_data WHERE tbl_data.data_type='mission_tqf' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $mission_tqf_list[]= $row['data_name'];
            }}
        $sql = "SELECT tbl_data.data_name FROM tbl_data WHERE tbl_data.data_type='cost_center' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $cost_center_list[]= $row['data_name'];
            }}








        function partlist($conn)
        {
            $sql1 = "SELECT tbl_part.part_id, tbl_part.part_number, tbl_part.part_name FROM tbl_part";
            $result1 = $conn->query($sql1);
            global $part;
            $part=null;
            if ($result1->num_rows > 0) {
                // output data of each rows
                while ($row1 = $result1->fetch_assoc()) {
                    $part[] = array(
                        'part_id' => $row1['part_id'],
                        'part_number' => $row1['part_number'],
                        'part_name' => $row1['part_name']
                    );
                }
            };
        };
        ?>
        <br>
        <table id="example" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Mission number</th>
                    <th>Customer</th>
                    <th>Responsible engineer</th>
                    <th>TQF engineer</th>
                    <th>Acivity type</th>
                    <th>Part number</th>
                    <th>Part name</th>
                    <th>Defect</th>
                    <th>Status</th>
                    <th>Comment</th>
                    <th>Cost center</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Mission number</th>
                    <th>Customer</th>
                    <th>Responsible engineer</th>
                    <th>TQF engineer</th>
                    <th>Acivity type</th>
                    <th>Part number</th>
                    <th>Part name</th>
                    <th>Defect</th>
                    <th>Status</th>
                    <th>Comment</th>
                    <th>Cost center</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
                    $sql = "SELECT tbl_missions.mission_id, tbl_missions.mission_cost_center, tbl_missions.mission_number, tbl_missions.mission_start_date, tbl_missions.mission_stop_date, tbl_missions.mission_customer, tbl_missions.mission_resp_engineer, tbl_missions.mission_tqf, tbl_missions.mission_activity, tbl_missions.mission_comment, tbl_missions.mission_status,tbl_missions.mission_monitoring,tbl_missions.mission_audit_frequency, tbl_missions.mission_defect, GROUP_CONCAT(tbl_part.part_number SEPARATOR ',\n') AS partnumber, GROUP_CONCAT(tbl_part.part_name SEPARATOR ',\n') AS partname FROM tbl_missions LEFT JOIN missions_part ON tbl_missions.mission_id = missions_part.mission_id LEFT JOIN tbl_part ON missions_part.part_id=tbl_part.part_id WHERE (tbl_missions.mission_status = 'ongoing' OR tbl_missions.mission_status = 'stopped') GROUP BY tbl_missions.mission_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $mission_id = $row['mission_id'];
                            $mission_number = $row['mission_number'];
                            $mission_start_date = $row['mission_start_date'];
                            $mission_customer = $row['mission_customer'];
                            $mission_resp_engineer = $row['mission_resp_engineer'];
                            $mission_tqf = $row['mission_tqf'];
                            $mission_activity = $row['mission_activity'];
                            $mission_status = $row['mission_status'];
                            $mission_defect = $row['mission_defect'];
                            $mission_monitoring = $row['mission_monitoring'];
                            $mission_audit_frequency = $row['mission_audit_frequency'];
                            $mission_part=$data = str_replace("\n", "<br/>", $row ['partnumber']);
                            $mission_part_name=$data = str_replace("\n", "<br/>", $row ['partname']);
                            $mission_comment = $row['mission_comment'];
                            $mission_cost_center = $row['mission_cost_center'];
                            $mission_stop_date = $row['mission_stop_date'];



                    ?>
                <tr>
                    <td>
                        <?php echo $mission_number; ?>
                    </td>
                    <td>
                        <?php echo $mission_customer; ?>
                    </td>
                    <td>
                        <?php echo $mission_resp_engineer; ?>
                    </td>
                    <td>
                        <?php echo $mission_tqf; ?>
                    </td>
                    <td>
                        <?php echo $mission_activity; ?>
                    </td>
                    <td>
                        <?php echo $mission_part; ?>
                    </td>
                    <td>
                        <?php echo $mission_part_name; ?>
                    </td>
                    <td>
                        <?php echo $mission_defect; ?>
                    </td>
                    <td class="<?php if ($mission_status=='Stopped') echo 'warning'; if ($mission_status== 'Closed') echo 'danger';  if ($mission_status=='Ongoing') echo 'success'; ?>">
                        <?php echo $mission_status; ?>
                    </td>
                    <td>
                        <?php echo $mission_comment; ?>
                    </td>
                    <td>
                        <?php echo $mission_cost_center; ?>
                    </td>
                    <td>
                            <?php if ($session_role <2) { echo "<a href='#edit".$mission_id."' data-toggle='modal'>
                            <button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>
                        </a>";} ?>
                        <div id="edit<?php echo $mission_id ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <form method="post" class="form-horizontal" role="form">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit Mission</h4>
                                            <input type="hidden" name="edit_mission_id" value="<?php echo $mission_id ?>">
                                            <input type="hidden" name="edit_mission_status" value="<?php echo $mission_status ?>">
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_number">Mission number:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_number" name="mission_number" value="<?php echo $mission_number ?>" placeholder="Mission number" required autofocus> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_customer">Customer:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="mission_customer" name="mission_customer" value="<?php echo $mission_customer ?>" placeholder="Customer" required  autofocus> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_resp_engineer">Responsible:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_resp_engineer" name="mission_resp_engineer" value="<?php echo $mission_resp_engineer ?>" placeholder="Responsible engineer" required autofocus> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_tqf">RENAULT resp:</label>
                                                <div class="col-sm-6">
                                                <p><select  size="1" class="form-control" id="mission_tqf" name="mission_tqf" required">
                                                    <?php foreach($mission_tqf_list as $value)

                                                    { if ($mission_tqf==$value) {
                                                        echo '<option value="'.$value.'" selected>'.$value.'</option>';
                                                    } else{
                                                        echo '<option value="'.$value.'">'.$value.'</option>';
                                                    }
                                                    } ?>
                                                    </select></p>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_activity">Activity type:</label>
                                                <div class="col-sm-6">
                                                    <p>
                                                        <select  size="1" class="form-control" id="mission_activity" name="mission_activity" required">
                                                        <option value="Sorting" <?php if ($mission_activity=='Sorting') echo 'selected' ?>>Sorting</option>
                                                        <option value="Rework" <?php if ($mission_activity=='Rework') echo 'selected' ?>>Rework</option>
                                                        <option value="Sorting/rework" <?php if ($mission_activity=='Sorting/rework') echo 'selected' ?>>Sorting/rework</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_defect">Defect:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="mission_defect" name="mission_defect" value="<?php echo $mission_defect ?>" placeholder="Defect" required  autofocus> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_status">Status:</label>
                                                <div class="col-sm-6">
                                                    <p>
                                                        <select  size="1" class="form-control" id="mission_status" name="mission_status" required">
                                                        <option value="Ongoing" <?php if ($mission_status=='Ongoing') echo 'selected' ?>>Ongoing</option>
                                                        <option value="Stopped" <?php if ($mission_status=='Stopped') echo 'selected' ?>>Stopped</option>
                                                        <option value="Closed" <?php if ($mission_status=='Closed') echo 'selected' ?>>Closed</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_monitoring">Include in line monitoring:</label>
                                                <div class="col-sm-4">
                                                    <p><select  size="1" class="form-control" id="mission_monitoring" name="mission_monitoring" required">
                                                        <option <?php if ($mission_monitoring=='Yes') echo 'selected' ?> value="Yes">Yes</option>
                                                        <option <?php if ($mission_monitoring=='No') echo 'selected' ?> value="No">No</option>
                                                        </select></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_audit_frequency">Audit frequency:</label>
                                                <div class="col-sm-4">
                                                    <p><select  size="1" class="form-control" id="mission_audit_frequency" name="mission_audit_frequency" required">
                                                        <option <?php if ($mission_audit_frequency=='Once per shift') echo 'selected' ?> value="Once per shift">Once per shift</option>
                                                        <option <?php if ($mission_audit_frequency=='Once per week') echo 'selected' ?> value="Once per week">Once per week</option>
                                                        </select></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_comment">Comments:</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" id="mission_comment" name="mission_comment"><?php echo $mission_comment; ?></textarea>
                                                </div>
                                            </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="mission_cost_center">Cost center:</label>
                                                    <div class="col-sm-6">
                                                        <p><select  size="1" class="form-control" id="mission_cost_center" name="mission_cost_center" required">
                                                            <?php foreach($cost_center_list as $value)

                                                            { if ($mission_cost_center==$value) {
                                                                echo '<option value="'.$value.'" selected>'.$value.'</option>';
                                                            } else{
                                                                echo '<option value="'.$value.'">'.$value.'</option>';
                                                            }
                                                            } ?>
                                                            </select></p>
                                                    </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="update_mission"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                            <?php if ($session_role <2) { echo "<a href='references_add.php?mission_id=".$mission_id."' data-toggle='modal'>
                            <button type='submit' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>
                        </a>";}?>
                    </td>
                    <td>
                        <a href="#info<?php echo $mission_id; ?>" data-toggle="modal">
                            <button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span></button>
                        </a>
                        <div id="info<?php echo $mission_id; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    <form method="post" class="form-horizontal" role="form">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Mission info</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_number">Mission number:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_number" name="mission_number" value="<?php echo $mission_number ?>" placeholder="Mission number" > </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_customer">Start date:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_customer" name="mission_customer" value="<?php echo $mission_start_date ?>" placeholder="Customer" > </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_stop_date">Stop date:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_stop_date" name="mission_stop_date" value="<?php echo $mission_stop_date ?>" placeholder="Customer" > </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_customer">Customer:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_customer" name="mission_customer" value="<?php echo $mission_customer ?>" placeholder="Customer" > </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_resp_engineer">Responsible:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_resp_engineer" name="mission_resp_engineer" value="<?php echo $mission_resp_engineer ?>" placeholder="Resp_engineer" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_tqf">RENAULT resp:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_tqf" name="mission_tqf" value="<?php echo $mission_tqf ?>" placeholder="RENAULT responsible">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_activity">Activity type:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_activity" name="mission_activity" value="<?php echo $mission_activity ?>" placeholder="Activity">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_defect">Defect:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_defect" name="mission_defect" value="<?php echo $mission_defect ?>" placeholder="Defect"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_status">Status:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_status" name="mission_status" value="<?php echo $mission_status ?>" placeholder="Defect"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_monitoring">Include in line monitoring:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_monitoring" name="mission_monitoring" value="<?php echo $mission_monitoring ?>" placeholder="mission_monitoring"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_audit_frequency">Audit frequency:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_audit_frequency" name="mission_audit_frequency" value="<?php echo $mission_audit_frequency ?>" placeholder="mission_audit_frequency"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_comment">Comments:</label>
                                                <div class="col-sm-6">
                                                    <textarea readonly class="form-control" id="mission_comment" name="mission_comment" value="<?php echo $mission_comment; ?>" autocomplete="off"><?php echo $mission_comment; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="mission_cost_center">Cost center:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control" id="mission_cost_center" name="mission_cost_center" value="<?php echo $mission_cost_center; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>




                    <!--Edit Item Modal -->




                            <!--Edit Item Modal -->




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







                if(isset($_POST['update_mission'])){
                    $edit_mission_id = $_POST['edit_mission_id'];
                    $mission_number = $_POST['mission_number'];
                    $mission_customer = $_POST['mission_customer'];
                    $mission_resp_engineer = $_POST['mission_resp_engineer'];
                    $mission_tqf = $_POST['mission_tqf'];
                    $mission_activity = $_POST['mission_activity'];
                    $mission_status = $_POST['mission_status'];
                    $mission_defect = $_POST['mission_defect'];
                    $mission_comment = $_POST['mission_comment'];
                    $mission_monitoring = $_POST['mission_monitoring'];
                    $mission_audit_frequency = $_POST['mission_audit_frequency'];
                    $mission_cost_center=$_POST['mission_cost_center'];
                    if (($_POST['edit_mission_status'] ==='Ongoing') and ($mission_status === 'Stopped')){
                        $current_time= time();
                        $sql = "UPDATE tbl_missions SET 
                        mission_number='$mission_number',
                        mission_customer='$mission_customer',
                        mission_resp_engineer='$mission_resp_engineer',
                        mission_tqf='$mission_tqf',
                        mission_activity='$mission_activity',
                        mission_status='$mission_status',
                        mission_defect='$mission_defect',
                        mission_monitoring='$mission_monitoring',
                        mission_defect='$mission_defect',
                        mission_audit_frequency='$mission_audit_frequency',
                        mission_comment='$mission_comment',
                        mission_cost_center='$mission_cost_center',
                        mission_stop_date=FROM_UNIXTIME('$current_time')
                        WHERE mission_id='$edit_mission_id'";  
                    }else {
                    $sql = "UPDATE tbl_missions SET 
                                mission_number='$mission_number',
                                mission_customer='$mission_customer',
                                mission_resp_engineer='$mission_resp_engineer',
                                mission_tqf='$mission_tqf',
                                mission_activity='$mission_activity',
                                mission_status='$mission_status',
                                mission_defect='$mission_defect',
                                mission_monitoring='$mission_monitoring',
                                mission_defect='$mission_defect',
                                mission_audit_frequency='$mission_audit_frequency',
                                mission_comment='$mission_comment',
                                mission_cost_center='$mission_cost_center'
                                WHERE mission_id='$edit_mission_id'";
                    }
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>window.location.href="missions.php"</script>';
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }


                    //Add Item
                    if(isset($_POST['add_mission'])){


                        $mission_customer = $_POST['mission_customer'];
                        $mission_resp_engineer = $_POST['mission_resp_engineer'];
                        $mission_tqf = $_POST['mission_tqf'];
                        $mission_activity = $_POST['mission_activity'];
                        $mission_status = $_POST['mission_status'];
                        $mission_defect = $_POST['mission_defect'];
                        $mission_comment = $_POST['mission_comment'];
                        $mission_monitoring = $_POST['mission_monitoring'];
                        $mission_audit_frequency = $_POST['mission_audit_frequency'];
                        $mission_cost_center=$_POST['mission_cost_center'];
                        $sql = "INSERT INTO tbl_missions (mission_customer,mission_resp_engineer,mission_tqf,mission_activity,mission_status,mission_defect,mission_comment,mission_monitoring,mission_audit_frequency,mission_cost_center) VALUES ('$mission_customer','$mission_resp_engineer','$mission_tqf','$mission_activity','$mission_status','$mission_defect','$mission_comment','$mission_monitoring ','$mission_audit_frequency', '$mission_cost_center')";
                        mysqli_query($conn, $sql);
                        $mission_id=mysqli_insert_id($conn);

                        $mission_number='RAVTO.21.'.sprintf('%04d', $mission_id-580);
                        $sql2 = "INSERT INTO tbl_version (version_letter,version_reason,version_user,version_sorting_speed,version_NOK_speed,version_rework_speed,version_NOK_ratio,version_rework_ratio,mission_id) VALUES ('A','new','$session_username','30','45','60','0.1','0.5','$mission_id')";
                        $conn->query($sql2);

                        $message_from=$session_username;
                        $message_text='Новый заказ '.$mission_number;


                        $sql4 = "SELECT tbl_user.username FROM  tbl_user WHERE tbl_user.role>'1' AND tbl_user.role<'9'";
                        $result4 = $conn->query($sql4);
                                                $username1=null;
                        if ($result4->num_rows > 0) {
                            // output data of each rows
                            while ($row4 = $result4->fetch_assoc()) {
                                $username1[] = $row4['username'];
                            }
                        };
                        foreach($username1 as $user){
                            $sql3="INSERT INTO tbl_message(message_to,message_from,message_text,message_flag) VALUES ('$user','$message_from','$message_text','1')";
                            $conn->query($sql3);
                        }

                        $sql1 = "UPDATE tbl_missions SET 
                                mission_number='$mission_number'                                                           
                                WHERE mission_id='$mission_id'";


                             if ($conn->query($sql1) === TRUE) {

                                echo '<script>window.location.href="missions.php"</script>';

                             } else {
                                 echo "Error: " . $sql1 . "<br>" . $conn->error;
                             }
                }

                //Add Item
                if(isset($_POST['reference_add'])){
                    $mission_id = $_POST['edit_mission_id'];
                if ($session_role <2) {echo '<script>window.location.href="references_add.php?mission_id='.$mission_id.'" </script>';}
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
                        <h4 class="modal-title">Create mission</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mission_customer">Customer:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="mission_customer" name="mission_customer" placeholder="Mission customer" autocomplete="off" required> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mission_resp_engineer">Responsible:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control" id="mission_resp_engineer" name="mission_resp_engineer" placeholder="Mission responsible" value="<?php echo $session_username; ?>" > </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mission_tqf">RENAULT resp:</label>
                            <div class="col-sm-6">
                                <p><select  size="1" class="form-control" id="mission_tqf" name="mission_tqf" required">
                                    <?php foreach($mission_tqf_list as $value){ echo '<option value="'.$value.'" >'.$value.'</option>';} ?>
                                    </select></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mission_activity">Activity type:</label>
                            <div class="col-sm-6">
                                <p><select  size="1" class="form-control" id="mission_activity" name="mission_activity" required">
                                    <option selected value="Sorting">Sorting</option>
                                    <option value="Rework">Rework</option>
                                    <option value="Sorting/rework">Sorting/rework</option>
                                    </select></p>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="mission_defect">Defect:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mission_defect" name="mission_defect" placeholder="Defect" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="mission_status">Status:</label>
                                <div class="col-sm-6">
                                    <p><select  size="1" class="form-control" id="mission_status" name="mission_status" required">
                                        <option selected value="Ongoing">Ongoing</option>
                                        <option value="Stopped">Stopped</option>
                                        <option value="Closed">Closed</option>
                                        </select></p>
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mission_monitoring">Include in line monitoring:</label>
                            <div class="col-sm-6">
                                <p><select  size="1" class="form-control" id="mission_monitoring" name="mission_monitoring" required">
                                    <option selected value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    </select></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mission_audit_frequency">Audit frequency:</label>
                            <div class="col-sm-6">
                                <p><select  size="1" class="form-control" id="mission_audit_frequency" name="mission_audit_frequency" required">
                                    <option selected value="Once per shift">Once per shift</option>
                                    <option value="Once per week">Once per week</option>
                                    </select></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mission_comment">Comments:</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="mission_comment" name="mission_comment" autocomplete="off"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mission_cost_center">Cost center:</label>
                            <div class="col-sm-6">
                                <p><select  size="1" class="form-control" id="mission_cost_center" name="mission_cost_center" required">
                                    <?php foreach($cost_center_list as $value){ echo '<option value="'.$value.'" >'.$value.'</option>';} ?>
                                    </select></p>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="add_mission"><span class="glyphicon glyphicon-plus"></span> Add</button>
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
