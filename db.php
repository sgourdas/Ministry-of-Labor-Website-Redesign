<?php
// ini_set("display_errors", 1);
// error_reporting(E_ALL);
$db_errorCode = 0;
$db_errorMsg = '';
session_start();
if (!isset($_SESSION["usr_username"])) {
	$_SESSION["usr_username"] = "";
}

// -----------------------------------------------------------------------------
function DbOpenConnection() {
	// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $hn = 'localhost';
    $db = 'devwebtopgrdb';
    $un = 'myTest';
    $pw = 'myTest';

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        $db_errorCode = 1;
        $db_errorMessage = "Cannot connect to db";
        die ($conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

function DbExecuteQuery($conn, $query) {
    return $conn->query($query);
}

function DbCloseConnection($conn) {
    if ($conn !== null)
        $conn->Close();
}

function DbSaveUserInfoToSession($row) {
    $_SESSION["usr_id"] = $row->usr_id;
    $_SESSION["usr_username"] = $row->usr_username;
	$_SESSION["usr_password"] = $row->usr_password;
    $_SESSION["usr_email"] = $row->usr_email;
    $_SESSION["usr_name"] = $row->usr_name;
    $_SESSION["usr_surname"] = $row->usr_surname;
    $_SESSION["usr_phone"] = $row->usr_phone;
    $_SESSION["usr_amka"] = $row->usr_amka;
    $_SESSION["usr_afm"] = $row->usr_afm;
    $_SESSION["usr_act_id"] = $row->usr_act_id;
	echo "Reached here";
}

function DbSaveBusinessInfoToSession($row) {
    $_SESSION["bsn_id"] = $row->bsn_id;
    $_SESSION["bsn_afm"] = $row->bsn_afm;
    $_SESSION["bsn_name"] = $row->bsn_name;
    $_SESSION["bsn_address"] = $row->bsn_address;
    $_SESSION["bsn_phone"] = $row->bsn_phone;
}

function DbLoginUser($username, $password) {

    $res = false;
    $conn = null;
    try {
        $conn = DbOpenConnection();
        $query = "SELECT * FROM User WHERE usr_username='$username' AND usr_password='$password'";
        $result = DbExecuteQuery($conn, $query);

        if($result->num_rows != 0) {
            $row = $result->fetch_object();
            DbSaveUserInfoToSession($row);
            $res = true;
        }
        else {
            $db_errorCode = 1;
            $db_errorMsg = 'Λάθος στοιχεία, παρακαλούμε προσπαθήστε ξανά';
        }
    }
    catch(Exception $ex) {
        $db_errorCode = 5000;
        $db_errorMsg = $ex->getMessage();
    }
    finally {
		if($_SESSION["usr_act_id"] == 1)
		{
			$userId = $_SESSION["usr_id"];
			$query = "SELECT * FROM Business WHERE bsn_usr_id='$userId'";

			$result = DbExecuteQuery($conn, $query);
			//print_r($result);
			if($result->num_rows != 0) {

				$row = $result->fetch_object();
				//print_r($row);
				DbSaveBusinessInfoToSession($row);
				$res = true;
			}
			else {
				$res = false;
			}

		}
        DbCloseConnection($conn);
    }
    return $res;
}






?>
