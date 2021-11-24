<?php
require 'controller.php';
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
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $rows_array[] = $row;

                        }}
                        echo json_encode($rows_array, JSON_UNESCAPED_UNICODE);
?>
