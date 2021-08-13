<?php

require_once("../../db.php");

$esfId = $_GET['esfId'];

$query = "DELETE FROM BusinessEmployeeForm WHERE esf_id='$esfId'";

$conn = DbOpenConnection();

$result = DbExecuteQuery($conn,$query);

if($result == TRUE)
{
    echo 'OK';
}



?>
