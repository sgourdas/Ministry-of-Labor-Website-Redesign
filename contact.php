<?php
	require_once("db.php");

	$sessionFlag = 0;
	if ($_SESSION["usr_username"] != "") {
		$sessionFlag = 1;
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//print_r($_POST);

		$name = $_POST["fname"];
		$lastname = $_POST["lname"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];


		if (!isset($_POST["amka"])) {
			$desc = $_POST["desc"];
			$conn = DbOpenConnection();

			if ($sessionFlag) {
				$userId = $_SESSION["usr_id"];
				$query = "INSERT INTO ContactForm (ctf_submitDateTime, ctf_usr_id, ctf_name, ctf_surname, ctf_phone, ctf_email, ctf_description) VALUES (NOW(),'$userId','$name', '$lastname', '$phone','$email','$desc')";
			}
			else
				$query = "INSERT INTO ContactForm (ctf_submitDateTime, ctf_name, ctf_surname, ctf_phone, ctf_email, ctf_description) VALUES (NOW(),'$name', '$lastname', '$phone','$email','$desc')";

			$result = DbExecuteQuery($conn, $query);

			$alertSub = '';

			if ($result === TRUE)
			$alertSub = '<script>alert("Σας ευχαριστούμε πολύ για την υποβολή σας, θα επικοινωνήσουμε μαζί σας το συντομότερο δυνατό!")</script>';

			else
				$alertSub = '<script>alert("Προέκυψε κάποιο σφάλμα, παρακαλούμε προσπαθήστε ξανά!")</script>';

		}
		else
		{

			$amka = $_POST["amka"];
			$afm = $_POST["afm"];
			$startDate = $_POST["startDate"];
			$startTime= $_POST["startTime"];

			$startTime = $startTime . ':00';

			$DateTime = $startDate.' '.$startTime;
			//$formatedDateTime = date('Y-m-d H:i:s', $DateTime);
			//echo "<script>alert('$formatedDateTime')</script>";

			$conn = DbOpenConnection();

			if ($sessionFlag) {
				$userId = $_SESSION["usr_id"];
$query = "INSERT INTO AppointmentForm (apf_submitDateTime, apf_usr_id, apf_name, apf_surname, apf_phone, apf_email, apf_amka, apf_afm, apf_appointmentDateTime) VALUES (NOW(),'$userId','$name', '$lastname', '$phone','$email','$amka','$afm','$DateTime')";
			}
			else
$query = "INSERT INTO AppointmentForm (apf_submitDateTime, apf_name, apf_surname, apf_phone, apf_email, apf_amka, apf_afm, apf_appointmentDateTime) VALUES (NOW(),'$name', '$lastname', '$phone','$email','$amka','$afm', '$DateTime')";

			$result = DbExecuteQuery($conn, $query);
			//echo "<script>alert('$result')</script>";

			if ($result === TRUE)
			$alertSub = '<script>alert("Σας ευχαριστούμε πολύ για την υποβολή σας, σας περιμένουμε τουλάχιστον 10 λεπτά πριν την αναγραφόμενη ώρα : '.$startTime.' !")</script>';

			else
				$alertSub = '<script>alert("Προέκυψε κάποιο σφάλμα, παρακαλούμε προσπαθήστε ξανά!")</script>';
		}

	}

?>


<!DOCTYPE html>

<head>
	<script>
	//
	  	$('.va-pickers a').click( function() {
	    	$('.va-pickers a').removeClass('active');
	      $(this).addClass('active');
	    });
	})(jQuery);
	</script>
	<!-- jQuery -->
	<script src="assets/js/jquery-2.1.0.min.js"></script>

	<!-- Bootstrap -->
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Plugins -->
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
		  background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(assets/images/contact.jpg);
		  margin-left: 0px;
		  margin-right: 0px;
		  height: 300px;
		  background-position: center;
		  background-repeat: no-repeat;
		  background-size: cover;
		  position: relative;
		  margin-top: 30px;
		  padding-top: 100px;
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
	</style>
	<title>ΥΠΟΥΡΓΕΙΟ | ΥΠΑΚΠ</title>

</head>

