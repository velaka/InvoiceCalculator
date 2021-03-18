<?php

namespace App\Lib;

use App\Params\Currencies;

trait Validation
{
	/**
	 * Validating all post params
	 *
	 * @param array $postData
	 *
	 * @return array
	 */
	public function validatePostData(array $postData): array
	{
		$errors = array();

		if (!in_array($postData['outputCurrency'], Currencies::currencyList)) {
			$errors['outputCurrency'] = 'No supported currency';
		}

		if (!is_numeric($postData['firstExchangeRate'])) {
			$errors['firstExchangeRate'] = 'Exchange rate is not a valid number';
		}

		if (!is_numeric($postData['secondExchangeRate'])) {
			$errors['secondExchangeRate'] = 'Exchange rate is not a valid number';
		}

		if (isset($postData['vatNumber']) && !is_integer((int)$postData['vatNumber'])) {
			$errors['vatNumber'] = 'Exchange rate is not a valid number';
		}

		if ($postData['fileExt'] !== 'csv') {
			$errors['uploadFile'] = 'File should be CSV';
		}

		return $errors;
	}
}