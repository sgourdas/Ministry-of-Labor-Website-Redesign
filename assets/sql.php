<?php
	session_start();

	// ini_set("display_errors", 1); 		error_reporting(E_ALL);
	$sessionBool = 0;
	if ($_SESSION["username"] != '') {
		$sessionBool = 1;
		$hn = 'localhost';
		$db = 'devwebtopgrdb';
		$un = 'devwebtopgrusr';
		$pw = 'Dv$rvDm?2bFyebQ9';
		$conn = new mysqli($hn, $un, $pw, $db);

		if ($conn->connect_error) {
			die ($conn->connect_error);

		}

		$conn->set_charset("utf8mb4");
		$username = $_SESSION["username"];
		$query = "SELECT * FROM User WHERE usr_username = '$username'";

		$result = $conn->query($query);

		if ($result->num_rows) {
			$row = $result->fetch_object();
			$name = $row->usr_name;
			$surname = $row->usr_surname;
			$phone = $row->usr_phone;
			$amka = $row->usr_amka;
			$afm = $row->usr_afm;
			$email = $row->usr_email;
		}

	}
?>
