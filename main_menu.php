<?php
include 'include/controller.php';
include 'include/changepass.php';
include 'include/messagecount.php';
$session_username = $_SESSION['user_name'];
$session_role = $_SESSION['role'];
if(empty($_SESSION['user_name'])){
    header("location:login.php");
}?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/c45754f219.js" crossorigin="anonymous"></script>
    <title>Main menu</title>
</head>

<body class="page">

    <div class="page__wrap page__wrap--menu">
        <div id="logout" class="modal__logout nav-1 close" role="dialog">
            <div class="modal__logout__wrap">
                <div class="modal__body">
                    <div class="modal__header">
                        <h4 class="modal__text">Logout</h4>
                        <button class="modal__text modal__text--btn btn-1">&times;</button>
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
                        <button class="modal__btn--close btn-1">NO</button>
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
                            <button class="modal__text modal__text--btn btn-2">&times;</button>
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
                                <li><a class="header__link btn-2" href="#changepass"> Change Password</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
            </div>
        </header>
        <main class="mainmenu container">
            <div class="mainmenu__wrap">
                <div class="mainmenu__top">
                    <h2>Main menu</h2>
                    <i class="fas fa-th-large"></i>
                </div>
                <ul>
                    <li class='mainmenu__item'><a href="message.php"> Message (<?php echo $result2[0]; ?>)
                        </a></li>
                    <?php if ($session_role <1) { echo "<li class='mainmenu__item'><a href='inventory.php'>Inventory</a></li>" ;}?>
                    <li class='mainmenu__item'><a href="missions.php">Mission list</a></li>
                    <?php if ($session_role <2) { echo "<li class='mainmenu__item'><a href='references.php'>References</a></li>";}?>
                    <?php if ($session_role <4) { echo "<li class='mainmenu__item'><a href='PJI.php'>PJI</a></li>";}?>
                    <?php if ($session_role <4) { echo "<li class='mainmenu__item'><a href='version.php'>Mission version</a></li>";}?>
                    <?php if ($session_role <4 or $session_role ==9) { echo " <li class='mainmenu__item'><a href='remark.php'>Remark</a></li>"; }?>
                    <?php if ($session_role <4 or $session_role ==9) { echo " <li class='mainmenu__item'><a href='consumption.php'>Consumption</a></li>"; }?>
                    <?php if ($session_role <4) { echo "<li class='mainmenu__item'><a href='employee.php'>Employee</a></li>";}?>
                    <?php if ($session_role <4) { echo "<li class='mainmenu__item'><a href='excel_load.php'>EXCEL</a></li>";}?>
                    <?php if ($session_role <3) { echo "<li class='mainmenu__item'><a href='data.php'>Data</a></li>";}?>
                    <?php if ($session_role <1) { echo " <li class='mainmenu__item'><a href='input.php'>Input</a></li>"; }?>
                    <?php if ($session_role <1) { echo " <li class='mainmenu__item'><a href='register.php'>Register</a></li>"; }?>
                    <li class='mainmenu__item'>
                    <div class="header__dropdown"><details>
                                <summary class="header__btn header__btn--main">
                                    Visualization
                                </summary>
                                <ul class="header__dropdown__menu--main">
                                    <li><a class="header__link" href="graph.php">График загрузки инженеров</a></li>
                                    <li><a class="header__link" href="graph1.php">Статистика по ЦЗ</a></li>
                                    <li><a class="header__link" href="graph2.php">График загрузки по ЦЗ</a></li>
                                </ul>
                            </details></div>
                        </li>
                </ul>
            </div>
            <div class="mainmenu__weeknumber">
                <h2>Номен недели:</h2>
                <h2><?php echo 'W'.date('W').'/Y'.date('Y'); ?></h2>
            </div>
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
    </div>
    <script src="JS/buttonClick.js"></script>
</body>

</html>