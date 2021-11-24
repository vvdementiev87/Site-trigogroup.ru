<?php
require 'controller.php';
$sql = "SELECT tbl_data.data_id,
                 tbl_data.data_type,
                  tbl_data.data_name,
                   tbl_data.data_comment,
                    tbl_data.data_email 
                FROM tbl_data";
                $rows_array = array();    
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $rows_array[] = $row;

                        }}
                        echo json_encode($rows_array, JSON_UNESCAPED_UNICODE);
?>
