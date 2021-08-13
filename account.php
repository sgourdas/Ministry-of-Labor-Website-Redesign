<?php
	require_once("db.php");
	//ini_set("display_errors", 1);
	//error_reporting(E_ALL);
	$accountType = -1;
	if (isset($_SESSION['usr_act_id']))
	{
		if($_SESSION["usr_act_id"] == 1) {
			$accountType = 1;
		}
		else {
			$accountType = 0;
		}
	}


	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		//Employee Profile
		if ($accountType == 0) {

			$name = $_POST["fname"];
			$surname = $_POST["lname"];
			$password = $_POST["password"];
			$email = $_POST["email"];
			$phone = $_POST["phone"];


			$conn = DbOpenConnection();

			$usrId = $_SESSION["usr_id"];
			$query = "UPDATE User SET usr_name='$name', usr_password='$password', usr_email='$email', usr_phone='$phone' WHERE usr_id='$usrId'";

			$result = DbExecuteQuery($conn, $query);


			//echo "<script>window.confirm('$errorMsg'); window.location.href='index.php';</script>";
			if($result != TRUE) {

				$errorMsg = 'Λάθος κατά το update';

			}
			else {
				$errorMsg = "Τα στοιχεία χρήστη ενημερώθηκαν επιτυχώς.";
			}

			$_SESSION['usr_name'] = $name;
			$_SESSION['usr_surname'] = $surname;
			$_SESSION['usr_password'] = $password;
			$_SESSION['usr_email'] = $email;
			$_SESSION['usr_phone'] = $phone;

			if (isset($_POST["bus_bool"]) == TRUE && $result == TRUE) {

				$bname = $_POST["bname"];
				$bafm = $_POST["bafm"];
				$baddr = $_POST["baddr"];
				$bphone = $_POST["bphone"];

				$usrId = $_SESSION["usr_id"];

				$query = "INSERT INTO Business (bsn_usr_id, bsn_name, bsn_afm, bsn_address, bsn_phone) VALUES ('$usrId','$bname','$bafm', '$baddr', '$bphone')";
				$conn = DbOpenConnection();

				$result = DbExecuteQuery($conn, $query);
				if ($result == TRUE) {

					$_SESSION['bsn_name'] = $bname;
					$_SESSION['bsn_afm'] = $bafm;
					$_SESSION['bsn_address'] = $baddr;
					$_SESSION['bsn_phone'] = $bphone;
					$_SESSION['usr_act_id'] = 1;


					$conn = DbOpenConnection();
					$query = "UPDATE User SET usr_act_id='1' WHERE usr_id='$usrId'";

					$result = DbExecuteQuery($conn, $query);

					if($result == TRUE) {


						$errorMsg = "Τα στοιχεία χρήστη ενημερώθηκαν, είστε πλέον επιχειρηματίας.";

					}
					else {

						$errorMsg = "Προέκυψε θέμα κατά την αναβάθμιση σας σε επιχειρηματία";

					}

				}
				else {
					$errorMsg = "Προέκυψε θέμα κατά την προσθήκη της επιχείρησης σας";
				}

			}
		}

	// }
		else if ($accountType == 1)
		{

			$name = $_POST["fname"];
			$surname = $_POST["lname"];
			$password = $_POST["password"];
			$email = $_POST["email"];
			$phone = $_POST["phone"];



			$conn = DbOpenConnection();

			$usrId = $_SESSION["usr_id"];
			$query = "UPDATE User SET usr_name='$name', usr_password='$password', usr_email='$email', usr_phone='$phone' WHERE usr_id='$usrId'";

			$result = DbExecuteQuery($conn, $query);


			//print_r($result);

			if($result != TRUE) {

				$errorMsg = 'Λάθος κατά το update';

			}
			else {
				$errorMsg = "Τα στοιχεία χρήστη ενημερώθηκαν επιτυχώς.";
			}

			$_SESSION['usr_name'] = $name;
			$_SESSION['usr_surname'] = $surname;
			$_SESSION['usr_email'] = $email;
			$_SESSION['usr_phone'] = $phone;

			if (isset($_POST["bus_bool2"]) == TRUE && $result == TRUE)
			{
				$usrId = $_SESSION["usr_id"];
				$query = "UPDATE User SET usr_act_id='0' WHERE usr_id='$usrId'";


				$conn = DbOpenConnection();
				$result = DbExecuteQuery($conn, $query);

				if ($result == TRUE)
				{
					$_SESSION['usr_act_id'] = 0;
					unset($_SESSION['bsn_name']);
					unset($_SESSION['bsn_afm']);
					unset($_SESSION['bsn_address']);
					unset($_SESSION['bsn_phone']);

					$query = "DELETE FROM Business WHERE  bsn_usr_id='$usrId'";
					$conn = DbOpenConnection();
					$result = DbExecuteQuery($conn, $query);

					if ($result == TRUE) {
						$errorMsg = 'Τα στοιχεία σας ενημερώθηκαν επιτυχώς, το προφίλ σας είναι πλέον εργασιακό';
					}
					else {
						$errorMsg = 'Υπήρξε κάποιο πρόβλημα κατά την διαγραφή της επιχείρησης σας';
					}

				}
				else {

					$errorMsg = "Υπήρξε πρόβλημα κατά την αλλαγή του λογιαριασμού σε εργασιακό προφίλ.";
				}
			}
		}
		echo "<script>alert('$errorMsg')</script>";
		//print_r($errorMsg);
		//echo "<script>window.confirm('$errorMsg'); window.location.href='index.php';</script>";
		// session_destroy();
	}

