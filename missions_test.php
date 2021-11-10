<?php
include 'include/controller.php';
include 'include/changepass.php';
$session_username = $_SESSION['user_name'];
$session_role = $_SESSION['role'];
if(empty($_SESSION['user_name'])){
    header("location:login.php");
}                  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/c45754f219.js" crossorigin="anonymous"></script>
    <title>Ongoing missions list</title>
</head>

<body>
    <div class="page__wrap">
        <div id="logout" class="modal__logout nav-1 close" role="dialog">
            <div class="modal__logout__wrap">
                <div class="modal__body">
                    <div class="modal__header">
                        <h4 class="modal__text">Logout</h4>
                        <button class="modal__text modal__text--btn btn-3">&times;</button>
                    </div>
                    <div class="modal__main">
                        <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                        <h5 class="modal__text">Are you Sure you want to logout
                            <strong>
                                <?php echo $_SESSION['user_name']; ?>?
                            </strong>
                        </h5>
                    </div>
                    <div class="modal__footer">
                        <a href="logout.php">
                            <button class="modal__btn--accept">YES </button>
                        </a>
                        <button class="modal__btn--close btn-2">NO</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="changepass" class="modal__changepass nav-2 close" role="dialog">
            <div class="modal__changepass__wrap">
                <div class="modal__body">
                    <form action="" class="modal__main__form" method="post">
                        <div class="modal__header">
                            <h4 class="modal__text">Change Password</h4>
                            <button class="modal__text modal__text--btn btn-5">&times;</button>
                        </div>
                        <div class="modal__main">
                            <div class="form-group">
                                <label class="modal__text" for="name">Current:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="current_password" required
                                        placeholder="Current Password" autofocus autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal__text" for="name">New:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="new_password" required
                                        placeholder="New Password" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal__text" for="name">Repeat:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="repeat_password" required
                                        placeholder="Repeat Password" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal__footer">
                            <button type="submit" class="modal__btn--accept" name="change_pass">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <header class="header">
            <div class="container header__wrap">
                <div class="header__left">
                    <a href="#"><img class="header__logo" src="images/sticker_vk_spotty_040.png" alt="LOGO"></a>
                </div>
                <div class="header__right">
                    <div class="header__dropdown">
                        <details>
                            <summary class="header__btn">
                                <?php echo $session_username . " ($session_role)"; ?>
                            </summary>
                            <ul class="header__dropdown__menu">
                                <li><a class="header__link btn-1" href="#logout"> Logout</a></li>
                                <li><a class="header__link btn-4" href="#changepass"> Change Password</a></li>
                                <li onclick="location.href = 'main_menu.php'"><a class="header__link " href="#">
                                        Back</a></li>
                                <li onclick="location.href = 'missions_all.php'"><a class="header__link " href="#"> Show
                                        all</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
            </div>
        </header>
        <main class="mainmenu container">
            <table class="mainmenu__table">
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
                    <td
                        class="<?php if ($mission_status=='Stopped') echo 'warning'; if ($mission_status== 'Closed') echo 'danger';  if ($mission_status=='Ongoing') echo 'success'; ?>">
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
                    </td>
                    <?php
                        }}?>    
                    </tbody>
            </table>
        </main>
        <footer class="footer">
            <section class="container footer__wrap">
                <div class="footer__left">
                    <p>© 2021 Vasek property.</p>
                </div>
                <div class="footer__right">
                    <a href="#" class="footer__item">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="footer__item">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="footer__item">
                        <i class="fab fa-vk"></i>
                    </a>
                    <a href="#" class="footer__item">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                </div>
            </section>
        </footer>
        <script src="JS/buttonClick.js"></script>
    </div>
</body>

</html>