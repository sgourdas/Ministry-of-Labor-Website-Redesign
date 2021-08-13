<?php
	require_once("db.php");

	$sessionFlag = 0;
	if ($_SESSION["usr_username"] != '') {
		$sessionFlag = 1;
	}
?>

<link rel="stylesheet" type="text/css" href="assets/css/history.css">

<form id="regForm">
	<script type="text/javaScript">
		function myFunction() {
			var element = document.getElementById("employee-sel");
			element.classList.add("active");
		}
		myFunction();
	</script>
	<!-- <h3 style="text-align: center"> Κλείσε ραντεβού</h3> -->
	<!-- One "tab" for each step in the form: -->
	<div class="tab">
		<h3 style="text-align: center">Ιστορικό Εργαζομένου</h3>
		<br>
		<div style="text-align: center;">
			<span style="color: #2c5aa0;">Επιλογή Επιχείρησης</span>
			<span> > Ιστορικό</span>
		</div>
		<br>
		<br>
		<div class="row" style="width: 100%;">
			<span class="col-md-12" style="text-align: center;"><label>Αναγνωριστικό επιχείρησης</label> <br><input id="bsnAfm" placeholder="π.χ. 0123456789"  pattern="[0-9]{10,}$" oninput="this.className = ''" name="eafm"></span>
		</div>
		<div class="row" style="width: 100%;">
			<span class="col-md-12" style="text-align: center;"><label>Α.Φ.Μ. εργαζομένου</label> <br><input id="afm" placeholder="π.χ. 12345678" pattern="[0-9]{9,}$" maxlength="9" oninput="this.className = ''" value="<?php if($sessionFlag) echo $_SESSION["usr_afm"];?>" name="afm"></span>
		</div>
	</div>
	<div class="tab">
		<h3 style="text-align: center">Ιστορικό δηλώσεων</h3>
		<br>
		<div style="text-align: center;">
			<span>Επιλογή Επιχείρησης</span>
			<span style="color: #2c5aa0;"> > Ιστορικό</span>
		</div>
		<br>
		<br>
		<div id="divEmployeesReport">
		</div>
		<!-- <form method="get" action="download.pdf">
		   <button style="width: 20%;" class="btn btn-primary" type="submit">Κατέβασμα</button>
		</form> -->
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


<script src="assets/js/jquery-2.1.0.min.js"></script>
<script src="assets/js/main.js"></script>

<script>
	function loadStatementPage() {

		$("#dynamic-container").load('business-page.php');

	}

	function loadHistoryPage() {

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
		if (n == 0) {
			document.getElementById("prevBtn").style.display = "none";
			document.getElementById("nextBtn").style.display = "inline";
		} else {
			document.getElementById("prevBtn").style.display = "inline";
		}
		if (n == (x.length - 1)) {
			document.getElementById("nextBtn").style.display = "none";
		} else {
			document.getElementById("nextBtn").innerHTML = "Επόμενο Βήμα";
		}
		//... and run a function that will display the correct step indicator:
		fixStepIndicator(n)
	}

	function employeesReportHtml(businessAfm, employeeAfm) {
		var ajaxUrl = 'assets/ajax/employees-report.php?afm=' + businessAfm + "&eafm=" + employeeAfm;
		$.ajax({
			url: ajaxUrl,
			cache: false
		}).done(
			function(data) {
				var html = data;
				elementBusinessEmployeesReport = document.getElementById("divEmployeesReport");
				elementBusinessEmployeesReport.innerHTML = html;
			}
		);
	}

	function nextPrev(n) {
		// This function will figure out which tab to display
		var x = document.getElementsByClassName("tab");
		// Exit the function if any field in the current tab is invalid:
		if (n == 1 && !validateForm())
			return false;

		if (n == 1) {
			var elementAfm = document.getElementById("bsnAfm");
			var businessAfm = elementAfm.value;
			var employeeAfm = document.getElementById("afm").value;
			employeesReportHtml(businessAfm, employeeAfm);
		}
		// Hide the current tab:
		x[currentTab].style.display = "none";
		// Increase or decrease the current tab by 1:
		currentTab = currentTab + n;
		// if you have reached the end of the form...
		if (currentTab == x.length) {
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
			// document.getElementById('check').value = 1;
		} else {

			document.getElementById("end-date").disabled = false;
			// document.getElementById('check').value = 0;
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

<script src="assets/js/wizard-js/main.js"></script>
