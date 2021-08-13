<?php
	require_once("db.php");

	$sessionFlag = 0;
	if ($_SESSION["usr_username"] != '') {
		$sessionFlag = 1;
	}
	$usr_id = $_SESSION["usr_id"];
	$conn = DbOpenConnection();
	$query = "SELECT * FROM EmployeeBusinessForm WHERE wkf_usr_id='$usr_id' ORDER BY wkf_submitTime DESC";
	$result = DbExecuteQuery($conn, $query);
	$query2 = "SELECT * FROM ContactForm WHERE ctf_usr_id='$usr_id' ORDER BY ctf_submitDateTime DESC";
	$result2 = DbExecuteQuery($conn, $query2);
	$query3 = "SELECT * FROM AppointmentForm WHERE apf_usr_id='$usr_id' ORDER BY apf_submitDateTime DESC";
	$result3 = DbExecuteQuery($conn, $query3);
?>

<link rel="stylesheet" type="text/css" href="assets/css/history.css">

<form id="regForm">
	<script type="text/javaScript">
		function myFunction() {
			var element = document.getElementById("loggedin-sel3");
			element.classList.add("active");
		}
		myFunction();
	</script>
	<!-- <h3 style="text-align: center"> Κλείσε ραντεβού</h3> -->
	<!-- One "tab" for each step in the form: -->

	<?php
	if($result->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0) {
	?>
	<div class="container"><h5>Δεν υπάρχει διαθέσιμο ιστορικό για το παρόν προφίλ.<br><br><br><br></h5></div>

	<?php } else {?>

		<?php if($result->num_rows != 0) { ?>
		<div class="container"><h3>Εργασιακές δηλώσεις<br><br></h5></div>
		<table style="margin-bottom: 50px;">
			<thead>
				<tr class="table100-head">
					<th style="text-align: center;" class="column1">Είδος δήλωσης</th>
					<th style="text-align: center;" class="column2">Όνοματεπώνυμο εργαζομένου</th>
					<th style="text-align: center;" class="column3">Α.Μ.Κ.Α. εργαζομένου</th>
					<th style="text-align: center;" class="column4">Α.Φ.Μ. εργαζομένου</th>
					<th style="text-align: center;" class="column5">Περίοδος</th>

				</tr>
			</thead>

			<tbody>
				<?php
					for($i = 0 ; $i < $result->num_rows ; $i++) {
						$row = $result->fetch_object();
				 ?>
				<tr>
					<?php
					switch($row->wkf_wst_id) {

						case 0:
							$type = "Ενεργός";
							break;
						case 1:
							$type = "Πρόσληψη";
							break;
						case 2:
							$type = "Απόλυση";
							break;
						case 3:
							$type = "Αναστολή";
							break;
						case 4:
							$type = "Άδεια Γενικού Σκοπού";
							break;
						case 5:
							$type = "Άδεια Γονική";
							break;
						case 6:
							$type = "Τηλεργασία";
							break;
						case 7:
							$type = "Άδεια Ειδικού Σκοπού";
							break;
						case 8:
							$type = "Άδεια Κυοφορίας";
							break;
						case 9:
							$type = "Παραίτηση";
							break;

					}

					$period = $row->wkf_startDate." εώς ";

					if(is_null($row->wkf_endDate))
						$period .= "αόριστο";
					else
						$period .= $row->wkf_endDate;
					 ?>
					<td style="text-align: center;" class="column1"><?php echo $type?></td>
					<td style="text-align: center;" class="column2"><?php echo $row->wkf_name." ".$row->wkf_surname?></td>
					<td style="text-align: center;" class="column3"><?php echo $row->wkf_amka?></td>
					<td style="text-align: center;" class="column4"><?php echo $row->wkf_afm?></td>
					<td style="text-align: center;" class="column5"><?php echo $period?></td>
				</tr>
				<?php } ?>

			</tbody>
		</table>
		<a href="download.pdf" download><button onclick="this.parentNode.click(); return false;" class="btn btn-primary" style="width: 20%;">Κατέβασμα</button></a><br><br><br>
		<?php } else { ?>
			<div class="container"><h5>Δεν υπάρχουν εργασιακές δηλώσεις στο ιστορικό.<br><br><br><br></h5></div>
		<?php } ?>

		<?php if($result2->num_rows != 0) { ?>
		<div class="container"><h3>Φόρμες επικοινωνίας<br><br></h5></div>
		<table style="margin-bottom: 50px;">
			<thead>
				<tr class="table100-head">
					<th style="text-align: center;" class="column1">Όνοματεπώνυμο εργαζομένου</th>
					<th style="text-align: center;" class="column2">Τηλέφωνο</th>
					<th style="text-align: center;" class="column3">email</th>
					<th style="text-align: center;" class="column4">Κείμενο</th>
				</tr>
			</thead>

			<tbody>
				<?php
					for($j = 0 ; $j < $result2->num_rows ; $j++) {
						$row2 = $result2->fetch_object();
				 ?>
				<tr>
					<td style="text-align: center;" class="column1"><?php echo $row2->ctf_name." ".$row2->ctf_surname?></td>
					<td style="text-align: center;" class="column2"><?php echo $row2->ctf_phone?></td>
					<td style="text-align: center;" class="column3"><?php echo $row2->ctf_email?></td>
					<td style="text-align: center;" class="column4"><?php echo $row2->ctf_description?></td>
				</tr>
				<?php } ?>

			</tbody>
		</table>
		<a href="download.pdf" download><button onclick="this.parentNode.click(); return false;" class="btn btn-primary" style="width: 20%;">Κατέβασμα</button></a><br><br><br>
		<?php } else { ?>
			<div class="container"><h5>Δεν υπάρχουν φόρμες επικοινωνίας στο ιστορικό.<br><br><br><br></h5></div>
		<?php } ?>

		<?php if($result3->num_rows != 0) { ?>
		<div class="container"><h3>Κανονισμένα ραντεβού<br><br></h5></div>
		<table style="margin-bottom: 50px;">
			<thead>
				<tr class="table100-head">
					<th style="text-align: center;" class="column1">Όνοματεπώνυμο εργαζομένου</th>
					<th style="text-align: center;" class="column2">Α.Μ.Κ.Α. εργαζομένου</th>
					<th style="text-align: center;" class="column3">Α.Φ.Μ. εργαζομένου</th>
					<th style="text-align: center;" class="column4">Τηλέφωνο</th>
					<th style="text-align: center;" class="column5">email</th>
					<th style="text-align: center;" class="column6">Ημερομηνία & ώρα</th>
					<th style="text-align: center;" class="column7">Ακύρωση</th>
				</tr>
			</thead>

			<tbody>
				<?php
					for($j = 0 ; $j < $result3->num_rows ; $j++) {
						$row3 = $result3->fetch_object();
				 ?>
				<tr>

					<td style="text-align: center;" class="column1"><?php echo $row3->apf_name." ".$row3->apf_surname?></td>
					<td style="text-align: center;" class="column2"><?php echo $row3->apf_amka?></td>
					<td style="text-align: center;" class="column3"><?php echo $row3->apf_afm?></td>
					<td style="text-align: center;" class="column4"><?php echo $row3->apf_phone?></td>
					<td style="text-align: center;" class="column5"><?php echo $row3->apf_email?></td>
					<td style="text-align: center;" class="column6"><?php echo $row3->apf_appointmentDateTime?></td>
					<td style="text-align: center;" class="column7"><button type="button" onclick="deleteApf(<?php echo $row3->apf_id; ?>);" ><i class="fa fa-times fa-lg"></i></button></td>
				</tr>
				<?php } ?>

			</tbody>
		</table>
		<a href="download.pdf" download><button onclick="this.parentNode.click(); return false;" class="btn btn-primary" style="width: 20%;">Κατέβασμα</button></a><br><br><br>
		<?php } else { ?>
			<div class="container"><h5>Δεν υπάρχουν κλεισμένα ραντεβού στο ιστορικό.<br><br><br><br></h5></div>
		<?php } ?>

	<?php } ?>

	<br>
	<div class="container" style="border-radius: 20px; padding: 10px; border: solid; border-color: #fff; width: 30%;">
	<h5>
	<?php
	if($_SESSION["usr_act_id"] == 0)
		echo "Ο λογαριασμός σας είναι εργαζομένου.";
	else if($_SESSION["usr_act_id"] == 1)
		echo "Ο λογαριασμός σας είναι επιχειρησιακός.";
	?>
	</h5>
	</div>
	<br>

</form>
