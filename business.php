<?php
require_once("db.php");

if (!empty($_POST))
{
	$bafm = $_POST["bafm"];
	$adeia = $_POST["adeia"];
	$firstname = $_POST["fname"];
	$lastname = $_POST["lname"];
	$amka = $_POST["amka"];
	$afm = $_POST["afm"];
	$startDate = $_POST["startDate"];
	if(isset($_POST["endDate"]))
		$endDate = $_POST["endDate"];

	$sessionFlag = 0;
	if ($_SESSION["usr_username"] != "") {
		$sessionFlag = 1;
	}

	$query = '';
	if(!isset($_POST["checkBox"]))
	{
		if($sessionFlag) {
			$usrId = $_SESSION["usr_id"];
			$query = "INSERT INTO BusinessEmployeeForm (esf_usr_id, esf_submitTime, esf_startDate, esf_endDate, esf_name, esf_surname, esf_afm, esf_amka, esf_wst_id, esf_businessAfm) VALUES
			('$usrId',NOW(), '$startDate', '$endDate', '$firstname', '$lastname', '$afm', '$amka', '$adeia', '$bafm')";
		}
		else
			$query = "INSERT INTO BusinessEmployeeForm (esf_submitTime, esf_startDate, esf_endDate, esf_name, esf_surname, esf_afm, esf_amka, esf_wst_id, esf_businessAfm) VALUES
			(NOW(), '$startDate', '$endDate', '$firstname', '$lastname', '$afm', '$amka', '$adeia', '$bafm')";
	}
	else {
	if($sessionFlag) {
			$usrId = $_SESSION["usr_id"];
			$query = "INSERT INTO BusinessEmployeeForm (esf_usr_id, esf_submitTime, esf_startDate, esf_endDate, esf_name, esf_surname, esf_afm, esf_amka, esf_wst_id, esf_businessAfm) VALUES
			('$usrId', NOW(), '$startDate', NULL, '$firstname', '$lastname', '$afm', '$amka', '$adeia', '$bafm')";
		}
		else {
			$query = "INSERT INTO BusinessEmployeeForm (esf_submitTime, esf_startDate, esf_endDate, esf_name, esf_surname, esf_afm, esf_amka, esf_wst_id, esf_businessAfm) VALUES
			(NOW(), '$startDate', NULL, '$firstname', '$lastname', '$afm', '$amka', '$adeia', '$bafm')";
		}
	}
	$conn = DbOpenConnection();

	$result = DbExecuteQuery($conn,$query);

	if ($result == TRUE)
		echo '<script>alert("Η αίτηση σας υποβλήθηκε επιτυχώς και είναι προς εξέταση. Ευχαριστούμε.")</script>';
	else {
		echo '<script>alert("Υπήρξε πρόβλημα κατά την υποβολή, παρακαλούμε προσπαθήστε ξανά")</script>';
	}
	DbCloseConnection($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
	<script>
	//
	  	$('.va-pickers a').click( function() {
	    	$('.va-pickers a').removeClass('active');
	      $(this).addClass('active');
	    });
	})(jQuery);
	</script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

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
				  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/images/business-control.jpg');
				  margin-top: 30px;
				  margin-left: 0px;
				  margin-right: 0px;
				  height: 300px;
				  background-position: center;
				  background-repeat: no-repeat;
				  background-size: cover;
				  position: relative;
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
    <title>ΕΠΙΧΕΙΡΗΣΕΙΣ | ΥΠΑΚΠ</title>

</head>
<body style="padding-top:80px;">
    <?php include 'header.php';?>

    <script type="text/javaScript">
        function myFunction() {
			var element = document.getElementById("business-sel");
			element.classList.add("active");
		}
		myFunction();
	</script>

	<div class="hero-image">
	  <div class="hero-text">
		<h1>ΔΙΑΧΕΙΡΙΣΤΙΚΟ ΕΠΙΧΕΙΡΗΣΕΩΝ</h1>
	  </div>
	</div>
    <div style="margin-bottom: 20px;">
        <div class="row" style="width: 100%; padding-left:20px">
            <div id="side-menu" class="col-md-2 accordions is-first-expanded" style="background-color: white;">
                <div class="mysidenav">
					<article class="accordion">
						<a style="color:inherit;" onClick="loadBusinessAbilities();">
							<div class="accordion-head">
								<span>Δυνατότητες επιχειρήσεων</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
					<article class="accordion">
						<a style="color:inherit;" onClick="loadBusinessEconomics();">
							<div class="accordion-head">
								<span>Οικονομικά επιχείρησης</span>
							</div>
							<div class="accordion-body">
								<div class="mycontent">
								</div>
							</div>
						</a>
					</article>
                    <article class="accordion">
                        <a class="scroll-to-section" style="color:inherit;" href="#employer">
                            <div class="accordion-head">
                                <span>
                                    Προσωπικό επιχείρησης
                                </span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                        </a>
                        <div class="accordion-body">
                            <div class="content">
                                <a class="scroll-to-section" style="color:inherit;" href="#organizationally-measures">
                                    <!-- <p class="sidenav-elem-hov">Οργανωτικά μέτρα</p> -->
                                    <div class="va-pickers">
                                        <a href="#organizationally-measures"
                                            class="accordion scroll-to-section va-picker va-picker-text"
                                            onClick="loadStatementPage();">
                                            <span class="va-picker-item" style=" font-size: 15px;">Δήλωση</span>
                                        </a>
                                    </div>
                                </a>
                                <br>
                                <a class="scroll-to-section" style="color:inherit;" href="#personal-hygiene">
                                    <!-- <p class="sidenav-elem-hov">Μέτρα ατομικής υγιεινής & μέσα ατομικής προστασίας</p> -->
                                    <div class="va-pickers">
                                        <a href="#personal-hygiene"
                                            class="accordion scroll-to-section va-picker va-picker-text"
                                            onClick="loadHistoryPage();">
                                            <span class="va-picker-item" style=" font-size: 15px;">Ιστορικό δηλώσεων</span>
                                        </a>
                                    </div>
                                </a>
								<br>
								<a class="scroll-to-section" style="color:inherit;" href="#personal-hygiene">
                                    <!-- <p class="sidenav-elem-hov">Μέτρα ατομικής υγιεινής & μέσα ατομικής προστασίας</p> -->
                                    <div class="va-pickers">
                                        <a href="#personal-hygiene"
                                            class="accordion scroll-to-section va-picker va-picker-text"
                                            onClick="loadBusinessState();">
                                            <span class="va-picker-item" style=" font-size: 15px;">Διαχείριση προσωπικού</span>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div id="dynamic-container" class="col-md-9"
                style="word-wrap:break-word; margin-left: 45; background-color: #f4f4f4; border-radius: 20px; margin-top:30px; text-align: center; padding-bottom:50px;">

				<?php include 'business-abilities.php';?>

            </div>
        </div>
    </div>

    <?php include 'footer.php';?>
