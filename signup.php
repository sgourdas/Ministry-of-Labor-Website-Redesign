<?php
	require_once("db.php");
	$errorCode = 0;
	$errorMsg = '';
	$regSuccess = 0;
	if (!empty($_POST))
	{

		//$isBusiness = 0;
		//if ($isset['bus_bool'];
	    $isBusiness = $_POST['bus_bool'];
		if($isBusiness == '')
			$isBusiness = 0;
		else
			$isBusiness = 1;


	    $firstname = $_POST['fname'];
	    $lastname = $_POST['lname'];
	    $username = $_POST['uname'];
	    $password = $_POST['pword'];
	    $emailstr = $_POST['email'];
	    $phonestr = $_POST['phone'];
	    $amkastr = $_POST['amka'];
	    $afmstr = $_POST['afm'];

	    $bunisessname = $_POST['bname'];
	    $bunisessphone = $_POST['bphone'];
	    $businessafm = $_POST['bafm'];
	    $businessadr = $_POST['baddress'];

		//ini_set("display_errors", 1);  error_reporting(E_ALL);

	// }

		$conn = DbOpenConnection();
        $query = "SELECT * FROM User WHERE usr_username='$username'";
        $result = DbExecuteQuery($conn, $query);

		//$result = DbExecuteQuery($conn, $query);


		if ($result->num_rows == 0) {

			if ($isBusiness == 0) {
				$conn = DbOpenConnection();
				$query = "INSERT INTO User (usr_registerDate, usr_username, usr_password, usr_email, usr_name, usr_surname, usr_phone, usr_amka, usr_afm, usr_act_id) VALUES (NOW(),'$username', '$password', '$emailstr','$firstname','$lastname','$phonestr','$amkastr','$afmstr','$isBusiness')";
				$result = DbExecuteQuery($conn, $query);

				if ($result == True) {

					$regSuccess = 1;
					$errorMsg = "Η εγγραφή σας ήταν επιτυχής, μπορείτε πλέον να συνδεθείτε";
					echo "<script>window.confirm('Σας ευχαριστούμε πολύ για εγγραφή σας, πατείστε ΟΚ για να συνδεθείτε.'); window.location.href='login.php';</script>";

				}
				else {

					$errorMsg = "Υπήρξε πρόβλημα κατά την υποβολή των στοιχείων σας.";
				}

			}
			else {

				$conn = DbOpenConnection();
				$query = "INSERT INTO User (usr_registerDate, usr_username, usr_password, usr_email, usr_name, usr_surname, usr_phone, usr_amka, usr_afm, usr_act_id) VALUES (NOW(),'$username', '$password', '$emailstr','$firstname','$lastname','$phonestr','$amkastr','$afmstr','$isBusiness')";
				$result = DbExecuteQuery($conn, $query);

				if($result == True) {

					$newid = $conn->insert_id;

					$conn = DbOpenConnection();
					$query = "INSERT INTO Business (bsn_afm, bsn_name, bsn_address, bsn_phone, bsn_usr_id) VALUES ('$businessafm', '$bunisessname', '$businessadr','$bunisessphone','$newid')";
					$result = DbExecuteQuery($conn, $query);

					if($result == True) {
						$regSuccess = 1;
						$errorMsg = "Η εγγραφή σας ήταν επιτυχής, μπορείτε πλέον να συνδεθείτε";
						echo "<script>window.confirm('Σας ευχαριστούμε πολύ για εγγραφή σας, πατείστε ΟΚ για να συνδεθείτε.'); window.location.href='login.php';</script>";
					}
					else
					{
						$errorMsg = "Υπήρξε πρόβλημα κατά την υποβολή των στοιχείων σας.";
					}
				}
				else
					$errorMsg = "Υπήρξε πρόβλημα κατά την υποβολή των στοιχείων σας.";

			}



		}
		else
			$errorMsg = "Υπάρχει ήδη εγγεγραμένος χρήστης με αυτό το όνομα χρήστη";

	}
