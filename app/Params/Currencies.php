<?php

namespace App\Params;

/**
 * @brief    Holds internal params
 */
final class Currencies
{
	/**
	 * @var string EUR
	 */
	const EUR = 'EUR';

	/**
	 * @var string GBP
	 */
	const GBP = 'GBP';

	/**
	 * @var string USD
	 */
	const USD = 'USD';

	/**
	 * @var array List of supported currencies
	 */
	const currencyList = [
		self::EUR,
		self::GBP,
		self::USD,
	];
}