$( document ).ready(function() {

    $('.article').focusout(function(){
        var text = $(this).val();
        var res = text.toUpperCase();
        $('.article').val(res);
    });

    $('.sale_percent').focusout(function(){
        var percent = $('.sale_percent').val();
        var price = $('.price').val();

        if (percent == '') {
			$('.sale_price').val('');
			return;
        }

        var sale_price = price - ((price/100)*percent);

        if (price == sale_price || sale_price == '') {
        	$('.sale_price').val();
        	return;
        }
        $('.sale_price').val(Math.round(sale_price));
    });

});