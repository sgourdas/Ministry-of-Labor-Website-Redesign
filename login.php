<?php
require_once("db.php");

$errorMsg = "";

if (!empty($_POST))
{
	$username = $_POST['uname'];
	$password = $_POST['pword'];
	$loginOK = DbLoginUser($username, $password);
	if (!$loginOK) {
		$errorMsg = "Αποτυχία εισόδου χρήστη. Λάθος στοιχεία εισαγωγής.";
	}
}

$sessionFlag = 0;
if ($_SESSION["usr_username"] != "") {
	$sessionFlag = 1;
}
?>
<!DOCTYPE html>
<head>
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
<!--===============================================================================================-->
    <link rel="stylesheet" href="mywizard/wizard.css">
	<style>
		body  {
			width: 100%;
			margin: 0;
			padding: 0;
			overflow-x: hidden;
		}

		.hero-image {
		  background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(assets/images/login.jpg);
		  margin-left: 0px;
		  margin-right: 0px;
		  height: 1200px;
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

	<title>ΣΥΝΔΕΣΗ | ΥΠΑΚΠ</title>

</head>

<body style="padding-top:80px;">
	<?php include 'header.php';?>

    <script type="text/javaScript">
		function myFunction() {
			var element = document.getElementById("login-sel");
			element.classList.add("active");
		}
		myFunction();
	</script>

	<div class="hero-image">
	<div class="hero-text">
	<div class="row" style="width: 100%; margin-bottom: 20px;">
		<div id="dynamic-container" class="container" style="word-wrap:break-word; margin-left: 45; background-color: #f4f4f4; border-radius: 20px; text-align: center; padding-bottom:50px;">
		<?php if($sessionFlag == 0) {?>
			<form id="regForm" method="POST" action="login.php">
			<!-- <h3 style="text-align: center"> Κλείσε ραντεβού</h3> -->
			<!-- One "tab" for each step in the form: -->
				<div class="tab">
				  <h3 style="text-align: center; color: black;">ΣΥΝΔΕΣΗ</h3>
				  <?php if (!empty($errorMsg)) { ?>
						  <br><span style="color:red;"><?php echo $errorMsg; ?> <br></span>
				  <?php } else {?>
						<br>
				 <?php }?>
				 
				  <div class="row">
				    <span class="col-md-12" style="text-align: center; color: black;"><label><br>Όνομα χρήστη</label> <br><input placeholder="π.χ. lalakis6000" minlength="4" pattern="[a-zA-Z0-9]+$" style="width: 60%;" oninput="this.className = ''" name="uname"></span>
				    <span class="col-md-12" style="text-align: center; color: black;"><label>Κωδικός</label> <br><input placeholder="π.χ. abc123!" id="password1" type="password" minlength="5" style="width: 60%;" oninput="this.className = ''" name="pword"></span>
				  </div>
				</div>
				<div style="overflow:auto; ">
				  <div class="row" style="margin-bottom: 1%; margin-right: 1%; margin-left: 1%; ">
				    <div class="col-md-12 text-center">
					  <span id="error-msg" style="display: none; color: #f01d32; height:15px;">Παρακαλώ δείτε ξανά τα κοκκινισμένα πεδία.</span>
					</div>
					<div class="col-md-12 text-center">
					  <span id="error-msg2" style="display: none; color: #f01d32; height:15px;">Τα πεδία των κωδικών πρέπει να είναι τα ίδια.</span>
					</div>
					<br>
					<div class="col-md-12" style="margin-top: 3px; text-align: center;">
					  <button type="submit" id="nextBtn" onclick="nextPrev(1)" class="btn btn-primary" style="margin-bottom: 5px;  width:50%;">

					  Σύνδεση
					  </button>
				    </div>
				  </div>
			    </div><br><br>
			</span><h6 style="color: black;"><br>Δεν έχετε λογαριασμό; <a href="signup.php" style="color: #4870ac; font-size: 105%;">Εγγραφή</a></h6>
			  </div>
		   </form>
		<?php } else {?>
		<br>
		<br>
		<h5 style="color:green;" >Συνδεθήκατε στον ιστοχώρο επιτυχώς.</h5>
		<br>
		<br>
		<a href="index.php">
		 <button type="button" id="nextBtn" class="btn btn-primary" style="width:50%;">
			Μετάβαση στην αρχική σελίδα
		</button>
		</a>
		<?php } ?>
	  </div>
	</div>
	</div>
	</div>

	<?php include 'footer.php';?>

<!--===============================================================================================-->
	<script src="assets/js/jquery-2.1.0.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>

<script src="assets/js/jquery-2.1.0.min.js"></script>
<script src="assets/js/main.js"></script>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
// This function will display the specified tab of the form...
var x = document.getElementsByClassName("tab");
x[n].style.display = "block";
//... and fix the Previous/Next buttons:
if (n == 0) {
 document.getElementById("prevBtn").style.display = "none";
} else {
 document.getElementById("prevBtn").style.display = "inline";
}
if (n == (x.length - 1)) {
 document.getElementById("nextBtn").innerHTML = "Οριστική Υποβολή";
} else {
 document.getElementById("nextBtn").innerHTML = "Επόμενο Βήμα";
}
//... and run a function that will display the correct step indicator:
fixStepIndicator(n)
}