?>


<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<script>
	//
	  	$('.va-pickers a').click( function() {
	    	$('.va-pickers a').removeClass('active');
	      $(this).addClass('active');
	    });
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
		  background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(assets/images/login.jpg);
		  margin-left: 0px;
		  margin-right: 0px;
		  height: 1700px;
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
	<title>ΕΓΓΡΑΦΗ | ΥΠΑΚΠ</title>

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
		<div id="dynamic-container" class="container" style="word-wrap:break-word; margin-left: 45; background-color: #f4f4f4; border-radius: 20px; margin-top:30px; text-align: center; padding-bottom:50px;">
			<form id="regForm" method="POST" action="signup.php">
			<!-- <h3 style="text-align: center"> Κλείσε ραντεβού</h3> -->
			<!-- One "tab" for each step in the form: -->
				<div class="tab">
				  <h3 style="text-align: center; color:black;">ΕΓΓΡΑΦΗ</h3>
				  <br>
				  <div style="text-align: center;">
				  <span style="color: #2c5aa0;">Συμπλήρωση Στοιχείων</span>
				  <span style="color:black;">  >  Έγκριση</span>
				  </div>
				  <br>


						  <span style="color:<?php if ($regSuccess==1){ echo 'green';} else { echo 'red'; } ?> ;"><?php echo $errorMsg; ?><br> <br></span>

				  <div class="row" style="width: 100%;">
				  	<span class="col-md-6" style="text-align: center; "><label style="color: black;">Όνομα</label> <br><input id="0" placeholder="π.χ. Λάκης" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="fname"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;">Επώνυμο</label> <br><input id="1" placeholder="π.χ. Λαλάκης" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="lname"></span><br>
				    <span class="col-md-12" style="text-align: center;"><label style="color: black;"><br>Όνομα χρήστη</label> <br><input id="2" placeholder="π.χ. lalakis6000" minlength="4" pattern="[a-zA-Z0-9]+$" style="width: 60%;" oninput="this.className = ''" name="uname"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;">Κωδικός</label> <br><input id="3" placeholder="π.χ. abc123!" type="password" minlength="5" oninput="this.className = ''" name="pword"></span>
					<span class="col-md-6" style="text-align: center;"><label style="color: black;">Επαλήθευση κωδικού</label> <br><input id="4" placeholder="π.χ. abc123!" type="password" minlength="5" oninput="this.className = ''" name="notused"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>email</label><br><input id="5" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" class="contact" placeholder="π.χ. email@example.com" oninput="this.className = ''" name="email"></span><br>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>Τηλέφωνο</label><br><input id="6" pattern="69+[0-9]{8,}$" minlength="10" maxlength="10" class="contact" placeholder="π.χ. 6900000000" oninput="this.className = ''" name="phone"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>Α.Μ.Κ.Α.</label><br><input id="7" placeholder="π.χ. 01234567890" pattern="[0-9]{11,}$" maxlength="11" oninput="this.className = ''" name="amka"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>Α.Φ.Μ.</label><br><input id="8" placeholder="π.χ. 12345678" pattern="[0-9]{9,}$" maxlength="9" oninput="this.className = ''" name="afm"></span>

				    <span class="col-md-12" style="text-align: center;">
					   <br><label style="color: black;">Είμαι επιχειρηματίας</label><br>
					   <input type="checkbox" id="check" name="bus_bool">
			   	    </span>

				    <span id="hide1" class="col-md-6 business-option" style="text-align: center; display: none;"><label style="color: black;">Επωνυμία επιχείρησης</label> <br><input id="extra1" class="business-option" style="display: none" placeholder="π.χ. Ντίσνευλαντ Α.Ε." pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="bname"></span>
				    <span id="hide2" class="col-md-6 business-option" style="text-align: center; display: none;"><label style="color: black;">Τηλέφωνο επιχείρησης</label><br><input id="extra2"  class="business-option" style="display: none" placeholder="π.χ. 0000000000" pattern="[0-9]{10,}$" maxlength="10" oninput="this.className = ''" name="bphone"></span>
					<span id="hide3" class="col-md-6 business-option" style="text-align: center; display: none;"><label style="color: black;">Αναγνωριστικό επιχείρησης</label> <br><input id="extra3"  class="business-option" style="display: none" placeholder="π.χ. 0123456789" pattern="[0-9]{10,}$" oninput="this.className = ''" name="bafm"></span>
				    <span id="hide4" class="col-md-6 business-option" style="text-align: center; display: none;"><label style="color: black;">Διεύθυνση επιχείρησης</label> <br><input id="extra4"  class="business-option" style="display: none" placeholder="π.χ. Ουτοπίας 32" oninput="this.className = ''" name="baddress"></span>
				  </div>
				</div>
				<div class="tab">
				  <h3 style="text-align: center; color: black;">ΕΓΓΡΑΦΗ</h3>
				  <div style="text-align: center; color: black;">
				  <span>Συμπλήρωση Στοιχείων</span>
				  <span style="color: #2c5aa0;">  >  Έγκριση</span>
				  </div>
				  <div id="formSummary"></div>
				  <br>
				  <br>
				  <div class="row" style="width: 100%;">
				  	<span class="col-md-6" style="text-align: center;"><label style="color: black;">Όνομα</label><br><input id="00" disabled="disabled"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;">Επώνυμο</label><br><input id="11" disabled="disabled"></span>
				    <span class="col-md-12" style="text-align: center;"><label style="color: black;"><br>Όνομα χρήστη</label><br><input id="22" style="width: 60%;" disabled="disabled"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;">Κωδικός</label> <br><input  id="33" type="password" disabled="disabled"></span>
					<span class="col-md-6" style="text-align: center;"><label style="color: black;">Επαλήθευση κωδικού</label><br><input id="44" type="password" disabled="disabled"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>email</label><br><input id="55" disabled="disabled"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>Τηλέφωνο</label><br><input id="66" disabled="disabled"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>Α.Μ.Κ.Α.</label><br><input id="77" disabled="disabled"></span>
				    <span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>Α.Φ.Μ.</label><br><input id="88" disabled="disabled"></span>

				    <span class="col-md-12" style="text-align: center;">
					   <br><label style="color: black;">Είμαι επιχειρηματίας</label><br>
					   <input disabled="disabled" value="-1" type="checkbox" id="check2" name="bus_bool1">
			   	    </span>

				    <span id="hide12" class="col-md-6 business-option validate" style="text-align: center; display: none;"><label style="color: black;">Επωνυμία επιχείρησης</label> <br><input id="extra12" disabled="disabled"></span>
				    <span id="hide22" class="col-md-6 business-option validate" style="text-align: center; display: none;"><label style="color: black;">Τηλέφωνο επιχείρησης</label><br><input id="extra22" disabled="disabled"></span>
					<span id="hide32" alue="0123456789" class="col-md-6 business-option validate" style="text-align: center; display: none;"><label style="color: black;">Αναγνωριστικό επιχείρησης</label> <br><input id="extra32" disabled="disabled"></span>
				    <span id="hide42" value="abc" class="col-md-6 business-option validate" style="text-align: center; display: none;"><label style="color: black;">Διεύθυνση επιχείρησης</label> <br><input id="extra42" disabled="disabled"></span>
				  </div>
				</div>
				<div style="overflow:auto; ">
				  <div class="col-md-12 text-center">
				  <span id="error-msg2" style="display: none; color: #f01d32; height:15px;">Τα πεδία των κωδικών πρέπει να είναι τα ίδια.</span><br>
				  </div>
				  <div class="row" style="width: 100%;  margin-bottom: 1%;">

					<div class="col-md-3"  style="text-align: center;">
  			        <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary" style="margin-top: 3px; margin-bottom: 3px;">Προηγούμενο</button>
  			        </div>

				    <!-- <div class="col-md-12 text-center">
					  <span id="error-msg" style="display: none; color: #f01d32; height:15px;">Παρακαλώ δείτε ξανά τα κοκκινισμένα πεδία.</span>
					</div> -->
					<div class="col-md-6 text-center">
			          <span id="error-msg" style="display: none; color: #f01d32; height:15px;">Παρακαλώ δείτε ξανά τα κοκκινισμένα πεδία.</span>
			        </div>
					<br>

					<div class="col-md-3" style="margin-top: 3px; text-align: center;">
				   	   <button type="button" id="nextBtn" onclick="matchPasswords()" class="btn btn-primary" style="margin-bottom: 5px;">
				   		 Επόμενο Βήμα
				   	   </button>
			          <button type="submit" id="submitbut" class="btn btn-primary" style="height: 107%;" name ="submitter">
			            Οριστική υποβολή
			          </button>
				   	</div>

				  </div>
			    </div>
			  <!-- </div> -->
			  <div style="text-align:center;margin-top:40px;">
			    <span class="step"></span>
			    <span class="step"></span>
			  </div>
		   </form>
	  </div>
	</div>
		</div>
	</div>

	<?php include 'footer.php';?>

