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
    <title>Data list</title>    
</head>

<body>
    <div class="page__wrap page__wrap--list">
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
                            <button type="submit" class="modal__btn--accept btn-2" name="change_pass">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="missionchange" class="modal__missionchange nav-3 close">
            <div class="modal__missionchange__wrap">
                <div class="modal__body">
                    <div action="" class="modal__main__form">
                        <div class="modal__header">
                            <h4 class="modal__text">Mission information</h4>
                            <button class="modal__text modal__text--btn btn-4">&times;</button>
                        </div>
                        <div class="modal__main">
                            <div class="form__group">
                                <label class="modal__text" for="nameInputId">ID number:</label>
                                <div class="col-sm-10">
                                    <input id="nameInputId" type="text" class="form__control"
                                        placeholder="nameInputId" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameInputMissionNumber">Mission number:</label>
                                <div class="col-sm-10">
                                    <input id="nameInputMissionNumber" type="text" class="form__control"
                                        placeholder="nameInputMissionNumber" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameInputMissionCustomer">Customer name:</label>
                                <div class="col-sm-10">
                                    <input id="nameInputMissionCustomer" type="text" class="form__control" 
                                        placeholder="nameInputMissionCustomer" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionCostCenter">Cost Center:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionCostCenter" type="text" class="form__control" 
                                        placeholder="nameMissionCostCenter" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionStartDate">Start Date:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionStartDate" type="text" class="form__control" 
                                        placeholder="nameMissionStartDate" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionStopDate">Stop Date:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionStopDate" type="text" class="form__control" 
                                        placeholder="nameMissionStopDate" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionRespEngineer">Responsible:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionRespEngineer" type="text" class="form__control" 
                                        placeholder="nameMissionRespEngineer" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionTqf">Renault responsible:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionTqf" type="text" class="form__control" 
                                        placeholder="nameMissionTqf" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionActivity">Activity type:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionActivity" type="text" class="form__control" 
                                        placeholder="nameMissionActivity" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionComment">Comment:</label>
                                <div class="col-sm-10">
                                    <textarea id="nameMissionComment" type="text" class="form__control" 
                                        placeholder="nameMissionComment" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionStatus">Status:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionStatus" type="text" class="form__control" 
                                        placeholder="nameMissionStatus" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionMonitoring">Monitoring:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionMonitoring" type="text" class="form__control" 
                                        placeholder="nameMissionMonitoring" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionAuditFrequency">Audit:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionAuditFrequency" type="text" class="form__control" 
                                        placeholder="nameMissionAuditFrequency" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="nameMissionDefect">Defect:</label>
                                <div class="col-sm-10">
                                    <input id="nameMissionDefect" type="text" class="form__control" 
                                        placeholder="nameMissionDefect" readonly>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="namePartNumber">Parts number:</label>
                                <div class="col-sm-10">
                                    <textarea id="namePartNumber" type="text" class="form__control" 
                                        placeholder="namePartNumber" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="form__group">
                                <label class="modal__text" for="namePartName">Parts name:</label>
                                <div class="col-sm-10">
                                    <textarea id="namePartName" type="text" class="form__control" 
                                        placeholder="namePartName" rows="5" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal__footer">
                            <button class="modal__btn--update btn-update" name="change_pass">Update</button>
                            <button class="modal__btn--accept btn-accept" name="change_pass">OK</button>
                            <button class="modal__btn--close btn-4" name="change_pass">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="header">
            <div class="container header__wrap">
                <div class="header__left">
                    <a href="main_menu.php"><img class="header__logo" src="images/sticker_vk_spotty_040.png" alt="LOGO"></a>
                </div>
                <div class="header__right">
                    <form action="#" class="header__search__form">
                    <input type="text" class="header__search__field">
                    <button class="header__search__btn" type="submit">
                    <svg class="header__search__img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>
                    </button>
                    </form>
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
        <main class="mainmenu--table container">
            <table class="mainmenu__table" id="excelDataTable">                
            </table>            
        </main>
        <footer class="footer">
            <section class="container footer__wrap">
                <div class="footer__left">
                    <p>© 2021 Vasek property.</p>
                </div>
                <div class="footer__right">
                    
                </div>
            </section>
        </footer>
     </div>
     <script src="JS/tableBuild2.js"></script>
    <script src="JS/buttonClick.js"></script>   
</body>

</html>