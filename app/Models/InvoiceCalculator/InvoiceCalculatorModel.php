<?php

namespace App\Models\InvoiceCalculator;

use App\Lib\Invoice;

class InvoiceCalculatorModel
{
	/**
	 * Calculate invoices
	 *
	 * @param Invoice   $invoice
	 * @param array     $exchangeRates
	 * @param int|null  $vatNumber
	 *
	 * @return int
	 */
	public function calculateInvoice(Invoice $invoice, array $exchangeRates, int $vatNumber = null): int
	{
		$total = 0;

		$invoiceData = $vatNumber ? $invoice->getByVatNumber($vatNumber) : $invoice->getAll();

		foreach ($invoiceData as $invoice) {
			$currentTotal = (int)$invoice['Total'] * $exchangeRates[$invoice['Currency']];

			switch ( $invoice['Type'] ) {
				case 1:
				case 3:
					$total += $currentTotal;
					break;
				case 2:
					$total -= $currentTotal;
					break;
			}
		}

		return $total;
	}
}