<script>
function loadBusinessAbilities() {

	$("#dynamic-container").load('business-abilities.php');

}

function loadStatementPage() {

	$("#dynamic-container").load('business-page.php');

}

function loadHistoryPage() {

	$("#dynamic-container").load('business-history.php');

}

function loadBusinessEconomics() {

	$("#dynamic-container").load('business-economics.php');

}

function loadBusinessState() {

	$("#dynamic-container").load('business-state.php');

}

</script>
<script>
function showBusinessEmployeesReportHtml(businessAfm) {
	var ajaxUrl = 'assets/ajax/business-employees-report.php?afm=' + businessAfm + '&report=1';
	$.ajax({
		url: ajaxUrl,
		cache: false
	}).done(
		function(data) {
			var html = data;
			elementBusinessEmployeesReport = document.getElementById("divBusinessEmployeesReport");
			elementBusinessEmployeesReport.innerHTML = html;
		}
	);
}
// Our Code
function showBusinessEmployeesReportHtml2(businessAfm) {
	var ajaxUrl = 'assets/ajax/business-employees-report.php?afm=' + businessAfm + '&report=2';
	$.ajax({
		url: ajaxUrl,
		cache: false
	}).done(
		function(data) {
			var html = data;
			elementBusinessEmployeesReport = document.getElementById("divBusinessEmployeesReport");
			elementBusinessEmployeesReport.innerHTML = html;
		}
	);
}

function deleteEsfReport(esf_id, bsn_afm) {
	var ajaxUrl = 'assets/ajax/deleteEsfReport.php?esfId=' + esf_id;
	$.ajax({
		url: ajaxUrl,
		cache: false
	}).done(
		function(data) {
			var html = data;
			debugger;
			showBusinessEmployeesReportHtml2(bsn_afm);
			//elementBusinessEmployeesReport = document.getElementById("divBusinessEmployeesReport");
			//elementBusinessEmployeesReport.innerHTML = html;
		}
	);
}
function deleteEsf(esf_id, bsn_afm) {
	console.log(esf_id);
	console.log(bsn_afm);

	var result = confirm("Είστε σίγουροι ότι θέλετε να διαγράψετε την καταχώρηση;");
	if (result) {
		deleteEsfReport(esf_id, bsn_afm);
	}

}

function editEsfReport(esf_id, bsn_afm) {
	var ajaxUrl = 'assets/ajax/deleteEsfReport.php?esfId=' + esf_id;
	$.ajax({
		url: ajaxUrl,
		cache: false
	}).done(
		function(data) {
			var html = data;
			debugger;
			showBusinessEmployeesReportHtml(bsn_afm);
			//elementBusinessEmployeesReport = document.getElementById("divBusinessEmployeesReport");
			//elementBusinessEmployeesReport.innerHTML = html;
		}
	);
}
function editEsf(esf_id, bsn_afm) {
	console.log(esf_id);
	console.log(bsn_afm);

	var result = confirm("Είστε στίγουροι ότι θέλετε να διαγράψετε την καταχώρηση;");
	if (result) {
		deleteEsfReport(esf_id, bsn_afm);
	}
}

function expandStatement(esf_id) {

	//var userid = $(this).data('id');
	//console.log(userid);
	console.log(esf_id);
	// AJAX request
	var ajaxUrl = 'assets/ajax/changeStatement.php?esf_id=' + esf_id;
	$.ajax({
	 url: ajaxUrl,
	 cache: false,
	 }).done(
		 function(data) {
	   // Add response in Modal body
	   $('.modal-body').html(data);

	   // Display Modal
	   //$('#empModal').modal('show');
	   //document.getElementById("empModal").style.display = "block";
	   $('#empModal').modal({show:true});
	   // document.getElementById("empModal").modal({{show:true}});
	   // modal
	 }
	);

}


</script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
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
<script src="assets/ajax/changeStatement.js"></script>
</body>
</html>
