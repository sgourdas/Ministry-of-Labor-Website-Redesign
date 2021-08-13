<?php
require_once("db.php");

$sessionFlag = 0;
if ($_SESSION["usr_act_id"] == 1)
	$sessionFlag = 1;

if ($_SESSION["usr_act_id"] == 0)
	$sessionFlag = 2;

if ($_SESSION["usr_act_id"] == '')
	$sessionFlag = 0;
?>

<?php if ($sessionFlag == 1) { ?>
	<form id="regForm" method="POST" action="/business.php">
		<script type="text/javaScript">
			function myFunction() {
				var element = document.getElementById("business-sel");
				element.classList.add("active");
			}
			myFunction();
		</script>
		<!-- <h3 style="text-align: center"> Κλείσε ραντεβού</h3> -->
		<!-- One "tab" for each step in the form: -->
		<div class="tab">
			<h3 style="text-align: center">Δηλώση Προσωπικού</h3>
			<br>
			<div style="text-align: center;">
				<span style="color: #2c5aa0;">Συμπλήρωση Φόρμας</span>
				<span> > Υποβολή</span>
			</div>
			<br>
			<br>
			<div class="row" style="width: 100%;">
				<span class="col-md-6" style="text-align: center;"><label>Αναγνωριστικό επιχείρησης</label> <br><input id="00" value="<?php echo $_SESSION["bsn_afm"]; ?>" placeholder="π.χ. 0123456789" pattern="[0-9]{10,}$" oninput="this.className = ''" name="bafm"></span>
				<span class="col-md-6" style="text-align: center"><label>Είδος δήλωσης</label>
					<br>
					<select id="cars" name="adeia" onChange="carsComboChange();">
						<option value="0">Ενεργός</option>
						<option value="1">Πρόσληψη</option>
						<option value="2">Απόλυση</option>
						<option value="3">Αναστολή</option>
						<option value="4">Άδεια Γενικού Σκοπού</option>
						<option value="7">Άδεια Ειδικού Σκοπού</option>
						<option value="5">Άδεια Γονική</option>
						<option value="8">Άδεια Κυοφορίας</option>
						<option value="6">Τηλεργασία</option>
					</select>
					<input value="1" id="carsInput1" type="hidden" oninput="this.className = ''" name="carsInput">
				</span>
				<span class="col-md-6" style="text-align: center;"><label>Όνομα εργαζομένου</label> <br><input id="11" placeholder="π.χ. Λάκης" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="fname"></span>
				<span class="col-md-6" style="text-align: center;"><label>Επίθετο εργαζομένου</label><br><input id="22" placeholder="π.χ. Λαλάκης" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="lname"></span>
				<span class="col-md-6" style="text-align: center;"><label>Α.Μ.Κ.Α. εργαζομένου</label><br><input id="33" placeholder="π.χ. 01234567890" pattern="[0-9]{11,}$" maxlength="11" oninput="this.className = ''" name="amka"></span>
				<span class="col-md-6" style="text-align: center;"><label>Α.Φ.Μ. εργαζομένου</label><br><input id="44" placeholder="π.χ. 12345678" pattern="[0-9]{9,}$" maxlength="9" oninput="this.className = ''" name="afm"></span>
				<span class="col-md-6" style="text-align: center;">
					<label>Επιλέξτε ημερομηνία έναρξης</label><br>
					<!-- onClick="getDate();" -->
					<input id="55" class="contact" type="date" min="2021-00-00" max="2025-12-31" oninput="this.className = ''" name="startDate">
				</span>
				<span class="col-md-6" style="text-align: center;">
					<label>Επιλέξτε ημερομηνία λήξης</label><br>
					<!-- onClick="getDate();" -->
					<input class="contact" type="date" id="end-date" min="2021-00-00" max="2025-12-31" oninput="this.className = ''" name="endDate" onChange="carsComboChange();">
				</span>
				<span class="col-md-12" style="text-align: center;">
					<br><label> Άνευ αορίστου</label><br>
					<input type="checkbox" id="check" name="checkBox">
				</span>
			</div>
		</div>
		<div class="tab">
			<h3 style="text-align: center">Έλεγχος Στοιχείων</h3>
			<div style="text-align: center;">
				<span>Συμπλήρωση Φόρμας</span>
				<span style="color: #2c5aa0;"> > Υποβολή</span>
			</div>
			<div id="formSummary"></div>
			<br>
			<br>
			<div class="row" style="width: 100%;">
				<span class="col-md-6" style="text-align: center;"><label>Αναγνωριστικό επιχείρησης</label> <br><input id="0" disabled="disabled" placeholder="π.χ. 0123456789" pattern="[0-9]{10,}$" oninput="this.className = ''" name="fnamje"></span>
				<span class="col-md-6" style="text-align: center"><label>Είδος δήλωσης</label>
					<br>
					<select id="cars2" disabled="disabled">
						<option value="value0">Ενεργός</option>
						<option value="value1">Πρόσληψη</option>
						<option value="value2">Απόλυση</option>
						<option value="value3">Αναστολή</option>
						<option value="value1">Άδεια Γενικού Σκοπού</option>
						<option value="value1">Άδεια Ειδικού Σκοπού</option>
						<option value="value2">Άδεια Γονική</option>
						<option value="value3">Άδεια Κυοφορίας</option>
						<option value="value6">Τηλεργασία</option>
					</select>
					<input id="carsInput2" type="hidden" oninput="this.className = ''" name="carsInput">
				</span>
				<span class="col-md-6" style="text-align: center;"><label>Όνομα εργαζομένου</label> <br><input id="1" disabled="disabled" placeholder="π.χ. Λάκης" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="fnakme"></span>
				<span class="col-md-6" style="text-align: center;"><label>Επίθετο εργαζομένου</label><br><input id="2" disabled="disabled" placeholder="π.χ. Λαλάκης" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" maxlength="11" oninput="this.className = ''" name="fkname"></span>
				<span class="col-md-6" style="text-align: center;"><label>Α.Μ.Κ.Α. εργαζομένου</label><br><input id="3" disabled="disabled" placeholder="π.χ. 01234567890" pattern="[0-9]{11,}$" oninput="this.className = ''" name="lnamge"></span>
				<span class="col-md-6" style="text-align: center;"><label>Α.Φ.Μ. εργαζομένου</label><br><input id="4" disabled="disabled" placeholder="π.χ. 12345678" pattern="[0-9]{9,}$" maxlength="9" oninput="this.className = ''" name="fnafme"></span>
				<span class="col-md-6" style="text-align: center;">
					<label>Επιλέξτε ημερομηνία έναρξης</label><br>
					<!-- onClick="getDate();" -->
					<input id="5" disabled="disabled" class="contact" type="date" min="2021-00-00" max="2025-12-31" oninput="this.className = ''" name="fnlame">
				</span>
				<span class="col-md-6" style="text-align: center;">
					<label>Επιλέξτε ημερομηνία λήξης</label><br>
					<!-- onClick="getDate();" -->
					<input disabled="disabled" class="contact" type="date" id="end-date2" min="2021-00-00" max="2025-12-31" oninput="this.className = ''" name="fkjname" onChange="carsComboChange();">
				</span>
				<span class="col-md-12" style="text-align: center;">
					<br><label> Άνευ αορίστου</label><br>
					<input disabled="disabled" type="checkbox" id="check2">
				</span>
			</div>
		</div>
		<div style="overflow:auto; ">
			<div class="row" style="width: 100%;  margin-bottom: 1%;">
				<!-- <div style="float:left; margin-top: 15px;"> -->
				<div class="col-md-3" style="text-align: center;">
					<button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary" style="margin-top: 3px; margin-bottom: 3px;">Προηγούμενο</button>
				</div>
				<!-- </div> -->
				<!-- <div style="float:center; text-align: center; margin-top: 15px; display: block;"> -->
				<div class="col-md-6 text-center">
					<span id="error-msg" style="display: none; color: #f01d32; height:15px;">Παρακαλώ δείτε ξανά τα κοκκινισμένα πεδία.</span>
				</div>
				<!-- </div> -->

				<!-- <div style="float:right; margin-top: 15px;"> -->
				<div class="col-md-3" style="margin-top: 3px; text-align: center;">
					<button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-primary" style="margin-bottom: 5px;">
						Επόμενο Βήμα
					</button>
					<button type="submit" id="submitbut" class="btn btn-primary" style="height: 107%;">
						Οριστική υποβολή
					</button>
				</div>
				<!-- </div> -->
			</div>
		</div>
		<!-- Circles which indicates the steps of the form: -->
		<div style="text-align:center;margin-top:40px;">
			<span class="step"></span>
			<span class="step"></span>

		</div>
	</form>
<?php } ?>
<?php if ($sessionFlag == 2) { ?>
	<div class="row" style="width:100%;">
		<div class="container" style="margin-top: 17.5%; text-align: center;">

		<h5> Για να χρησιμοποιήσετε την φόρμα Δηλώσεων για τις επιχειρήσεις, <br>θα πρέπει να έχετε συνδεθεί με επιχειρησιακό προφίλ.</h5>
		<br>
		<h5>Το προφίλ σας είναι τύπου <span style="color: #2c5aa0;">'Εργάζομενος'.</span> </h5>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

		</div>
	</div>

<?php } ?>
<?php if ($sessionFlag == 0) { ?>
	<div class="row" style="width:100%;">
		<div class="container" style="margin-top: 17.5%; text-align: center;">

		<h5> Για να χρησιμοποιήσετε την φόρμα Δηλωσεων για τις επιχειρήσεις, <br>θα πρέπει να έχετε συνδεθεί με επιχειρησιακό προφίλ.</h5>
		<br>
		<br>

		</div>
	</div>
	<div class="row" style="width:100%;">
		<div class="col-md-6" style="text-align:right">
			<a href="login.php" style="font-size: 110%">
				<button class="btn btn-primary" style=" width:20%; ">
					Σύνδεση
				</button>
			</a>
		</div>
		<div class="col-md-6" style="text-align:left">
			<a href="signup.php" style="font-size: 110%">
				<button class="btn btn-primary" style=" width:20%; ">
					Εγγραφή
				</button>
			</a>
			<br>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
<?php } ?>



