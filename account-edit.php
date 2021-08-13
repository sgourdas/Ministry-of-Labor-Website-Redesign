<!-- $_SESSION["usr_act_id"] == 1 -> Epixeirish
== 0 -> Ergazomenos -->
<?php

	require_once("db.php");

	$loginCheck = 0;
	if (isset($_SESSION['usr_id'])) {

		if ($_SESSION['usr_id'] != '') {
			$loginCheck = 1;
		}
	}

?>

<form id="regForm" method="POST" action="account.php">
	<!-- <h3 style="text-align: center"> Κλείσε ραντεβού</h3> -->
	<!-- One "tab" for each step in the form: -->
	<div class="tab">
		<h3 style="text-align: center; color:black;">Επεξεργασία Λογαριασμού</h3>
		<br>
		<div style="text-align: center;">
			<span style="color: #2c5aa0;">Στοιχεία</span>
			<span style="color:black;"> > Έγκριση Αλλαγής</span>
		</div>
		<br>
		<br>
		<div class="row" style="width: 100%;">
			<span class="col-md-6" style="text-align: center; "><label style="color: black;">Όνομα</label> <br><input id="0" placeholder="π.χ. Λάκης" value="<?php if($loginCheck) echo $_SESSION['usr_name']; ?>" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="fname"></span>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;">Επώνυμο</label> <br><input id="1" placeholder="π.χ. Λαλάκης" value="<?php if($loginCheck) echo $_SESSION['usr_surname']; ?>" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="lname"></span><br>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;">Κωδικός</label> <br><input id="3" placeholder="π.χ. abc123!" value="<?php if($loginCheck) echo $_SESSION['usr_password']; ?>" type="password" minlength="5" oninput="this.className = ''" name="password"></span>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;">Επαλήθευση κωδικού</label> <br><input id="4" placeholder="π.χ. abc123!" value="<?php if($loginCheck) echo $_SESSION['usr_password']; ?>" type="password" minlength="5" oninput="this.className = ''" name="notused"></span>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>email</label><br><input id="5" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php if($loginCheck) echo $_SESSION['usr_email']; ?>" type="email" class="contact" placeholder="π.χ. email@example.com" oninput="this.className = ''" name="email"></span><br>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>Τηλέφωνο</label><br><input id="6" pattern="69+[0-9]{8,}$" minlength="10" maxlength="10" value="<?php if($loginCheck) echo $_SESSION['usr_phone']; ?>" class="contact" placeholder="π.χ. 6900000000" oninput="this.className = ''" name="phone"></span>
			<?php if($_SESSION["usr_act_id"] == 0) { ?>
				<span class="col-md-12" style="text-align: center;">
					<br><label style="color: black;">Μετατροπή σε επιχειρησιακό λογαριασμό</label><br>
					<input value="0" type="checkbox" id="check" name="bus_bool">
				</span>
			<?php } ?>
			<span id="hide1" class="col-md-6 business-option" style="text-align: center; display: none;"><br><label style="color: black;">Επωνυμία επιχείρησης</label> <br><input id="extra1" class="business-option" style="display: none" placeholder="π.χ. Ντίσνευλαντ Α.Ε." pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="bname" value="<?php if($loginCheck) if($_SESSION["usr_act_id"] == 1) echo $_SESSION['bsn_name']; ?>"></span>
			<span id="hide2" class="col-md-6 business-option" style="text-align: center; display: none;"><br><label style="color: black;">Τηλέφωνο επιχείρησης</label><br><input id="extra2" class="business-option" style="display: none" placeholder="π.χ. 0000000000" pattern="[0-9]{10,}$" maxlength="10" oninput="this.className = ''" name="bphone" value="<?php if($loginCheck) if($_SESSION["usr_act_id"] == 1) echo $_SESSION['bsn_phone']; ?>"></span>
			<span id="hide3" class="col-md-6 business-option" style="text-align: center; display: none;"><label style="color: black;">Αναγνωριστικό επιχείρησης</label> <br><input id="extra3" class="business-option" style="display: none" placeholder="π.χ. 0123456789" pattern="[0-9]{10,}$" oninput="this.className = ''" name="bafm" value="<?php if($loginCheck) if($_SESSION["usr_act_id"] == 1) echo $_SESSION['bsn_afm']; ?>"></span>
			<span id="hide4" class="col-md-6 business-option" style="text-align: center; display: none;"><label style="color: black;">Διεύθυνση επιχείρησης</label> <br><input id="extra4" class="business-option" style="display: none" placeholder="π.χ. Ουτοπίας 32" oninput="this.className = ''" name="baddr" value="<?php if($loginCheck) if($_SESSION["usr_act_id"] == 1) echo $_SESSION['bsn_address']; ?>"></span>
			<?php if($_SESSION["usr_act_id"] == 1) { ?>
				<span class="col-md-12" style="text-align: center;">
					<br><label style="color: black;">Μετατροπή σε λογαριασμό εργαζομένου</label><br>
					<input type="checkbox" id="2check" onclick="typeChange()" name="bus_bool2">
					<script>
						document.getElementById('extra1').style.display = "inline";
						document.getElementById('extra2').style.display = "inline";
						document.getElementById('extra3').style.display = "inline";
						document.getElementById('extra4').style.display = "inline";

						document.getElementById('hide1').style.display = "inline";
						document.getElementById('hide2').style.display = "inline";
						document.getElementById('hide3').style.display = "inline";
						document.getElementById('hide4').style.display = "inline";
					</script>
				</span>
			<?php } ?>
		</div>
	</div>
	<div class="tab">
		<h3 style="text-align: center; color: black;">Επεξεργασία Λογαριασμού</h3>
		<br>
		<div style="text-align: center; color: black;">
			<span>Στοιχεία</span>
			<span style="color: #2c5aa0;"> > Έγκριση Αλλαγής</span>
		</div>
		<div id="formSummary"></div>
		<br>
		<br>
		<div class="row" style="width: 100%;">
			<span class="col-md-6" style="text-align: center;"><label style="color: black;">Όνομα</label><br><input id="00" disabled="disabled"></span>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;">Επώνυμο</label><br><input id="11" disabled="disabled"></span>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;">Κωδικός</label> <br><input id="33" type="password" disabled="disabled"></span>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;">Επαλήθευση κωδικού</label><br><input id="44" type="password" disabled="disabled"></span>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>email</label><br><input id="55" disabled="disabled"></span>
			<span class="col-md-6" style="text-align: center;"><label style="color: black;"><br>Τηλέφωνο</label><br><input id="66" disabled="disabled"></span>
			<?php if($_SESSION["usr_act_id"] == 0) { ?>
			<span class="col-md-12" style="text-align: center;">
				<br><label style="color: black;">Μετατροπή σε επιχειρησιακό λογαριασμό</label><br>
				<input disabled="disabled" value="-1" type="checkbox" id="check2">
			</span>
			<?php } ?>
			<span id="hide12" class="col-md-6 business-option validate" style="text-align: center; display: none;"><label style="color: black;">Επωνυμία επιχείρησης</label> <br><input  id="extra12" disabled="disabled"></span>
			<span id="hide22" class="col-md-6 business-option validate" style="text-align: center; display: none;"><label style="color: black;">Τηλέφωνο επιχείρησης</label><br><input id="extra22" disabled="disabled"></span>
			<span id="hide32" alue="0123456789" class="col-md-6 business-option validate" style="text-align: center; display: none;"><label style="color: black;">Αναγνωριστικό επιχείρησης</label> <br><input id="extra32" disabled="disabled"></span>
			<span id="hide42" value="abc" class="col-md-6 business-option validate" style="text-align: center; display: none;"><label style="color: black;">Διεύθυνση επιχείρησης</label> <br><input id="extra42" disabled="disabled"></span>
			<?php if($_SESSION["usr_act_id"] == 1) { ?>
				<span class="col-md-12" style="text-align: center;">
					<br><label style="color: black;">Μετατροπή σε λογαριασμό εργαζομένου</label><br>
					<input disabled="disabled" type="checkbox" id="2check2">
				</span>
			<?php } ?>
		</div>
	</div>
	<div style="overflow:auto; ">
		<div class="col-md-12 text-center">
			<span id="error-msg2" style="display: none; color: #f01d32; height:15px;">Τα πεδία των κωδικών πρέπει να είναι τα ίδια.</span><br>
		</div>
		<div class="row" style="width: 100%;  margin-bottom: 1%;">
			<div class="col-md-3" style="text-align: center;">
				<button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary" style="margin-top: 3px; margin-bottom: 3px;">Προηγούμενο</button>
			</div>
			<div class="col-md-6 text-center">
				<span id="error-msg" style="display: none; color: #f01d32; height:15px;">Παρακαλώ δείτε ξανά τα κοκκινισμένα πεδία.</span>
			</div>
			<br>
			<div class="col-md-3" style="margin-top: 3px; text-align: center;">
				<button type="button" id="nextBtn" onclick="matchPasswords()" class="btn btn-primary" style="margin-bottom: 5px;">
					Επόμενο Βήμα
				</button>
				<button type="submit" id="submitbut" class="btn btn-primary" style="height: 107%;" name=" submitter">Οριστική υποβολή</button>
			</div>
		</div>
	</div>
	<div style="text-align:center;margin-top:40px;">
		<span class="step"></span>
		<span class="step"></span>
	</div>
