<?php

require_once("../../db.php");

$apfId = $_GET['apfId'];

$query = "DELETE FROM AppointmentForm WHERE apf_id='$apfId'";

$conn = DbOpenConnection();

$result = DbExecuteQuery($conn,$query);

if($result == TRUE)
{
    echo 'OK';
}

?>
