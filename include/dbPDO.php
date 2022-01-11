<?php

session_start();

/* // Подключаем файл с объявлением класса DB для работы с MySQL через PDO
require 'db.php';
// Подключаем файл с объявлением класса нашего обработчика исключений типа PDOException
require 'mypdoexception.php';
// Подключаемся к СУБД
$dbh = DB::instance();   */
require 'connection.php';

date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d");
$date_time = date("Y-m-d h:i:s");

/* if(isset($_POST['login'])){
    $username=addslashes($username);
    $sql = "SELECT * FROM tbl_user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if(password_verify($txtpassword, $row['password'])){
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                header("location:main_menu.php");
            } else {
                $passwordErr = '<div class="alert alert-warning">
                        <strong>Login!</strong> Failed.
                        </div>';
                $username = $row['username'];
            }
        }
    } else {
        $usernameErr = '<div class="alert alert-danger">
  <strong>Username</strong> Not Found.
</div>';
        $username = "";
    }
} */

/* $sql = "SELECT tbl_missions.mission_id,
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
                GROUP BY tbl_missions.mission_id";
                $rows_array = array();                  
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $rows_array[] = $row;

                        }}
                        echo json_encode($rows_array, JSON_UNESCAPED_UNICODE);
                    
                    catch ( PDOException $e ) {
    
                        MyPDOException::instance( $e );
                        
                      } */

$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
  case 'GET':
    //Here Handle GET Request
    echo 'You are using '.$method.' Method';
    break;
  case 'POST':
    //Here Handle POST Request
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
                GROUP BY tbl_missions.mission_id";
                $rows_array = array();
                try{    
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $rows_array[] = $row;

                        }}
                        echo json_encode($rows_array, JSON_UNESCAPED_UNICODE);}
                        catch ( PDOException $e ) {
    
                            MyPDOException::instance( $e );
                            
                          }
    break;
  case 'PUT':
    //Here Handle PUT Request
    echo json_encode('You are using '.$method.' Method', JSON_UNESCAPED_UNICODE);
    break;
  case 'PATCH':
    //Here Handle PATCH Request
    echo 'You are using '.$method.' Method';
    break;
  case 'DELETE':
    //Here Handle DELETE Request
    echo 'You are using '.$method.' Method';
    break;
  case 'COPY':
      //Here Handle COPY Request
      echo 'You are using '.$method.' Method';
      break;

  case 'OPTIONS':
      //Here Handle OPTIONS Request
      echo 'You are using '.$method.' Method';
      break;
  case 'LINK':
      //Here Handle LINK Request
      echo 'You are using '.$method.' Method';
      break;
  case 'UNLINK':
      //Here Handle UNLINK Request
      echo 'You are using '.$method.' Method';
      break;
  case 'PURGE':
      //Here Handle PURGE Request
      echo 'You are using '.$method.' Method';
      break;
  case 'LOCK':
      //Here Handle LOCK Request
      echo 'You are using '.$method.' Method';
      break;
  case 'UNLOCK':
      //Here Handle UNLOCK Request
      echo 'You are using '.$method.' Method';
      break;
  case 'PROPFIND':
      //Here Handle PROPFIND Request
      echo 'You are using '.$method.' Method';
      break;
  case 'VIEW':
      //Here Handle VIEW Request
      echo 'You are using '.$method.' Method';
      break;
  Default:
  handle_error($method);
  break;
}


?>