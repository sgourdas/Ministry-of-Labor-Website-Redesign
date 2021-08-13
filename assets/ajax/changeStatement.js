function displayErrorRegForm1(strError) {
    //$('#errorRegForm1').val() = strError;
    $('#errorRegForm1').text(strError);
}

function isValidRegForm1(frm) {
    // var val = frm["fname"].value;
    var val = $('#fname2').val();
    if (val == '' || val.length < 3) {
        displayErrorRegForm1('Απαιτείται όνομα εργαζομένου με 3 τουλάχιστον χαρακτήρες');
        return false;
    }
    val = $('#lname2').val();
    if (val == '' || val.length < 3) {
        displayErrorRegForm1('Απαιτείται επίθετο εργαζομένου με 3 τουλάχιστον χαρακτήρες');
        return false;
    }
    if( !$.isNumeric($('#amka2').val())) {
        displayErrorRegForm1('Απαιτείται ΑΜΚΑ εργαζομένου μόνο με αριθμούς');
        return false;
    }
    if( !$.isNumeric($('#afm2').val())) {
        displayErrorRegForm1('Απαιτείται ΑΦΜ εργαζομένου μόνο με αριθμούς');
        return false;
    }
    if($('#date2').val() == '' && !$('#checkForm1').is(":checked")) {
        displayErrorRegForm1('Απαιτείται ημερομηνία λήξης η επιλογή του Άνευ Αορίστου');
        return false;
    }

    displayErrorRegForm1(' ');
    return true;
}

function postRegForm1(frm) {
    var frmMethod = 'POST'; // frm.attr('method')
    var frmUrl = 'assets/ajax/updateBusinessEmployee.php'; // frm.attr('action')
    debugger;
    var businessEmployee = new Object();
    businessEmployee.esfid = $('#esfid').val();
    businessEmployee.formType = $('#formType').val();
    businessEmployee.fname = $('#fname2').val();
    businessEmployee.lname = $('#lname2').val();
    debugger;
    businessEmployee.amka = $('#amka2').val();
    businessEmployee.afm = $('#afm2').val();
    businessEmployee.date1 = $('#date1').val();
    businessEmployee.date2 = $('#date2').val();
    if($('#checkForm1').is(":checked"))
        businessEmployee.check = 1;
    else
        businessEmployee.check = 0;
    var frmSerialize = JSON.stringify(businessEmployee); // obj.serialize()
    $.ajax({
        type: frmMethod,
        url: frmUrl,
        data: frmSerialize,
        success: function (data) {
            //console.log('Submission was successful.');

            console.log(data);
            $('#closeBut').trigger('click');
            alert('Οι αλλαγές σας καταχωρήθηκαν επιτυχώς');
            refreshParentRegForm1();
            return true;
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
            alert('Πρόβλημα κατά την καταχώρηση δεδομένων');
            return false;
        },
    });
}

function refreshParentRegForm1() {
    var businessAfm =  $('#bafm').val();
    showBusinessEmployeesReportHtml(businessAfm);
}

function submitRegForm1(frm) {

    try {
        var valid = isValidRegForm1(frm);

        if (valid) {
            // Save changed to db
            if (postRegForm1(frm)) {

                // data-dismiss="modal"
                debugger;
                $('#empModal').modal('hide');

                // Reload data in table (grid)
                refreshParentRegForm1();
            }
        }
        else {
            //alert('Invalid');
        }
    }
    catch(ex) {
        alert(ex.message);
    }
}

function submitClickRegForm1() {
    // var frm = document.forms["regForm1"];
    // frm.submit();
    var frm = $("#regForm1");
    submitRegForm1(frm);
}

var frm = $('#regForm1');
frm.submit(function (e) {
    e.preventDefault();
    submitRegForm1(frm);
});

function changeFormDate() {
    if($('#checkForm1').is(":checked"))
    {
        $("#date2").attr('disabled','disabled');
    }
    else
    {
        $("#date2").removeAttr('disabled');
    }
}