</body>
<!--  -->
<script src="assets/js/jquery-2.1.0.min.js"></script>
<script src="assets/js/main.js"></script>

<script>

function matchPasswords() {

	var pw1 = document.getElementById("3");
	var pw2 = document.getElementById("4");
	var errorBox = document.getElementById("error-msg2");

	if(pw1.value != pw2.value) {

		// console.log("Passwords did not match");
		pw1.value = "";
		pw2.value = "";

		errorBox.style.display = "inline";

	} else {

		errorBox.style.display = "none";

	}

	nextPrev(1);

}

</script>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "inline";
    //... and fix the Previous/Next buttons:
    document.getElementById("submitbut").style.display = "none";

	document.getElementById("check").value = "0";

    if (n == 0) {

        document.getElementById("prevBtn").style.display = "none";

    } else {

        document.getElementById("prevBtn").style.display = "inline";

    }

    if (n == (x.length - 1)) {
     // document.getElementById("nextBtn").innerHTML = "Οριστική Υποβολή";
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("submitbut").style.display = "inline";
    // else if (n == x.length)
    //     {
    //         document.getElementById("nextBtn").type = "submit";
    //      document.getElementById("nextBtn").type = "button";
    //     }
    } else {
        // document.getElementById("nextBtn").innerHTML = "Επόμενο Βήμα";
         document.getElementById("nextBtn").style.display = "inline";

    }

    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n);

}

