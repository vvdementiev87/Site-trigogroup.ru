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
        <main class="mainmenu--table">
            <table class="mainmenu__table" id='excelDataTable'>           
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
        <?php   
                $sql = "SELECT tbl_missions.mission_id,
                tbl_missions.mission_cost_center,
                tbl_missions.mission_number,
                tbl_missions.mission_start_date,
                tbl_missions.mission_stop_date,
                tbl_missions.mission_customer,
                tbl_missions.mission_resp_engineer,
                tbl_missions.mission_tqf,
                tbl_missions.mission_activity,
                tbl_missions.mission_comment,
                tbl_missions.mission_status,
                tbl_missions.mission_monitoring,
                tbl_missions.mission_audit_frequency,
                tbl_missions.mission_defect,
                GROUP_CONCAT(tbl_part.part_number SEPARATOR ',\n') AS partnumber,
                GROUP_CONCAT(tbl_part.part_name SEPARATOR ',\n') AS partname
                FROM tbl_missions LEFT JOIN missions_part ON tbl_missions.mission_id = missions_part.mission_id
                LEFT JOIN tbl_part ON missions_part.part_id=tbl_part.part_id
                WHERE (tbl_missions.mission_status = 'ongoing' OR tbl_missions.mission_status = 'stopped')
                GROUP BY tbl_missions.mission_id";
                $rows_array = array();    
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $rows_array[] = $row;

                        }}
 ?>
 <script>
   let objElm = <?php echo json_encode($rows_array); ?>;  
    console.log(objElm);
    console.log(objElm[0]);
    let keyArr=[];
    for (let key in objElm[0]){
        keyArr.push(key);
    }
    let inputData=[/* {
        name:'mission_id',
        text:'ID'
    }, */{
        name:'mission_cost_center',
        text:'Центр затрат'
    },{
        name:'mission_number',
        text:'Номер заказа'
    },{
        name:'mission_start_date',
        text:'Дата начала'
    },{
        name:'mission_stop_date',
        text:'Дата окончания'
    },{
        name:'mission_customer',
        text:'Наименовани заказчика'
    },{
        name:'mission_resp_engineer',
        text:'Ответственный TRIGO'
    },{
        name:'mission_tqf',
        text:'Ответственный RENAULT'
    },{
        name:'mission_activity',
        text:'Тип активности'
    },{
        name:'mission_comment',
        text:'Комментарии'
    },{
        name:'mission_status',
        text:'Статус'
    },/* {
        name:'mission_monitoring',
        text:'Мониторинг'
    }, *//* {
        name:'mission_audit_frequency',
        text:'Частота аудитов'
    }, */{
        name:'mission_defect',
        text:'Дефект'
    },{
        name:'partnumber',
        text:'Референс'
    },{
        name:'partname',
        text:'Наименование детали'
    }];
    console.log(keyArr.length);
    console.log(inputData.length);
    

    console.log(keyArr);
    let tbody=document.createElement("tbody");
    let row_head$=document.createElement("thead");
    row_head$.insertAdjacentElement('beforeend',document.createElement("tr"));
    for (let colIndex = 0; colIndex < inputData.length; colIndex++){
        let col$ = document.createElement("th");
        let cellValue = inputData[colIndex].text;

        if (cellValue == null) cellValue = "";
            col$.textContent=cellValue;
            row_head$.insertAdjacentElement('beforeend',col$);
    }

    for (let i = 0; i < objElm.length; i++){
        let row$=document.createElement("tr");
        let elm=objElm[i];
        
            for (let colIndex = 0; colIndex < inputData.length; colIndex++) {
            let col$ = document.createElement("td");
            let indexEl=inputData[colIndex].name;
            let cellValue = elm[indexEl];                      
            if (cellValue == null) cellValue = "";
            col$.textContent=cellValue;
            row$.insertAdjacentElement('beforeend',col$);
            
        }
        tbody.insertAdjacentElement('beforeend',row$);    
    }
    let tableEl=document.getElementById('excelDataTable');
    tableEl.insertAdjacentElement('beforeend',row_head$);
    tableEl.insertAdjacentElement('beforeend',tbody);

 </script>
    </div>
</body>

</html>