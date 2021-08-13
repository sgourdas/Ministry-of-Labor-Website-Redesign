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

<link rel="stylesheet" type="text/css" href="assets/css/history.css">
<form id="regForm">
	<script type="text/javaScript">
		function myFunction() {
			var element = document.getElementById("business-sel");
			element.classList.add("active");
		}
		myFunction();
	</script>
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/main.css"> -->
	<div class="tab">
		<h3 style="text-align: center">Διαχείριση προσωπικού</h3>
		<br>
		<div style="text-align: center;">
			<span style="color: #2c5aa0;">Επιλογή Επιχείρησης</span>
			<span> > Προσωπικό</span>
		</div>
		<br>
		<br>
		<div class="row" style="width: 100%;">
			<span class="col-md-12" style="text-align: center;"><label>Αναγνωριστικό επιχείρησης</label> <br><input id="afm" placeholder="π.χ. 0123456789" value="<?php echo $_SESSION["bsn_afm"]; ?>" pattern="[0-9]{10,}$" oninput="this.className = ''" name="bsnAfm"></span>
		</div>
	</div>
	<div class="tab">
		<h3 style="text-align: center">Διαχείριση προσωπικού</h3>
		<br>
		<div style="text-align: center;">
			<span>Επιλογή Επιχείρησης</span>
			<span style="color: #2c5aa0;"> > Προσωπικό</span>
		</div>
		<br>
		<br>
		<div id="divBusinessEmployeesReport">
		</div>
	</div>

	<div style="overflow:auto; ">
		<div class="row" style="width: 100%;  margin-bottom: 1%;">
			<!-- <div style="float:left; margin-top: 15px;"> -->
			<div class="col-md-3" style="text-align: center; margin-top: 20px;">
				<button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary" style="margin-top: 3px; margin-bottom: 3px; width:100%;">Προηγούμενο</button>
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

<?php } ?>
<?php if ($sessionFlag == 2) { ?>
	<div class="row" style="width:100%;">
		<div class="container" style="margin-top: 17.5%; text-align: center;">

		<h5> Για να χρησιμοποιήσετε την Κατάσταση Προσωπικού για τις επιχειρήσεις, <br>θα πρέπει να έχετε συνδεθεί με επιχειρησιακό προφίλ.</h5>
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

		<h5> Για να χρησιμοποιήσετε την Κατάσταση Προσωπικού για τις επιχειρήσεις, <br>θα πρέπει να έχετε συνδεθεί με επιχειρησιακό προφίλ.</h5>
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
		// console.log('YES')
		$("#dynamic-container").load('business-page.php');
	}

	function loadHistoryPage() {
		// console.log('YES')
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
		fixStepIndicator(n);
	}

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

	// initial page is 0
	function nextPrev(n) {
		// This function will figure out which tab to display
		var x = document.getElementsByClassName("tab");
		// Exit the function if any field in the current tab is invalid:
		if (n == 1 && !validateForm())
			return false;

		if (n == 1) {
			var elementAfm = document.getElementById("afm");
			var businessAfm = elementAfm.value;
			showBusinessEmployeesReportHtml(businessAfm);
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
			if ((y[i].value == "" || window.getComputedStyle(y[i]).getPropertyValue("background-color") ===
					"rgb(255, 221, 221)") && y[i].disabled == false && y[i] != document.getElementById("carsInput1")) {
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

		for (i = 0; i < 7; i++) {
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

<!-- <script src="assets/js/wizard-js/main.js"></script> -->

</html>
