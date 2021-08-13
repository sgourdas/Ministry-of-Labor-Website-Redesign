<?php
require_once("db.php");

$sessionFlag = 0;
if ($_SESSION["usr_username"] != "") {
	$sessionFlag = 1;
}
?>
<!-- Must include -->
<!-- <link rel="stylesheet" href="mywizard/wizard.css"> -->

<form id="regForm" method="POST" action="contact.php" onsubmit="return confirm('Είστε σίγουροι για την υποβολή σας;');">
<!-- <h3 style="text-align: center"> Κλείσε ραντεβού</h3> -->
<!-- One "tab" for each step in the form: -->
<div class="tab">
  <h3 style="text-align: center">Φόρμα Επικοινωνίας</h3>
  <br>
  <div style="text-align: center;">
  <span style="color: #2c5aa0;">Συμπλήρωση Φόρμας</span>
  <span>  >  Υποβολή</span>
  </div>
  <br>
  <br>
  <div class="row" style="width: 100%;">
    <span class="col-md-6" style="text-align: center;"><label>Όνομα</label> <br><input pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" class="contact" placeholder="π.χ. Λάκης" oninput="this.className = ''" name="fname"
        value="<?php if($sessionFlag) echo $_SESSION["usr_name"];?>"></span>
    <span class="col-md-6" style="text-align: center;"><label>Επίθετο</label><br><input pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" class="contact" placeholder="π.χ. Λαλάκης" oninput="this.className = ''" name="lname"
        value="<?php if($sessionFlag) echo $_SESSION["usr_surname"];?>"></span>
    <span class="col-md-6" style="text-align: center;"><label>Τηλέφωνο</label><br><input pattern="69+[0-9]{8,}$" minlength="10" maxlength="10" class="contact" placeholder="π.χ. 6900000000" oninput="this.className = ''" name="phone"
        value="<?php if($sessionFlag) echo $_SESSION["usr_phone"];?>"></span>
    <span class="col-md-6" style="text-align: center;"><label>email</label><br><input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" class="contact" placeholder="π.χ. email@example.com" oninput="this.className = ''" name="email"
        value="<?php if($sessionFlag) echo $_SESSION["usr_email"];;?>"></span>
    <!-- <span class="col-md-12" style="text-align: center;"><label>Κείμενο</label><br><input class="contact" placeholder="π.χ. email@example.com" style"height: 200%" oninput="this.className = ''" name="fname"></span> -->
    <div class="col-md-12 form-group">
      <label for="exampleFormControlTextarea1">Κείμενο</label>
      <textarea class="" id="exampleFormControlTextarea1" rows="9" style="position:relative; width: 100%; border-radius:15px; border:none; resize:none; text-align: center;" oninput="this.className = ''" name="desc"></textarea>
    </div>
  </div>
</div>
<div class="tab">
  <h3 style="text-align: center">Έλεγχος Στοιχείων</h3>
  <div style="text-align: center;">
  <span>Συμπλήρωση Φόρμας</span>
  <span style="color: #2c5aa0;">  >  Υποβολή</span>
  </div>
  <div id="formSummary"></div>
  <br>
  <br>
  <div class="row" style="width: 100%;">
    <label class="col-md-6" style="text-align: center;">Όνομα: <br><input class"contact-confirm" id="0" disabled="disabled" name="fname"></label>
    <label class="col-md-6" style="text-align: center;">Επίθετο: <br><input class"contact-confirm" id="1" disabled="disabled" oninput="this.className = ''" name="lname"></label>
    <label class="col-md-6" style="text-align: center;">Τηλέφωνο<br><input class"contact-confirm" id="2" disabled="disabled" oninput="this.className = ''" name="fname"></label>
    <label class="col-md-6" style="text-align: center;">email<br><input class"contact-confirm" id="3" disabled="disabled" oninput="this.className = ''" name="fname"></label>
    <div class="col-md-12 form-group">
      <label for="exampleFormControlTextarea2">Κείμενο</label>
      <textarea class="" id="exampleFormControlTextarea2" rows="9" style="position:relative; width: 100%; border-radius:15px; border-color: #fff; resize:none; text-align: center;" disabled="disabled" oninput="this.className = ''" name="lname"></textarea>
    </div>
  </div>
</div>
<div style="overflow:auto; ">
  <div class="row" style="width: 100%;  margin-bottom: 1%;">
    <!-- <div style="float:left; margin-top: 15px;"> -->
      <div class="col-md-3"  style="text-align: center;">
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
     <button type="submit" id="submitbut" class="btn btn-primary" style="height: 105%;">
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
      // If a field is empty...
      if ((y[i].value == "" || window.getComputedStyle(y[i]).getPropertyValue("background-color") === "rgb(255, 221, 221)") && y[i].disabled == false && y[i] != document.getElementById("carsInput1")) {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false
        valid = false;

        k.style.display = "inline";

      }
    }

    ta = document.getElementById("exampleFormControlTextarea1");

    if (ta.value == "") {

        ta.className += " invalid";

        valid = false;

        k.style.display = "inline";

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
  // doc = document.getElementsByClassName("contact-confirm");
  // values = document.getElementsByClassName("contact");
  // console.log("doc" + doc);
  // console.log("values" + values);
  // for (i = 0 ; i < doc.length ; i++) {
  //     doc[i].value = values[i].value;
  // }
  //

    // This function deals with validation of the form fields
    form = document.getElementById("regForm");
    labels = form.getElementsByTagName("label");
    values = form.getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    html = "";
    for (i = 0; i < values.length; i++) {
      // If a field is not empty...
      if (values[i].value != "") {
        console.log(values[i].value);
        html += /*labels[i].value + ': ' +*/ values[i].value + '<br>\r\n';
        // document.getElementById(i).value = values[i];
      }
    }

    // for (i = 0 ; i < 5 ; i++) {
        document.getElementById(0).value = values[0].value;
        document.getElementById(1).value = values[1].value;
        document.getElementById(2).value = values[2].value;
        document.getElementById(3).value = values[3].value;
        document.getElementById("exampleFormControlTextarea2").value = document.getElementById("exampleFormControlTextarea1").value;
    // }

    debugger;
    return html;

}
function carsComboChange() {
input = document.getElementById('carsInput');
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
function mySubmit() {
	document.getElementById("regForm").submit();
}

</script>