function nextPrev(n) {
	// This function will figure out which tab to display
	var x = document.getElementsByClassName("tab");
	// Exit the function if any field in the current tab is invalid:
	validationStatus = validateForm();
	console.log("---");
	console.log(validationStatus);
	if (n == 1 && !validationStatus) return false;
	// Hide the current tab:
	x[currentTab].style.display = "none";
	// Increase or decrease the current tab by 1:
	currentTab = currentTab + n;
	// if you have reached the end of the form...
	if (currentTab == x.length - 1) {
		 // debugger;
		 form = document.getElementById("regForm");
		 showSummury = document.getElementById("formSummary");
		 getFormSummaryHtml();
		 // debugger;
		 // showSummury.innerHTML = html;
	} else if (currentTab >= x.length) {

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
		// If a field is empty or red and it is not disabled...
		if ((y[i].value == "" || window.getComputedStyle(y[i]).getPropertyValue("background-color") === "rgb(255, 221, 221)") && y[i].style.display != "none" && !y[i].classList.contains("validate") && !y[i].disabled) {
			// add an "invalid" class to the field:
			console.log("??");
			console.log(y[i].value);
			console.log(y[i].style.display);
			y[i].classList.add("invalid");
			// and set the current valid status to false
			valid = false;

			k.style.display ="inline";
			// console.log(y[i].value);
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

	document.getElementById("00").value = document.getElementById("0").value;
	document.getElementById("11").value = document.getElementById("1").value;
	document.getElementById("22").value = document.getElementById("2").value;
	document.getElementById("33").value = document.getElementById("3").value;
	document.getElementById("44").value = document.getElementById("4").value;
	document.getElementById("55").value = document.getElementById("5").value;
	document.getElementById("66").value = document.getElementById("6").value;
	document.getElementById("77").value = document.getElementById("7").value;
	document.getElementById("88").value = document.getElementById("8").value;

	document.getElementById("check2").checked = document.getElementById("check").checked;
	document.getElementById("check2").value = "0";
	document.getElementById("check").value = "0";
	// console.log(document.getElementById("check").checked);
	// console.log(document.getElementById("check2").checked);

	if(document.getElementById("check").checked) {
		debugger;
		document.getElementById("check").value = "1";
		document.getElementById("check2").value = "1";

		document.getElementById("hide12").style.display = "inline";
		document.getElementById("hide22").style.display = "inline";
		document.getElementById("hide32").style.display = "inline";
		document.getElementById("hide42").style.display = "inline";

		document.getElementById("extra12").value = document.getElementById("extra1").value;
		document.getElementById("extra22").value = document.getElementById("extra2").value;
		document.getElementById("extra32").value = document.getElementById("extra3").value;
		document.getElementById("extra42").value = document.getElementById("extra4").value;

	} else {
debugger;
		document.getElementById("check").value = "0";
		document.getElementById("hide12").style.display = "none";
		document.getElementById("hide22").style.display = "none";
		document.getElementById("hide32").style.display = "none";
		document.getElementById("hide42").style.display = "none";

	}

}
function getDate() {

document.getElementById('date-picker').valueAsDate = new Date();
// document.getElementById('date-picker').setAttribute("min",new Date());
}
</script>

<script>
document.getElementById('check').onchange = function() {

    bussinessElements = document.getElementsByClassName("business-option");

	if(document.getElementById("check").checked) {

		// for(i = 0 ; i < bussinessElements.length ; i++) {
		//
		// 	bussinessElements[i].style.display = "block";
		//
		// }
		document.getElementById("check").value = "1";
		document.getElementById('extra1').style.display = "inline";
		document.getElementById('extra2').style.display = "inline";
		document.getElementById('extra3').style.display = "inline";
		document.getElementById('extra4').style.display = "inline";

		document.getElementById('hide1').style.display = "inline";
		document.getElementById('hide2').style.display = "inline";
		document.getElementById('hide3').style.display = "inline";
		document.getElementById('hide4').style.display = "inline";

		// document.getElementById('check').value = 1;

	} else {

		// for(i = 0 ; i < bussinessElements.length ; i++) {
		//
		// 	bussinessElements[i].style.display = "none";
		//
		// }
		document.getElementById("check").value = "0";
		document.getElementById('extra1').style.display = "none";
		document.getElementById('extra2').style.display = "none";
		document.getElementById('extra3').style.display = "none";
		document.getElementById('extra4').style.display = "none";

		document.getElementById('hide1').style.display = "none";
		document.getElementById('hide2').style.display = "none";
		document.getElementById('hide3').style.display = "none";
		document.getElementById('hide4').style.display = "none";


		// document.getElementById('check').value = 0;

		document.getElementById('extra1').classList.remove("invalid");
		document.getElementById('extra2').classList.remove("invalid");
		document.getElementById('extra3').classList.remove("invalid");
		document.getElementById('extra4').classList.remove("invalid");

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
