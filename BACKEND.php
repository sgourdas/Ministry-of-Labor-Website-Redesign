<?php

$errorCode = 0;
$errorMsg = '';
if (!empty($_POST))
{
	$hn = 'localhost';
	$db = 'devwebtopgrdb';
	$un = 'devwebtopgrusr';
	$pw = 'Dv$rvDm?2bFyebQ9';
	$conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
		die ($conn->connect_error);
		$errorCode = 1;
	}
	$conn->set_charset("utf8mb4");
    // print_r($_POST);
    $isBusiness = $_POST['bus_bool'];

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


// }
	if ($errorCode != 1) {
	    $query = "INSERT INTO User (usr_username, usr_password, usr_email, usr_name, usr_surname, usr_phone, usr_amka_id, usr_afm_id) VALUES ('$username', '$password', '$emailstr','$firstname','$lastname','$phonestr','$amkastr','$afmstr')";
	    if ($conn->query($query) === TRUE) {
	      // echo "New record created successfully";
		  if ($isBusiness == 0) {
			  header("Location: https://dev.webtop.gr/submission.php");
			  die();
		  }
	    }
		else {
	      	$errorCode = 2;
	    }
	    // printf ("New Record has id %d.\n", $conn->insert_id);
	    $newid = $conn->insert_id;
	    // if ($isBusiness == 1)
	    // {
	    // echo "OK";
	    ini_set("display_errors", 1); 		error_reporting(E_ALL);
		if ($errorCode != 2) {
		    if ($isBusiness == 1 && $errorCode ==0) {
		        $query = "INSERT INTO Business (bsn_afm, bsn_name, bsn_address, bsn_phone, bsn_usr_id) VALUES ('$businessafm', '$bunisessname', '$businessadr','$bunisessphone','$newid')";
		        if ($conn->query($query) === TRUE) {
		          	header("Location: https://dev.webtop.gr/submission.php");
					die();
		        } else {
			         $errorCode = 3;
		        }
		    }
		}
	}
	if ($errorCode == 1) {
		$errorMsg = 'PROBLIMA ME SERBBERRR';

		// exit();
	}
	if ($errorCode == 2) {
		$errorMsg = 'To username iparxei idi';
	}
	if ($errorCode == 3) {
		$errorMsg = 'Yparxei idi eggegramenos stin epixeirhsh, parakalw epilejte allh';
	}
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

	<div style="background-image: url('https://wonderfulengineering.com/wp-content/uploads/2014/06/gear-wallpaper-23-610x457.jpg'); background-size: cover; height:179px; padding-top: -160px;">
		<section style="text-align: center; padding-top: 65px; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; color: #fff; font-size: 90px; font-weight: 300px; letter-spacing: 6px">
			<h1>ΕΓΓΡΑΦΗ</h1>
		</section>
	</div>

	<div class="row" style="width: 100%; margin-bottom: 20px;">
		<div id="dynamic-container" class="container" style="word-wrap:break-word; margin-left: 45; background-color: #f4f4f4; border-radius: 20px; margin-top:30px; text-align: center; padding-bottom:50px;">
			<form id="regForm" method="POST" action="BACKEND.php">
			<!-- <h3 style="text-align: center"> Κλείσε ραντεβού</h3> -->
			<!-- One "tab" for each step in the form: -->
				<div class="tab">
				  <h3 style="text-align: center">ΕΓΓΡΑΦΗ</h3>
				  <br>
				  <br>
				  <div class="row" style="width: 100%;">
				  	<span class="col-md-6" style="text-align: center;"><label>Όνομα</label> <br><input placeholder="π.χ. Λάκης"  oninput="this.className = ''" name="fname"></span>
				    <span class="col-md-6" style="text-align: center;"><label>Επώνυμο</label> <br><input placeholder="π.χ. Λαλάκης"  oninput="this.className = ''" name="lname"></span>
				    <span class="col-md-6" style="text-align: center;"><label>Όνομα χρήστη</label> <br><input placeholder="π.χ. lalakis6000" oninput="this.className = ''" name="uname"></span>
				    <span class="col-md-6" style="text-align: center;"><label>Κωδικός</label> <br><input placeholder="π.χ. abc123!"  oninput="this.className = ''" name="pword"></span>
				    <span <span class="col-md-6" style="text-align: center;"><label>email</label><br><input  type="email" class="contact" placeholder="π.χ. email@example.com" oninput="this.className = ''" name="email"></span>
				    <span class="col-md-6" style="text-align: center;"><label>Τηλέφωνο</label><br><input  class="contact" placeholder="π.χ. 6900000000" oninput="this.className = ''" name="phone"></span>
				    <span class="col-md-6" style="text-align: center;"><label>Α.Μ.Κ.Α.</label><br><input placeholder="π.χ. 01234567890"  oninput="this.className = ''" name="amka"></span>
				    <span class="col-md-6" style="text-align: center;"><label>Α.Φ.Μ.</label><br><input placeholder="π.χ. 12345678"  oninput="this.className = ''" name="afm"></span>

				    <span class="col-md-12" style="text-align: center;">
					   <br><label>Είμαι επιχειρηματίας</label><br>
					   <?php if (!empty($errorMsg)) { ?>
							   <span> Testt<?php echo $errorMsg; ?> </span>
					   <?php } ?>
					   <input type="checkbox" id="check" value="0" name="bus_bool">
			   	    </span>

				    <span class="col-md-6 business-option" style="text-align: center; display:none;"><label>Επωνυμία επιχείρησης</label> <br><input placeholder="π.χ. Ντίσνευλαντ Α.Ε."  oninput="this.className = ''" name="bname"></span>
				    <span class="col-md-6 business-option" style="text-align: center; display:none;"><label>Τηλέφωνο επιχείρησης</label><br><input pattern="2+[0-9]{9,}$" class="contact" placeholder="π.χ. 6900000000" oninput="this.className = ''" name="bphone"></span>
					<span class="col-md-6 business-option" style="text-align: center; display:none;"><label>Αναγνωριστικό επιχείρησης</label> <br><input placeholder="π.χ. 0123456789"  oninput="this.className = ''" name="bafm"></span>
				    <span class="col-md-6 business-option" style="text-align: center; display:none;"><label>Διεύθυνση επιχείρησης</label> <br><input placeholder="π.χ. Ουτοπίας 32" oninput="this.className = ''" name="baddress"></span>
				  </div>
				</div>
				<div style="overflow:auto; ">
				  <div class="row" style="width: 100%;  margin-bottom: 1%;">
				    <div class="col-md-6 text-center">
					  <span id="error-msg" style="display: none; color: #f01d32; height:15px;">Παρακαλώ δείτε ξανά τα κοκκινισμένα πεδία.</span>
					</div>
					<div class="col-md-12" style="margin-top: 3px; text-align: center;">
					  <button type="submit" id="nextBtn" onclick="nextPrev(1)" class="btn btn-primary" style="margin-bottom: 5px;  width:50%;">
					  Εγγραφή
					  </button>
				    </div>
				  </div>
			    </div>
			  </div>
		   </form>
	  </div>
	</div>

	<?php include 'footer.php';?>

