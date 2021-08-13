<?php
require_once("db.php");
?>
<!-- Additional CSS Files -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="assets/css/navigation.css">
<link rel="stylesheet" type="text/css" href="assets/css/flex-slider.css">
<!-- ***** Preloader Start ***** -->
<div id="preloader">
	<div class="jumper">
		<div></div>
		<div></div>
		<div></div>
	</div>
</div>
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky background-header">
	<!-- <div class="container"> -->
		<div class="row" style="width:101%;">
			<div class="col-12">
				<div style="float: right; text-align: center; padding-top:5px; margin-right:3%; width: 450px;overflow: hidden ">
					<div style="background: #f5f5f5;   border-radius: 15px ;">
						<a id="search-but" href="construction.php"><i class="fa fa-search">&nbsp; </i></a>
						<input style="text-align: center; border: none; border-radius: 14px; font-size: 10pt" placeholder="Αναζήτηση">
						&nbsp;
						<a id="contact-but" href="contact.php"><i class="fa fa-phone">&nbsp; </i>Επικοινωνία</a>
						&nbsp;
						&nbsp;
						&nbsp;
						<a id="mylang" href="construction.php"><i class="fa fa-flag">&nbsp; </i>Ελληνικά</a>
						&nbsp;
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<nav class="main-nav">
					<!-- ***** Logo Start ***** -->
					<a href="/"> <img src="assets/images/logo.png" class="logo"height="45" id="logo-icon"></a>
					<a href="/" class="logo">ΥΠΑΚΠ</a>
					<!-- ***** Logo End ***** -->
					<!-- ***** Menu Start ***** -->
					<ul class="nav">
						<li class="submenu">
							<a href="covid.php" id="covid-sel" class="tester">COVID-19</a>
							<ul style="border-radius:3px;">
								<li><a href="covid.php#general">Γενικές Πληροφορίες</a></li>
								<li><a href="covid.php#employer">Εργοδότες</a></li>
								<li><a href="covid.php#employee">Εργαζόμενοι</a></li>
								<li><a href="covid.php#eody">Οδηγίες ΕΟΔΥ</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="employee.php" id="employee-sel">ΕΡΓΑΖΟΜΕΝΟΙ</a>
							<ul style="border-radius:3px;">
								<li><a href="construction.php">Μισθολογικά</a></li>
								<li><a href="construction.php">Δικαιώματα</a></li>
								<li><a href="employee.php">Ενέργειες</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="business.php"  id="business-sel">ΕΠΙΧΕΙΡΗΣΕΙΣ</a>
							<ul style="border-radius:3px;">
								<li><a href="construction.php">Επιδόματα & Εισφορές</a></li>
								<li><a href="construction.php">Νομοθεσία</a></li>
								<li><a href="construction.php">Αφάλεια & Υγεία</a></li>
								<li><a href="business.php">Διαχείρηση</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="construction.php " id="broke-sel">ΑΝΕΡΓΟΙ</a>
							<ul style="border-radius:3px;">
								<li><a href="construction.php">Επιδόματα</a></li>
								<li><a href="construction.php">Δικαιώματα</a></li>
								<li><a href="construction.php">Προγράμματα</a></li>
								<li><a href="construction.php">Οδηγός Εύρεσης Εργασίας</a></li>
							</ul>
						</li>


						<li class="submenu">
							<a href="construction.php" id="syntaj-sel">ΣΥΝΤΑΞΙΟΥΧΟΙ</a>
							<ul style="border-radius:3px;">
								<li><a href="construction.php">Συντάξεις</a></li>
								<li><a href="construction.php">Δικαιώματα</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="contact.php" id="ministry-sel">ΥΠΟΥΡΓΕΙΟ</a>
							<ul style="border-radius:3px;">
								<li><a href="contact.php">Επικοινωνία</a></li>
								<li><a href="construction.php">Νομοθεσία</a></li>
								<li><a href="construction.php">Οργανισμοί</a></li>
								<li><a href="construction.php">Δαπάνες</a></li>
								<li><a href="construction.php">Κοινωνική Πρόνεια</a></li>
							</ul>
						</li>
						<li class="scroll-to-section"><a href="construction.php" id="announcements-sel">ΑΝΑΚΟΙΝΩΣΕΙΣ</a></li>
						<?php
							if(!isset($_SESSION["usr_username"])) {
						?>

							<li class="submenu">
								<a id="loggedin-sel"><p style="color: #2F92AD; font-size: 18px; line-height:40px;">ΛΟΓΑΡΙΑΣΜΟΣ</p></a>
								<ul style="border-radius:3px;">
									<li><a href="login.php">ΣΥΝΔΕΣΗ</a></li>
									<li><a href="signup.php">ΕΓΓΡΑΦΗ</a></li>
								</ul>
							</li>

						<?php } else { ?>

							<li class="submenu">
								<a href="account.php" id="loggedin-sel2"><p id="loggedin-sel3" style="color: #2F92AD; font-size: 19px; line-height:40px;"> <?php echo $_SESSION["usr_username"];?> </p></a>

								<ul style="border-radius:3px;">
									<li><a href="account.php">Λογαριασμός</a></li>
									<!-- <li><a href="logout.php">Αποσύνδεση</a></li> -->
									<form method="POST" action="index.php">
										<input name="logout" value="1" type="hidden">
										<li><a href="#" onclick="this.parentNode.parentNode.submit()">Αποσύνδεση</a></li>
									</form>
								</ul>
							</li>
						<?php } ?>

					</ul>
					<a class='menu-trigger'>
						<span>Menu</span>
					</a>
					<!-- ***** Menu End ***** -->
				</nav>
			</div>
		</div>
	<!-- </div> -->
</header>