?>

<!DOCTYPE html>

<head>
	<script>
	//

	</script>
    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <link rel="stylesheet" href="mywizard/wizard.css">
				<style>
				body  {
					width: 100%;
					margin: 0;
					padding: 0;
					overflow-x: hidden;
				}

				.hero-image {
				  background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('assets/images/login.jpg');
				  margin-left: 0px;
				  margin-right: 0px;
				  height: 300px;
				  background-position: center;
				  background-repeat: no-repeat;
				  background-size: cover;
				  position: relative;
				  margin-top: 30px;
				}

				.hero-text {
					font-family: "Roboto";

				  text-align: center;
				  position: absolute;
				  top: 50%;
				  left: 50%;
				  transform: translate(-50%, -50%);
				  color: white;
				}

				.hero-text h1 {
				text-shadow: 2px 2px #000;
				letter-spacing: 4px;
				font-size:50px;

				}

				.fa-times {
					color: #de0000;
				}
				.fa-times:hover {
					color: #c90000;
				}
			</style>
    <title>ΛΟΓΑΡΙΑΣΜΟΣ | ΥΠΑΚΠ</title>

</head>

<body style="padding-top:80px;">
    <?php include 'header.php';?>
	<?php
		if (!isset($_SESSION["usr_username"])) {
	?>
	<script type="text/javaScript">
        function myFunction() {
			var element = document.getElementById("loggedin-sel");
			element.classList.add("active");
		}
		myFunction();
	</script>
	<?php
		} else {
	?>
	<script type="text/javaScript">
        function myFunction() {
			var element = document.getElementById("loggedin-sel3");
			element.classList.add("active");
		}
		myFunction();
	</script>
	<?php } ?>
		<div class="hero-image">
		  <div class="hero-text">
			<h1>ΛΟΓΑΡΙΑΣΜΟΣ</h1>
		  </div>
		</div>
    <div style="margin-bottom: 20px;">
        <div class="row" style="width: 100%; padding-left:20px">
            <div id="side-menu" class="col-md-2 accordions is-first-expanded" style="background-color: white;">
                <div class="mysidenav">
					<article class="accordion">
						<a style="color:inherit;" onClick="loadAccountHistory();">
							<div class="accordion-head">
								<span>Ιστορικό</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
					<article class="accordion">
						<a style="color:inherit;" onClick="loadAccountEdit();">
							<div class="accordion-head">
								<span>Επεξεργασία λογαριασμού</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
					<article class="accordion">
						<a id="tempo" style="color:inherit;">
							<div class="accordion-head">
								<form method="POST" action="index.php">
									<input name="logout" value="1" type="hidden">
									<li><a href="#" onclick="this.parentNode.parentNode.submit()">Αποσύνδεση</a></li>
								</form>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
                </div>
            </div>
            <div id="dynamic-container" class="col-md-9"
                style="word-wrap:break-word; margin-left: 45; background-color: #f4f4f4; border-radius: 20px; margin-top:30px; text-align: center; padding-bottom:50px;">

				<?php include 'account-history.php';?>

            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>

<script>
	$(document).scroll(function() {
	    var y = $(document).scrollTop(), //get page y value
	        header = $(".mysidenav");
	    if(y >= 300)  {
			var width = document.getElementById('side-menu').offsetWidth;
	         header.css({position: "fixed", "top" : "10em", "width": width-30});


	    } else {
	        header.css({position:"relative","top": "0",  width:"100%"});
		// 	// header.css({position: "fixed", "top" : "0", "left" : "0"});
	    }
	});
</script>

<script>
function loadAccountEdit() {

	$("#dynamic-container").load('account-edit.php');

}

function loadAccountHistory() {

	$("#dynamic-container").load('account-history.php');

}

function deleteApfReport(apf_id) {
	var ajaxUrl = 'assets/ajax/deleteApf.php?apfId=' + apf_id;
	$.ajax({
		url: ajaxUrl,
		cache: false
	}).done(
		function(data) {
			var html = data;
			debugger;
			//elementBusinessEmployeesReport = document.getElementById("divBusinessEmployeesReport");
			//elementBusinessEmployeesReport.innerHTML = html;
		}
	);
}

function deleteApf(apf_id) {
	console.log(apf_id);

	var result = confirm("Είστε σίγουροι ότι θέλετε να ακυρώσετε το ραντεβού σας;");
	if (result) {
		deleteApfReport(apf_id);
	}
	loadAccountHistory();
	alert("Η ακύρωση ήταν επιτυχής");

}
</script>
