<?php
require_once("../../db.php");
//ini_set("display_errors", 1);
error_reporting(E_ALL);

$afm = $_GET['afm'];
// echo "Afm is: $afm";
if (!is_numeric($afm)) {
	echo "No 'afm' parameter value passed as parameter in query string";
	die(-1);
}

$report = $_GET['report'];
if($report == "1") {
	$conn = DbOpenConnection();
	$query = "SELECT * FROM BusinessEmployeeForm WHERE esf_businessAfm='$afm' GROUP BY esf_amka ORDER BY esf_submitTime DESC";
	$result = DbExecuteQuery($conn, $query);
}
else if($report == "2") {
	$conn = DbOpenConnection();
	$query = "SELECT * FROM BusinessEmployeeForm WHERE esf_businessAfm='$afm' ORDER BY esf_submitTime DESC";
	$result = DbExecuteQuery($conn, $query);

}
else {
	echo "No 'report' parameter value passed as parameter in query string";
	die(-1);
}
?>
<!-- Modal -->
<div class="container">
 <!-- Modal -->
 <div class="modal fade" id="empModal" role="dialog" >
  <div class="modal-dialog modal-xl">

   <!-- Modal content-->
   <div class="modal-content" style="background-color: #f4f4f4;">
	<div class="modal-header" style="text-align:center">
	  <h4 class="modal-title">Στοιχεία Τελευταίας Δήλωσης</h4>
	  <button type="button" id="closeBut" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
	</div>
	<!--
	<div class="modal-footer">
	 <button type="button" class="btn btn-default" data-dismiss="modal">Υποβολή</button>
	</div>
	-->
   </div>
  </div>
 </div>
<table style="margin-bottom: 50px;">
	<thead>
		<tr class="table100-head">
			<th style="text-align: center;" class="column1">Είδος δήλωσης</th>
			<th style="text-align: center;" class="column2">Όνοματεπώνυμο εργαζομένου</th>
			<th style="text-align: center;" class="column3">Α.Μ.Κ.Α. εργαζομένου</th>
			<th style="text-align: center;" class="column4">Α.Φ.Μ. εργαζομένου</th>
			<th style="text-align: center;" class="column5">Περίοδος</th>
			<?php if($report == "1") { ?>
			<th style="text-align: center;" class="column6">Ενέργειες</th>
			<?php } ?>
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
			<?php if($report == "1") { ?>
			<td style="text-align: right;" class="column6">
				<p><button type="button" class="btn btn-primary openBtn" onclick="expandStatement(<?php echo $row->esf_id; ?>);" style="width: 200px; margin-top: 5px; margin-bottom: 5px;"><?php echo 'ΕΠΕΞΕΡΓΑΣΙΑ'; ?></button>
					<button style="width: 200px; background-color:red; margin-bottom: 5px;" type="button" class="btn btn-primary" onClick="deleteEsf(<?php echo $row->esf_id; ?>,<?php echo $afm; ?>);">
						<p style="font-size: 20px; color: white;"><?php echo 'ΔΙΑΓΡΑΦΗ'; ?></p>
					</button>
				</p>
			</td>
			<?php } ?>
		</tr>
		<?php } ?>
	</tbody>
</table>
