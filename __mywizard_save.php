  <!-- Must include -->
  <!-- <link rel="stylesheet" href="mywizard/wizard.css"> -->

  <!-- <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome.min.css"> -->
<!--
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/navigation.css">
  <link rel="stylesheet" type="text/css" href="assets/css/flex-slider.css"> -->

<form id="regForm" action="/action_page.php">
  <h3 style="text-align: center"> Κλείσε ραντεβού</h3>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <!-- <span id="first-bc">Κλείσε ραντεβού</span> -->
    <br>
    <div style="text-align: center;">
    <span style="color: #2c5aa0;">Προσωπικά στοιχεία</span>
    <span>  >  Ημερομηνία</span>
    <span>  >  Σύνοψη</span>
    <span>  >  Υποβολή</span>
    </div>
    <br>
    <br>
    <div class="row" style="width: 100%;">
      <span class="col-md-6" style="text-align: center">Όνομα: <br><input placeholder="πχ. Κώστας" oninput="this.className = ''" name="fname"></span>
      <span class="col-md-6" style="text-align: center">Επίθετο: <br><input placeholder="πχ. Λαλάκης" oninput="this.className = ''" name="lname"></span>
      <span class="col-md-6" style="text-align: center"><label for="cars">Choose a car:</label>
          <br>
          <select id="cars" name="cars" onChange="carsComboChange();">
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="fiat">Fiat</option>
            <option value="audi">Audi</option>
          </select>
          <input id="carsInput" type="hidden" value="volvo" oninput="this.className = ''" name="carsInput">
      </span>
      <div class="col-md-6" style="text-align: center">
        <label for="date">Επιλέξτε ημερομηνία</label>
        <input type="date" id="date-picker" name="date-start" min="2021-00-00" max="2025-12-31" onClick="getDate();">
      </div>
    </div>
  </div>
  <div class="tab">
    <br>
    <span style="color: #2c5aa0;">Προσωπικά στοιχεία</span>
    <span style="color: #2c5aa0;">  >  Ημερομηνία</span>
    <span>  >  Σύνοψη</span>
    <span>  >  Υποβολή</span>
    <br>
    <br>
    <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
    <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
  </div>
  <div class="tab">
    <br>
    <span style="color: #2c5aa0;">Προσωπικά στοιχεία</span>
    <span style="color: #2c5aa0;">  >  Ημερομηνία</span>
    <span style="color: #2c5aa0;">  >  Σύνοψη</span>
    <span>  >  Υποβολή</span>
    <br>
    <br>
    <p><input placeholder="dd" oninput="this.className = ''" name="dd"></p>
    <p><input placeholder="mm" oninput="this.className = ''" name="nn"></p>
    <p><input placeholder="yyyy" oninput="this.className = ''" name="yyyy"></p>
  </div>
  <div class="tab">
    Login Info:
    <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
    <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
  </div>
  <div class="tab">
    <div id="formSummary">
    </div>
  </div>
  <div style="overflow:auto;">
    <div class="row" style="width: 100%;">
      <!-- <div style="float:left; margin-top: 15px;"> -->
        <div class="col-md-3"  style="text-align: center;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary" style="margin-top: 3px; margin-bottom: 3px;">Προηγούμενο</button>
        </div>
      <!-- </div> -->
      <!-- <div style="float:center; text-align: center; margin-top: 15px; display: block;"> -->
        <div class="col-md-6 text-center">
          <span id="error-msg" style="display: none; color: #f01d32;">Παρακαλώ δείτε ξανά τα πεδία κοκκινισμένα πεδία.</span>
        </div>
      <!-- </div> -->

      <!-- <div style="float:right; margin-top: 15px;"> -->
        <div class="col-md-3" style="margin-top: 3px; margin-bottom: 3px; text-align: center;">
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
    <span class="step"></span>
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
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Υποβολή";
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
    debugger;
    form = document.getElementById("regForm");
    showSummury = document.getElementById("formSummary");
    html = getFormSummaryHtml();
    debugger;
    showSummury.innerHTML = html;
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
    if ((y[i].value == "" || window.getComputedStyle(y[i]).getPropertyValue("background-color") === wrongCol) && y[i].disabled == false && y[i] != document.getElementById("carsInput1")) {
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
    if (values[i].value != "") {
      console.log(values[i].value);
      html += /*labels[i].placeholder +*/ ': ' + values[i].value + '<br>\r\n';
    }
  }
  debugger;
  return html; // return the valid status
}
function carsComboChange() {
  input = document.getElementById('carsInput');
  combo = document.getElementById('cars');
  debugger;
  value = combo.options[combo.selectedIndex].value;
  input.value = value;
}
function getDate() {

  document.getElementById('date-picker').valueAsDate = new Date();
  // document.getElementById('date-picker').setAttribute("min",new Date());
}
</script>
