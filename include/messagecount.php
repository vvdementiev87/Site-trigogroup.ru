<?php
$sql2 = "SELECT COUNT(message_id) FROM tbl_message WHERE message_to='$session_username' AND message_flag='1'";
$result = $conn->query($sql2);
$result2 = $result->fetch_array();
?>
