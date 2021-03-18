<?php

namespace App\Http\Controllers\InvoiceCalculator;

use App\Http\Controllers\Controller;
use App\Lib\Invoice;
use App\Lib\Validation;
use App\Models\InvoiceCalculator\InvoiceCalculatorModel;
use App\Params\Currencies;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceCalculatorController extends Controller
{
	use Validation;

	/**
	 * @brief Load index page
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): View
	{
		return view('index', [
			'supportedCurrencies'   => Currencies::currencyList,
			'errors'                => array(),
		]);
	}

	/**
	 * @brief Calculate invoice
	 *
	 * @param \Illuminate\Http\Request                             $request
	 * @param \App\Models\InvoiceCalculator\InvoiceCalculatorModel $invoiceCalculatorModel
	 *
	 * @return \Illuminate\View\View
	 */
	public function calculate(Request $request, InvoiceCalculatorModel $invoiceCalculatorModel): View
	{
		$total = 0;
		$postData = $request->post();

		$csvFile = $request->file('uploadFile');
		$postData['fileExt'] = $csvFile->getClientOriginalExtension();

		$errors = $this->validatePostData($postData);

		if ( empty($errors) ) {
			$invoice = new Invoice($csvFile);
			$exchangeRates = [
				$postData['firstCurrencyExch']  => $postData['firstExchangeRate'],
				$postData['secondCurrencyExch'] => $postData['secondExchangeRate'],
				$postData['outputCurrency']     => 1
			];

			$total = $invoiceCalculatorModel->calculateInvoice($invoice, $exchangeRates, $postData['vatNumber']);
		}

		return view('index', [
			'supportedCurrencies'   => Currencies::currencyList,
			'total'                 => $total,
			'errors'                => $errors,
			'outputCurrency'        => $postData['outputCurrency'],
		]);
	}
}
