<?php
//ini_set("display_errors", 1);
//error_reporting(E_ALL);
require_once("../../db.php");
$afm = $_GET['afm'];
$eafm = $_GET['eafm'];

$conn = DbOpenConnection();
$query = "SELECT * FROM BusinessEmployeeForm WHERE esf_businessAfm='$afm' AND esf_afm='$eafm' ORDER BY esf_submitTime DESC";
$result = DbExecuteQuery($conn, $query);
$query2 = "SELECT * FROM EmployeeBusinessForm WHERE wkf_afm='$eafm' AND wkf_businessAfm='$afm' ORDER BY wkf_submitTime DESC";
$result2 = DbExecuteQuery($conn, $query2);


if($result->num_rows == 0 && $result2->num_rows == 0) { ?>
	<div class="container"><h5>Δεν υπάρχουν διαθέσιμες πληροφορίες για αυτά τα στοιχεία.<br><br><br><br></h5></div>

<?php } else {?>

<?php if($result->num_rows != 0) { ?>
<div class="container"><h3>Δηλώσεις από τον εργοδότη<br><br></h5></div>
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
			switch($row->esf_wst_id) {

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

			$period = $row->esf_startDate." εώς ";

			if(is_null($row->esf_endDate))
				$period .= "αόριστο";
			else
				$period .= $row->esf_endDate;
			 ?>
			<td style="text-align: center;" class="column1"><?php echo $type?></td>
			<td style="text-align: center;" class="column2"><?php echo $row->esf_name." ".$row->esf_surname?></td>
			<td style="text-align: center;" class="column3"><?php echo $row->esf_amka?></td>
			<td style="text-align: center;" class="column4"><?php echo $row->esf_afm?></td>
			<td style="text-align: center;" class="column5"><?php echo $period?></td>
		</tr>
		<?php } ?>

	</tbody>
</table>
<a href="download.pdf" download><button onclick="this.parentNode.click(); return false;" class="btn btn-primary" style="width: 20%;">Κατέβασμα</button></a><br><br><br>
<?php } else { ?>
	<div class="container"><h5>Δεν υπάρχουν διαθέσιμες δηλώσεις από τον εργοδότη.<br><br><br><br></h5></div>
<?php } ?>

<?php if($result2->num_rows != 0) { ?>
<div class="container"><h3>Δηλώσεις από τον εργαζόμενο<br><br></h5></div>
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
			for($j = 0 ; $j < $result2->num_rows ; $j++) {
				$row2 = $result2->fetch_object();
		 ?>
		<tr>
			<?php
			switch($row2->wkf_wst_id) {

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

			$period = $row2->wkf_startDate." εώς ";

			if(is_null($row2->wkf_endDate))
				$period .= "αόριστο";
			else
				$period .= $row2->wkf_endDate;
			 ?>
			<td style="text-align: center;" class="column1"><?php echo $type;?></td>
			<td style="text-align: center;" class="column2"><?php echo $row2->wkf_name." ".$row2->wkf_surname;?></td>
			<td style="text-align: center;" class="column3"><?php echo $row2->wkf_amka;?></td>
			<td style="text-align: center;" class="column4"><?php echo $row2->wkf_afm;?></td>
			<td style="text-align: center;" class="column5"><?php echo $period;?></td>
		</tr>
		<?php } ?>

	</tbody>
</table>
<a href="download.pdf" download><button onclick="this.parentNode.click(); return false;" class="btn btn-primary" style="width: 20%;">Κατέβασμα</button></a><br><br><br>
<?php } else { ?>
	<div class="container"><h5>Δεν υπάρχουν διαθέσιμες δηλώσεις από τον εργαζόμενο.<br><br><br><br></h5></div>
<?php } ?>
<?php } ?>