<body style="padding-top:80px;">
	<?php include 'header.php';?>

	<script type="text/javaScript">
		function myFunction() {
			var element = document.getElementById("ministry-sel");
			element.classList.add("active");
		}
		myFunction();
	</script>

	<div class="hero-image">
	  <div class="hero-text">
		<h1>ΕΠΙΚΟΙΝΩΝΙΑ</h1>
	  </div>
	</div>
	<div style="margin-bottom: 20px;">
		<div class="row" style="width: 100%; padding-left:20px">
			<div id="side-menu" class="col-md-2 accordions is-first-expanded" style="background-color: white;">
				<div class="mysidenav">
					<article class="accordion">
						<a class="scroll-to-section" style="color:inherit;" onClick="loadCommunicationPage();">
							<div class="accordion-head">
								<span id ="nav1">Τρόποι επικοινωνίας</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
					<article class="accordion">
						<a style="color:inherit;" onClick="loadAppointmentWizzard();">
							<div class="accordion-head">
								<span id ="nav2">Κλείσε ραντεβού online</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
					<article class="accordion">
						<a style="color:inherit;" onClick="loadContactForm();">
							<div class="accordion-head">
								<span id ="nav3">Φόρμα επικονωνίας</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
				</div>
			</div>
			<div id="dynamic-container" class="col-md-9" style="word-wrap:break-word; margin-left: 45; background-color: #f4f4f4; border-radius: 20px; margin-top:30px; text-align: center; padding-bottom:50px;">
				<!-- Here we have dynamic-loading based on sidenav selections-->
				<?php include 'communication-page.php';?>
				<br>
			</div>
		</div>
	</div>
	<?php include 'footer.php';

		if ($alertSub != '')
		{
			echo $alertSub;
		}

	?>


</body>
<script>
function loadAppointmentWizzard() {
	$("#dynamic-container").load('appointment.php');
	window.location.hash = 'appointments';
	fix2();
}

function loadCommunicationPage() {
	$("#dynamic-container").load('communication-page.php');
	window.location.hash = 'communication';
	fix1();
}

function loadContactForm() {
	$("#dynamic-container").load('contact-form.php');
		window.location.hash = 'contact-form';
	fix3();
}
</script>
<!-- <script src="assets/js/wizard-js/jquery-3.3.1.min.js"></script> -->

<!-- JQUERY STEP -->
<script src="assets/js/wizard-js/jquery.steps.js"></script>

<!-- DATE-PICKER -->
<!-- <script src="assets/css/wizzard/date-picker/js/datepicker.js"></script> -->
<!-- <script src="assets/css/wizzard/date-picker/js/datepicker.en.js"></script> -->
<script>
	$(document).scroll(function() {
	    var y = $(document).scrollTop(), //get page y value
	        header = $(".mysidenav");
	    if(y >= 210)  {
			var width = document.getElementById('side-menu').offsetWidth;
	         header.css({position: "fixed", "top" : "6em", "width": width-30});


	    } else {
	        header.css({position:"relative","top": "0",  width:"100%"});
		// 	// header.css({position: "fixed", "top" : "0", "left" : "0"});
	    }
	});
</script>

<script>
function fix1() {
    document.getElementById("nav1").style.color = "#4870ac";
    document.getElementById("nav2").style.color = "#000";
    document.getElementById("nav3").style.color = "#000";
}

function fix2() {
    document.getElementById("nav1").style.color = "#000";
    document.getElementById("nav2").style.color = "#4870ac";
    document.getElementById("nav3").style.color = "#000";
}

function fix3() {
    document.getElementById("nav1").style.color = "#000";
    document.getElementById("nav2").style.color = "#000";
    document.getElementById("nav3").style.color = "#4870ac";
}
</script>
<script>
	$(document).scroll(function() {
	    var y = $(document).scrollTop(), //get page y value
	        header = $(".mysidenav");
	    if(y >= 300)  {
			var width = document.getElementById('side-menu').offsetWidth;
	         header.css({position: "fixed", "top" : "6em", "width": width-30});


	    } else {
	        header.css({position:"relative","top": "0",  width:"100%"});
		// 	// header.css({position: "fixed", "top" : "0", "left" : "0"});
	    }
	});
</script>

<script src="assets/js/wizard-js/main.js"></script>
</html>
