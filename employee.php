<?php
	require_once("db.php");
	$sessionFlag = 0;
	if ($_SESSION["usr_username"] != '') {
		$sessionFlag = 1;
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//
		$name = $_POST["fname"];
		$lastname = $_POST["lname"];
		$amka = $_POST["amka"];
		$afm = $_POST["afm"];
		$bsnAfm = $_POST["bsnAfm"];
		$adeia = $_POST["adeia"];
		$startDate = $_POST["startDate"];
		if (isset($_POST["endDate"]))
			$endDate = $_POST["endDate"];

		$query = '';
		if ($sessionFlag == 1)
		{
			$userId = $_SESSION["usr_id"];

			if (!isset($_POST["checkBox"]))
			{

				$query = "INSERT INTO EmployeeBusinessForm (wkf_usr_id, wkf_submitTime, wkf_startDate, wkf_endDate, wkf_name, wkf_surname, wkf_amka, wkf_afm, wkf_businessAfm, wkf_wst_id)
													VALUES('$userId', NOW(), '$startDate', '$endDate', '$name', '$lastname', '$amka', '$afm', '$bsnAfm', '$adeia')";
			}
			else
			{
				$query = "INSERT INTO EmployeeBusinessForm (wkf_usr_id, wkf_submitTime, wkf_startDate, wkf_endDate, wkf_name, wkf_surname, wkf_amka, wkf_afm, wkf_businessAfm, wkf_wst_id)
														VALUES('$userId', NOW(), '$startDate', NULL, '$name', '$lastname', '$amka', '$afm', '$bsnAfm', '$adeia')";
			}

		}
		else
		{
			if (!isset($_POST["checkBox"]))
			{
				$query = "INSERT INTO EmployeeBusinessForm (wkf_submitTime, wkf_startDate, wkf_endDate, wkf_name, wkf_surname, wkf_amka, wkf_afm, wkf_businessAfm, wkf_wst_id)
														VALUES(NOW(), '$startDate','$endDate', '$name', '$lastname', '$amka', '$afm', '$bsnAfm', '$adeia')";
			}
			else
			{
				$query = "INSERT INTO EmployeeBusinessForm (wkf_submitTime, wkf_startDate, wkf_endDate, wkf_name, wkf_surname, wkf_amka, wkf_afm, wkf_businessAfm, wkf_wst_id)
														VALUES(NOW(), '$startDate', NULL, '$name', '$lastname', '$amka', '$afm', '$bsnAfm', '$adeia')";
			}
		}

		$conn = DbOpenConnection();
		$result = DbExecuteQuery($conn, $query);

		//print_r($result);

		if ($result === TRUE)
			echo '<script>alert("Σας ευχαριστούμε πολύ για την υποβολή σας, η δήλωση σας τοποθετήθηκε ήδη προς εξέταση")</script>';
			else
				echo '<script>alert("Προέκυψε κάποιο σφάλμα, παρακαλούμε προσπαθήστε ξανά!")</script>';
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
				  background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('assets/images/employee-control.jpg');
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
			</style>
    <title>ΕΡΓΑΖΟΜΕΝΟΙ | ΥΠΑΚΠ</title>

</head>

<body style="padding-top:80px;">
    <?php include 'header.php';?>

    <script type="text/javaScript">
        function myFunction() {
			var element = document.getElementById("employee-sel");
			element.classList.add("active");
		}
		myFunction();
	</script>

		<div class="hero-image">
		  <div class="hero-text">
			<h1>ΔΙΑΧΕΙΡΙΣΤΙΚΟ ΕΡΓΑΖΟΜΕΝΩΝ</h1>
		  </div>
		</div>
    <div style="margin-bottom: 20px;">
        <div class="row" style="width: 100%; padding-left:20px">
            <div id="side-menu" class="col-md-2 accordions is-first-expanded" style="background-color: white;">
                <div class="mysidenav">
					<article class="accordion">
						<a style="color:inherit;" onClick="loadEmployeeAbilities();">
							<div class="accordion-head">
								<span>Δυνατότητες εργαζομένων</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
					<article class="accordion">
						<a style="color:inherit;" onClick="loadEmployeeForm();">
							<div class="accordion-head">
								<span>Εργασιακή δήλωση</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
					<article class="accordion">
						<a id="tempo" style="color:inherit;" onClick="loadEmployeeState();">
							<div class="accordion-head">
								<span>Ιστορικό εργαζομένου</span>
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

				<?php include 'employee-abilities.php';?>

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
	         header.css({position: "fixed", "top" : "6em", "width": width-30});


	    } else {
	        header.css({position:"relative","top": "0",  width:"100%"});
		// 	// header.css({position: "fixed", "top" : "0", "left" : "0"});
	    }
	});
</script>

<script>
function loadEmployeeAbilities() {

	$("#dynamic-container").load('employee-abilities.php');

}

function loadEmployeeForm() {

	$("#dynamic-container").load('employee-form.php');

}

function loadEmployeeState() {

	$("#dynamic-container").load('employee-state.php');

}
</script>
