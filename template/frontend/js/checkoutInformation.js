    function backBtn() {

        $('#tab1').prop('checked', false);
        $('#tab1').prop('disabled', true);
        $('#tab3').prop('checked', false);
        $('#tab3').prop('disabled', true);
        $('#tab2').prop('checked', true);
        $('#tab2').prop('disabled', false);
        $('#label2').click();
        //alert("1");
    }

    function backBtn2() {

        $('#tab2').prop('checked', false);
        $('#tab2').prop('disabled', true);
        $('#tab3').prop('checked', false);
        $('#tab3').prop('disabled', true);
        $('#tab1').prop('checked', true);
        $('#tab1').prop('disabled', false);
        $('#label1').click();
        //alert("2");
    }

    function submitConfirmation() {
        $('#form-payment-transfer').submit();
    }