<script>
	function loadStatementPage() {
		console.log('YES');
		$("#dynamic-container").load('business-page.php');

	}

	function loadHistoryPage() {
		console.log('YES1');
		$("#dynamic-container").load('business-history.php');

	}
</script>

<script>
	var currentTab = 0; // Current tab is set to be the first tab (0)
	showTab(currentTab); // Display the current tab

	function showTab(n) {
		// This function will display the specified tab of the form...
		var x = document.getElementsByClassName("tab");
		x[n].style.display = "block";
		//... and fix the Previous/Next buttons:
		document.getElementById("submitbut").style.display = "none";

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
			// If a field is empty and it is not disabled... (and also is not the dropdown element)
			if ((y[i].value == "" || window.getComputedStyle(y[i]).getPropertyValue("background-color") === "rgb(255, 221, 221)") && y[i].disabled == false && y[i] != document.getElementById("carsInput1")) {
				// console.log(y[i]);
				// add an "invalid" class to the field:
				y[i].className += " invalid";
				// and set the current valid status to false
				valid = false;

				k.style.display = "inline";

			}
		}
		// If the valid status is true, mark the step as finished and valid:
		if (valid) {
			document.getElementsByClassName("step")[currentTab].className += " finish";
			k.style.display = "none";
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

		document.getElementById("0").value = document.getElementById("00").value;
		document.getElementById("1").value = document.getElementById("11").value;
		document.getElementById("2").value = document.getElementById("22").value;
		document.getElementById("3").value = document.getElementById("33").value;
		document.getElementById("4").value = document.getElementById("44").value;
		document.getElementById("5").value = document.getElementById("55").value;
		document.getElementById("end-date2").value = document.getElementById("end-date").value;

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

<script>
	document.getElementById('check').onchange = function() {
		// document.getElementById('check').disabled = !this.checked;
		if (document.getElementById("check").checked) {

			document.getElementById("end-date").disabled = true;
			document.getElementById("end-date").className -= " invalid";

		} else {

			document.getElementById("end-date").disabled = false;

		}

	};
</script>

<script>
	$(document).scroll(function() {
		var y = $(document).scrollTop(), //get page y value
			header = $(".mysidenav");
		if (y >= 210) {
			var width = document.getElementById('side-menu').offsetWidth;
			header.css({
				position: "fixed",
				"top": "4em",
				"width": width - 30
			});


		} else {
			header.css({
				position: "relative",
				"top": "0",
				width: "100%"
			});
			// 	// header.css({position: "fixed", "top" : "0", "left" : "0"});
		}
	});
</script>