function nextPrev(n) {
	// This function will figure out which tab to display
	var x = document.getElementsByClassName("tab");
	// Exit the function if any field in the current tab is invalid:
	if (n == 1 && !validateForm()) return false;
	// Hide the current tab:
	x[currentTab].style.display = "none";
	// Increase or decrease the current tab by 1:
	currentTab = currentTab + n;
	// if you have reached the end of the form...
	if (currentTab == x.length - 1) {
	 // debugger;
	 form = document.getElementById("regForm");
	 showSummury = document.getElementById("formSummary");
	 html = getFormSummaryHtml();
	 // debugger;
	 // showSummury.innerHTML = html;
	}
	else if (currentTab >= x.length) {
	 return false;
}
// Otherwise, display the correct tab:
showTab(currentTab);
}

function validateForm() {
	// This function deals with validation of the form fields
	var x, y, i, valid = true;
	x = document.getElementsByClassName("tab");
	y = x[currentTab].getElementsByTagName("input");
	k = document.getElementById("error-msg");
	// A loop that checks every input field in the current tab:
	for (i = 0; i < y.length; i++) {
	 // If a field is empty and it is not disabled... (and also is not the dropdown element)
	 if ((y[i].value == "" || window.getComputedStyle(y[i]).getPropertyValue("background-color") === "rgb(255, 221, 221)") && y[i].style.display != "none") {
		 // console.log(y[i]);
	   // add an "invalid" class to the field:
	   y[i].className += " invalid";
	   // and set the current valid status to false
	   valid = false;

	   k.style.display ="inline";
	   console.log(y[i].value);
	 }

	}
	// If the valid status is true, mark the step as finished and valid:
	if (valid) {
	 document.getElementsByClassName("step")[currentTab].className += " finish";
	 k.style.display ="none";
	}
	return valid; // return the valid status
}

function fixStepIndicator(n) {
// This function removes the "active" class of all steps...
var i, x = document.getElementsByClassName("step");
for (i = 0; i < x.length; i++) {
 x[i].className = x[i].className.replace(" active", "");
}
//... and adds the "active" class on the current step:
x[n].className += " active";
}

// Our Code
function getFormSummaryHtml() {
	// This function deals with validation of the form fields
	form = document.getElementById("regForm");
	labels = form.getElementsByTagName("label");
	values = form.getElementsByTagName("input");
	// A loop that checks every input field in the current tab:
	html = "";
	for (i = 0; i < values.length; i++) {
	 // If a field is not empty...
	 if (values[i].value != "" && values[i].disabled != false) {
	   console.log(values[i].value);
	   html += /*labels[i].value + ': ' +*/ values[i].value + '<br>\r\n';
	   // document.getElementById(i).value = values[i];
	 }
	}

	for (i = 0 ; i < 7 ; i++) {
	   document.getElementById(i).value = values[i].value;
	}

	document.getElementById("check2").checked = document.getElementById("check").checked;
	document.getElementById("cars2").selectedIndex = document.getElementById("cars").selectedIndex;
	// document.getElementById("cars2").dispatchEvent(new Event('change'));
	// valoo = document.getElementById("cars").value;
	//
	// $('#cars2').change(function(){
	//   var data= $(this).val();
	//   // alert(data);
	// });
	//
	// $('#cars2')
	//     .val(valoo)
	//     .trigger('change');
	// debugger;
	return html; // return the valid status
	}
	function carsComboChange() {
	input = document.getElementById('carsInput1');
	combo = document.getElementById('cars');
	// debugger;
	value = combo.options[combo.selectedIndex].value;
	input.value = value;
}
function getDate() {

document.getElementById('date-picker').valueAsDate = new Date();
// document.getElementById('date-picker').setAttribute("min",new Date());
}
</script>
<!--  -->
<!-- <script>
function loadAppointmentWizzard() {
	$("#dynamic-container").load('appointment.php');
}

function loadCommunicationPage() {
	$("#dynamic-container").load('communication-page.php');
}

function loadContactForm() {
	$("#dynamic-container").load('contact-form.php');
}
</script> -->

<script>
document.getElementById('check').onchange = function() {

    bussinessElements = document.getElementsByClassName("business-option");

	if(document.getElementById("check").checked) {

		for(i = 0 ; i < bussinessElements.length ; i++) {

			bussinessElements[i].style.display = "block";

		}
		document.getElementById('check').value = 1;

	} else {

		for(i = 0 ; i < bussinessElements.length ; i++) {

			bussinessElements[i].style.display = "none";

		}
		document.getElementById('check').value = 0;

	}

};
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
	         header.css({position: "fixed", "top" : "4em", "width": width-30});


	    } else {
	        header.css({position:"relative","top": "0",  width:"100%"});
		// 	// header.css({position: "fixed", "top" : "0", "left" : "0"});
	    }
	});
</script>

<script src="assets/js/wizard-js/main.js"></script>
</html>
