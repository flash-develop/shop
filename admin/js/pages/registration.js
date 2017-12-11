$( document ).ready(function() {
	showHide();

    $('#show-address-checkbox').change(function(){
        showHide();
    });

    function showHide() {
    	if($('#show-address-checkbox').is(':checked')){
            $('.show-on-chekbox').show();
    	}
        else {
            $('.show-on-chekbox').hide();
        }
    }
    
    $('#e-mail').focusout(function(){
        var email = $(this).val();
        var res = email.split("@");
        $('#username').val(res['0']);

        var data = {
            'email' : email,
        };

    });
});