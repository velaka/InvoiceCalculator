$(document).ready(function(){
	$('#outputCurrency').on('change', function() {
		let currency = $('.outputCurrency').val();
		if ( currency === 'USD' ) {
			$('.firstCurrency').text('EUR');
			$('.firstCurrencyExch').val('EUR');

			$('.secondCurrency').text('GBP');
			$('.secondCurrencyExch').val('GBP');
		} else if( currency === 'GBP' ) {
			$('.firstCurrency').text('EUR');
			$('.firstCurrencyExch').val('EUR');

			$('.secondCurrency').text('USD');
			$('.secondCurrencyExch').val('USD');

		} else  {
			$('.firstCurrency').text('USD');
			$('.firstCurrencyExch').val('USD');

			$('.secondCurrency').text('GBP');
			$('.secondCurrencyExch').val('GBP');
		}
	});
});