</body>
<!--  -->
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
	 if (y[i].value == "" && y[i].disabled == false && y[i] != document.getElementById("carsInput1")) {
		 // console.log(y[i]);
	   // add an "invalid" class to the field:
	   y[i].className += " invalid";
	   // and set the current valid status to false
	   valid = false;

	   k.style.display ="inline";

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
	return html; // return the valid status
	}
	function carsComboChange() {
	input = document.getElementById('carsInput1');
	combo = document.getElementById('cars');
	value = combo.options[combo.selectedIndex].value;
	input.value = value;
}
</script>

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













<?php
    echo "Hello World!";
    echo '<br>';
    $hn = 'localhost';
    $db = 'devwebtopgrdb';
    $un = 'devwebtopgrusr';
    $pw = 'Dv$rvDm?2bFyebQ9';


    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die ($conn->connect_error);
    echo 'OK';
    echo '<br>';
    $query = 'SELECT * FROM User';
    $result = $conn->query($query);
    if (!$result) die ($conn->error);
    $rows = $result->num_rows;
    echo "rows: $rows<br>";
    while ($row = $result->fetch_object()) {
?>
<p>Id: <?php echo $row->usr_id;?></p>
<p>Name: <?php echo $row->usr_name;?></p>
<?php
    }
    echo 'OK2';

    echo '<br>';
    // $query = "INSERT INTO User (usr_username, usr_name) VALUES ('Dimitrios', 'john@example.com')";
    //
    // if ($conn->query($query) === TRUE) {
    //   echo "New record created successfully";
    // } else {
    //   echo "Error: " . $query . "<br>" . $conn->error;
    // }
?>
<form method="POST" action="sub.php">
    <input type="text" name="username">
    <input type="text" name="name">
    <input type="submit" name="submit" value="Register">
</form>
