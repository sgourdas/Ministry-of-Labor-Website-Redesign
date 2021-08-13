<?php
//ini_set("display_errors", 1);
error_reporting(E_ALL);
require_once("../../db.php");

$esf_id = $_GET["esf_id"];

$conn = DbOpenConnection();

$query = "SELECT * FROM BusinessEmployeeForm WHERE esf_id='$esf_id'";

$result = DbExecuteQuery($conn, $query);

if($result->num_rows) {
    $row = $result->fetch_object();
    // print_r($result);
    //print_r($row);
}
else {
    echo "Kati pige lathos";
}

?>
<div class="container">
    <form id="regForm1" method="POST" action="assets/ajax/updateBusinessEmployee.php">
        <div class="row">
            <!-- element -->
            <input id="esfid" type="hidden" value="<?php echo $esf_id; ?>" name="esfid">
            <!-- element -->
            <span class="col-md-6" >
                <label>Αναγνωριστικό επιχείρησης</label>
            </span>
            <span class="col-md-6">
                <input id="bafm" disabled value="<?php echo $row->esf_businessAfm; ?>" placeholder="π.χ. 0123456789" pattern="[0-9]{10,}$" oninput="this.className = ''" name="bafm">
            </span>
            <!-- element -->
            <span class="col-md-6">
                <label>Είδος δήλωσης</label>
            </span>
            <span class="col-md-6">
                <select id="formType" name="adeia" onChange="carsComboChange();">
                    <option <?php if($row->esf_wst_id == 0) echo"selected='selected';"; ?>value="0">Ενεργός</option>
                    <option <?php if($row->esf_wst_id == 1) echo"selected='selected';"; ?> value="1">Πρόσληψη</option>
                    <option <?php if($row->esf_wst_id == 2) echo"selected='selected';"; ?> value="2">Απόλυση</option>
                    <option <?php if($row->esf_wst_id == 3) echo"selected='selected';"; ?> value="3">Αναστολή</option>
                    <option <?php if($row->esf_wst_id == 4) echo"selected='selected';"; ?> value="4">Άδεια Γενικού Σκοπού</option>
                    <option <?php if($row->esf_wst_id == 7) echo"selected='selected';"; ?> value="7">Άδεια Ειδικού Σκοπού</option>
                    <option <?php if($row->esf_wst_id == 5) echo"selected='selected';"; ?> value="5">Άδεια Γονική</option>
                    <option <?php if($row->esf_wst_id == 8) echo"selected='selected';"; ?> value="8">Άδεια Κυοφορίας</option>
                    <option <?php if($row->esf_wst_id == 6) echo"selected='selected';"; ?> value="6">Τηλεργασία</option>
                </select>
                <input value="1" id="carsInput1" type="hidden" oninput="this.className = ''" name="carsInput">
            </span>
            <!-- element -->
            <span class="col-md-6">
                <label>Όνομα εργαζομένου</label>
            </span>
            <span class="col-md-6">
                <input value="<?php echo $row->esf_name; ?>" id="fname2" placeholder="π.χ. Λάκης" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="fname">
            </span>
            <!-- element -->
            <span class="col-md-6">
                <label>Επίθετο εργαζομένου</label>
            </span>
            <span class="col-md-6">
                <input value="<?php echo $row->esf_surname; ?>" id="lname2" placeholder="π.χ. Λαλάκης" pattern="[a-zA-Z\u03b1-\u03c9\u0391-\u03a9\u03ac-\u03ce\u0386-\u038f]+$" oninput="this.className = ''" name="lname">
            </span>
            <!-- element -->
            <span class="col-md-6">
                <label>Α.Μ.Κ.Α. εργαζομένου</label>
            </span>
            <span class="col-md-6">
                <input value="<?php echo $row->esf_amka; ?>" id="amka2" placeholder="π.χ. 01234567890" pattern="[0-9]{11,}$" maxlength="11" oninput="this.className = ''" name="amka">
            </span>
            <!-- element -->
            <span class="col-md-6">
                <label>Α.Φ.Μ. εργαζομένου</label>
            </span>
            <span class="col-md-6">
                <input value="<?php echo $row->esf_afm; ?>" id="afm2" placeholder="π.χ. 12345678" pattern="[0-9]{9,}$" maxlength="9" oninput="this.className = ''" name="afm2">
            </span>
            <!-- element -->
            <span class="col-md-6">
                <label>Επιλέξτε ημερομηνία έναρξης</label><br>
            </span>
            <span class="col-md-6">
                <input value="<?php echo $row->esf_startDate; ?>" id="date1" class="contact" type="date" min="2021-00-00" max="2025-12-31" oninput="this.className = ''" name="startDate">
            </span>
            <!-- element -->
            <span class="col-md-6">
                <label>Επιλέξτε ημερομηνία λήξης</label>
            </span>
            <span class="col-md-6">
                <input value="<?php if($row->esf_endDate != "") echo $row->esf_endDate; ?>" class="contact" type="date" id="date2" min="2021-00-00" max="2025-12-31" oninput="this.className = ''" name="endDate" onChange="carsComboChange();">
            </span>
            <!-- element -->
            <span class="col-md-12">
                <label> Άνευ αορίστου</label>
            </span>
            <span class="col-md-12">
                <input type="checkbox" id="checkForm1" onclick="changeFormDate();" value="0" name="checkBox">
            </span>
        </div>
        <div class="row">
            <span class="col-md-12">
                <label style="color:red" id="errorRegForm1"></label>
            </span>
        </div>
        <div class="row">
            <span class="col-md-12">
                <button type="button" class="btn btn-danger" onclick="submitClickRegForm1();">Υποβολή</button>
            </span>
        </div>
    </form>
</div>
