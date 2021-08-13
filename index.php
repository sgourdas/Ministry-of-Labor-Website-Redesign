<?php
    require_once("db.php");
    //session_start();
	if (!empty($_POST)) {
		//session_destroy();
        $_SESSION = array();
    }
 ?>

<!DOCTYPE html>
<html lang="en">
    <script>
                  window.POPUPSMART_COVID = {
      "headline": "Μέτρα κατά του Covid-19",
      "item1": "Φοράμε μάσκα",
      "item2": "Πλένουμε τα χέρια μας τακτικά",
      "item3": "Καλύπτουμε το στόμα μας όταν βήχουμε",
      "item4": "Κρατάμε τις αποστάσεις",
      "firstButton": {
        "text": "Μάθετε περισσότερα",
        "url": "covid.php"
      },
      "secondaryButton": {
        "text": "Όχι, ευχαριστώ",
        "url": "CLOSE_POPUP"
      },
      "exitIntend": false,
      "afterXSeconds": "3",
      "colors": {
        "color1": "#6BD8E4",
        "color2": "#248EB3",
        "color3": "#2c5aa0"
      },
      "positioning": "CENTER",
      "mobileOnOff": true
    };
  </script>
  <script async src="/assets/js/covid-popup.js"></script>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <title>ΥΠΑΚΠ</title>

    </head>

    <body>
    <?php include 'header.php';?>

    <div style="background-image: url('https://files.123freevectors.com/wp-content/original/130864-black-and-white-polygon-background-graphic-design.jpg');
    background-size: cover; height:590px; padding-top:80px;">
        <div class="container" style="margin-top: 80px; width: 75%;">
    	    <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron" style="background-color: #f7f7f7; border-radius: 20px;">
                <h3 style="margin-top: -3%; text-align: center; float: top; letter-spacing: 2px;">ΓΡΗΓΟΡΗ ΠΡΟΣΒΑΣΗ</h3>
                <!-- <br> -->
                <div class="row" style="text-align: center;">
                    <div class="col-md-6 col-sm6 box">
                        <a href="employee.php">
                            <button type="button" class="btn btn-secondary"><i class="fa fa-user" ></i> ΔΙΑΧΕΙΡΙΣΤΙΚΟ ΕΡΓΑΖΟΜΕΝΩΝ</button>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm6 box">
                        <a href="business.php">
                            <button type="button" class="btn btn-secondary"><i class="fa fa-building" ></i> ΔΙΑΧΕΙΡΙΣΤΙΚΟ ΕΠΙΧΕΙΡΗΣΕΩΝ</button>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm6 box">
                        <a href="contact.php">
                            <button type="button" class="btn btn-secondary"><i class="fa fa-phone" ></i> ΕΠΙΚΟΙΝΩΝΙΑ</button>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm6 box">
                        <a href="covid.php">
                            <button type="button" class="btn btn-secondary"><i class="fa fa-user-md" ></i> ΟΔΗΓΟΣ COVID-19</button>
                        </a>
                    </div>
                    <!-- <div class="col-md-6 col-sm6 box">
                        <a href="covid.php">
                            <button type="button" class="btn btn-secondary">ΚΟΙΝΩΝΙΚΗ ΠΡΟΝΟΙΑ</button>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm6 box">
                        <a href="contact.php">
                            <button type="button" class="btn btn-secondary"><i class="fa fa-phone" ></i>ΕΠΙΚΟΙΝΩΝΙΑ</button>
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <section class="section" id="welcome-section">
        <div class="container" style="text-align: center;">
            <h2>Υπουργείο Εργασίας και Κοινωνικής Πρόνοιας</h2>
            <br>
            <h5>Το ypakp.gr είναι μια ανεωμένη διαδυκτιακή πύλη του ελληνικού κράτους που αφορά το Υπουργείο Εργασίας. Μέσα στον ιστοχώρο θα βρείτε νομοθετικά πλαίσια, ανακοινώσεις
                και στοιχεία επικοινωίας για όλους τους φορείς που σχετίζονται με το υπουργείο εργασίας. Τέλος παρέχεται και η δυνατότητα απομακρυσμένων ενεργειών για υπαλλήλους, εργαζόμενους και επιχειρηματίες όσων αφορά εργασιακά θέματα αλλά και η δυνατότητα κατοχύρωσης ραντέβου online για δια ζώσης επικοινωνία με τους φορείς του
                εργασιακού τομέα.</h5>
        </div>
    </section>

    <div class="container" style="padding-top: 30px">
        <div class="row" style="text-align: center">
            <div class="col-md-6 col-sm6 box">
                <h4>Πρόσφατες Ανακοινώσεις</h4>
            </div>
            <div class="col-md-6 col-sm6 box">
                <h4>Συχνές Ερωτήσεις</h4>
            </div>
        </div>
    </div>

    <section class="section" id="frequently-question" style="">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- <h5>FAQ</h5> -->
                    <div class="accordions is-first-expanded">
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>30/07/2020 - Υποχρεωτική χρήση μάσκας σε χώρους γραφείων δημοσίων υπηρεσιών</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Η χρήση μάσκας είναι υποχρεωτική για το κοινό που προσέρχεται για εξυπηρέτηση σε χώρους γραφείων δημοσίων υπηρεσιών.</p>
                                    <br>
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>21/07/2020 - Υποβολή δηλώσεων Β' φάσης για τον μηχανισμό Συν-Εργασία</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Υποβολή δηλώσεων της Β' φάσης για τον μηχανισμό Συν-Εργασία/ ορθές επαναλήψεις για τον μήνα Ιούνιο 2020.</p>
                                    <br>
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>01/07/2020 - Επαναφορά ωρών εισόδου κοινού στο ΥΠΑΚΠ</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Ενημέρωση για επαναφορά των ωρών εισόδου κοινού στο πρωτόκολλο και τις λοιπές υπηρεσίας του ΥΠΑΚΠ.</p>
                                    <br>
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>29/07/2020 - Διευκρυνήσεις για το έντυπο αυτοαξιολόγησης της επιχείρησης</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Ύστερα από ερωτήματα που έχουν τεθεί σχετικά με το συνημμένο...</p>
                                    <br>
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>24/06/2020 - Υποβολή δηλώσεων αναστολών εργασίας</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Δύνεται να υποβληθεί αρχική "ΔΗΛΩΣΗ ΑΝΑΣΤΟΛΗΣ ΣΥΜΒΑΣΕΩΝ ΕΡΓΑΣΙΑΣ"...</p>
                                    <!-- <a href="#" style="color: #4870ac; ">περισσότερα</a> -->
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div style="padding-top: 10px; text-align: center;">
                        <a href="construction.php"><button type="button" class="btn btn-primary" style="font-size: 19px;">Όλες οι ανακοινώσεις</button></a>
                        <!-- <p>Όλες οι ανακοινώσεις</p> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- <h5>FAQ</h5> -->
                    <div class="accordions is-first-expanded">
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>Πότε θα καταβληθεί το επίδομα μου;</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Τα επιδόματα καταβάλλονται κάθε....</p>
                                    <br>
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>Ποιές επιχειρήσεις δικαιούνται το επίδομα αναστολής λειτουργίας;</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Το επίδομα αναστολής λειτουργίας δίνεται στις επιχειρήσεις που έκλεισαν...</p>
                                    <br>
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>Γιατί η σύνταξη μου "κόπηκε" αυτό τον μήνα;</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Μπορείτε να λάβετε άμεση ενημέρωση για την σύνταξη που δικαιούστε καθώς και...</p>
                                    <br>
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>Πώς μπορώ να βρω την νομοθετική διάταξη για τη διαγραφή οφειλών σε ταμεία;</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Η δυνατότητα να δείτε και να ενημερωθείτε για κάθε αλλαγή σε νομοθετικές διατάξεις που αφορούν...</p>
                                    <br>
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>Πότε είναι ανοιχτό το Υπουργείο Εργασίας;</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Μπορείτε ανα πάσα στιγμή να δείτε τις ώρες λειτουργίας του  Υπουργείου...</p>
                                    <!-- <a href="#" style="color: #4870ac; ">περισσότερα</a> -->
                                    <a href="construction.php"><button type="button" class="btn btn-primary" style="margin-left:75%;">περισσότερα</button></a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div style="padding-top: 10px; text-align: center;">
                        <a href="construction.php"><button type="button" class="btn btn-primary" style="font-size: 19px;">Ρωτήστε περισσότερα</button></a>
                        <!-- <p>Όλες οι ανακοινώσεις</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Frequently Question End ***** -->
    <?php include 'footer.php';?>
</script>
  </body>
</html>