</form>

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

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "inline";
    //... and fix the Previous/Next buttons:
    document.getElementById("submitbut").style.display = "none";

	// document.getElementById("check").value = "0";

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
	document.getElementById("33").value = document.getElementById("3").value;
	document.getElementById("44").value = document.getElementById("4").value;
	document.getElementById("55").value = document.getElementById("5").value;
	document.getElementById("66").value = document.getElementById("6").value;
	// document.getElementById("check2").value = "0";
	// document.getElementById("check").value = "0";
	// console.log(document.getElementById("check").checked);
	// console.log(document.getElementById("check2").checked);
	<?php if($_SESSION["usr_act_id"] == 0) { ?>
		document.getElementById("check2").checked = document.getElementById("check").checked;

		if(document.getElementById("check").checked) {
	<?php } else if($_SESSION["usr_act_id"] == 1) { ?>
		document.getElementById("2check2").checked = document.getElementById("2check").checked;

		if(!document.getElementById("2check").checked) {
	<?php } ?>

		// document.getElementById("check").value = "1";
		// document.getElementById("check2").value = "1";

		document.getElementById("hide12").style.display = "inline";
		document.getElementById("hide22").style.display = "inline";
		document.getElementById("hide32").style.display = "inline";
		document.getElementById("hide42").style.display = "inline";

		document.getElementById("extra12").value = document.getElementById("extra1").value;
		document.getElementById("extra22").value = document.getElementById("extra2").value;
		document.getElementById("extra32").value = document.getElementById("extra3").value;
		document.getElementById("extra42").value = document.getElementById("extra4").value;

	} else {

		// document.getElementById("check").value = "0";
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
<?php if($_SESSION["usr_act_id"] == 0) { ?>
document.getElementById('check').onchange = function() {

	if(document.getElementById("check").checked) {

		document.getElementById('extra1').style.display = "inline";
		document.getElementById('extra2').style.display = "inline";
		document.getElementById('extra3').style.display = "inline";
		document.getElementById('extra4').style.display = "inline";

		document.getElementById('hide1').style.display = "inline";
		document.getElementById('hide2').style.display = "inline";
		document.getElementById('hide3').style.display = "inline";
		document.getElementById('hide4').style.display = "inline";

		document.getElementById('extra12').style.display = "inline";
		document.getElementById('extra22').style.display = "inline";
		document.getElementById('extra32').style.display = "inline";
		document.getElementById('extra42').style.display = "inline";

		document.getElementById('hide12').style.display = "inline";
		document.getElementById('hide22').style.display = "inline";
		document.getElementById('hide32').style.display = "inline";
		document.getElementById('hide42').style.display = "inline";

	} else {

		document.getElementById('extra1').style.display = "none";
		document.getElementById('extra2').style.display = "none";
		document.getElementById('extra3').style.display = "none";
		document.getElementById('extra4').style.display = "none";

		document.getElementById('hide1').style.display = "none";
		document.getElementById('hide2').style.display = "none";
		document.getElementById('hide3').style.display = "none";
		document.getElementById('hide4').style.display = "none";

		document.getElementById('extra12').style.display = "none";
		document.getElementById('extra22').style.display = "none";
		document.getElementById('extra32').style.display = "none";
		document.getElementById('extra42').style.display = "none";

		document.getElementById('hide12').style.display = "none";
		document.getElementById('hide22').style.display = "none";
		document.getElementById('hide32').style.display = "none";
		document.getElementById('hide42').style.display = "none";

		document.getElementById('extra1').classList.remove("invalid");
		document.getElementById('extra2').classList.remove("invalid");
		document.getElementById('extra3').classList.remove("invalid");
		document.getElementById('extra4').classList.remove("invalid");

	}

};
<?php } ?>
<?php if($_SESSION["usr_act_id"] == 1) { ?>
function typeChange() {

	console.log("321313123!");
	if(!document.getElementById("2check").checked) {

		// document.getElementById("check").value = "1";
		document.getElementById('extra1').style.display = "inline";
		document.getElementById('extra2').style.display = "inline";
		document.getElementById('extra3').style.display = "inline";
		document.getElementById('extra4').style.display = "inline";

		document.getElementById('hide1').style.display = "inline";
		document.getElementById('hide2').style.display = "inline";
		document.getElementById('hide3').style.display = "inline";
		document.getElementById('hide4').style.display = "inline";

	} else {

		// document.getElementById("check").value = "0";
		document.getElementById('extra1').style.display = "none";
		document.getElementById('extra2').style.display = "none";
		document.getElementById('extra3').style.display = "none";
		document.getElementById('extra4').style.display = "none";

		document.getElementById('hide1').style.display = "none";
		document.getElementById('hide2').style.display = "none";
		document.getElementById('hide3').style.display = "none";
		document.getElementById('hide4').style.display = "none";

		document.getElementById('extra1').classList.remove("invalid");
		document.getElementById('extra2').classList.remove("invalid");
		document.getElementById('extra3').classList.remove("invalid");
		document.getElementById('extra4').classList.remove("invalid");

	}

};
<?php } ?>
</script>
<!-- <script src="assets/js/wizard-js/jquery-3.3.1.min.js"></script> -->

<!-- JQUERY STEP -->
<script src="assets/js/wizard-js/jquery.steps.js"></script>

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
