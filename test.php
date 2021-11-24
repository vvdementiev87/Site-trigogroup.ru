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
    <div class="page__wrap">
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
        <div id="missionchange" class="modal__missionchange nav-3 close" role="dialog">
            <div class="modal__changepass__wrap">
                <div class="modal__body">
                    <form action="" class="modal__main__form" method="post">
                        <div class="modal__header">
                            <h4 class="modal__text">Change Password</h4>
                            <button class="modal__text modal__text--btn btn-3">&times;</button>
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
                            <button type="submit" class="modal__btn--accept btn-3" name="change_pass">Update</button>
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

 <script>
   let xhttp = new XMLHttpRequest();
   let objElm=[];
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myFunction(JSON.parse(this.response));
    }
}

xhttp.open('POST', 'https://trigogroup.ru/include/dbLink.php', false);
xhttp.send();

function myFunction(data) {
    console.log(data);
    for (let key of data){
        objElm.push(key);
    };
}
console.log(objElm);
    console.log(objElm[0]);
let keyArr=[];
    for (let key in objElm[0]){
        keyArr.push(key);
    }
    let inputData=[{
        name:'data_id',
        text:'ID'
    },{
        name:'data_type',
        text:'Тип данных'
    },{
        name:'data_name',
        text:'Наименование'
    },{
        name:'data_comment',
        text:'Коментарий'
    },{
        name:'data_email',
        text:'Email'
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

    for (let i = objElm.length-1; i >= 0; i--){
        let row$=document.createElement("tr");
        ;
        let elm=objElm[i];
        
            for (let colIndex = 0; colIndex < inputData.length; colIndex++) {
            let col$ = document.createElement("td");
            let indexEl=inputData[colIndex].name;
            if (inputData[colIndex].name==='mission_number'){
                col$.classList.add('btn-3');
            };
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
    <script src="JS/buttonClick.js"></script>
    
</body>

</html>