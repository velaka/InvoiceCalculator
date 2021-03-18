<?php

namespace App\Model;

use App\Models\InvoiceCalculator\InvoiceCalculatorModel;
use Tests\TestCase;

class InvoiceCalculatorModelTest extends TestCase
{
	public function testCalculateInvoice()
	{
		$returnData = [
			[
				"Customer"          => "Vendor 1",
				"Vat number"        => "123456789",
				"Document number"   => "1000000257",
				"Type"              => "1",
				"Parent document"   => "",
				"Currency"          => "USD",
				"Total"             => "400",
			],
			[
				"Customer"          => "Vendor 2",
				"Vat number"        => "987654321",
				"Document number"   => "1000000258",
				"Type"              => "1",
				"Parent document"   => "",
				"Currency"          => "EUR",
				"Total"             => "900",
			]
		];

		$exchangeRates = [
			'USD' => 0.8,
			'GBP' => 0.9,
			'EUR' => 1
		];

		$invoiceMock = $this->createMock('App\Lib\Invoice');
		$invoiceMock->method('getAll')->willReturn($returnData);

		$invoiceCalculatorModel = new InvoiceCalculatorModel();

		$total = $invoiceCalculatorModel->calculateInvoice($invoiceMock, $exchangeRates);

		$this->assertEquals( 1220, $total);
	}

	public function testCalculateInvoiceWithVatNumber()
	{
		$returnData = [
			[
				"Customer"          => "Vendor 1",
				"Vat number"        => "123456789",
				"Document number"   => "1000000257",
				"Type"              => "1",
				"Parent document"   => "",
				"Currency"          => "USD",
				"Total"             => "400",
			]
		];

		$exchangeRates = [
			'USD' => 0.8,
			'GBP' => 0.9,
			'EUR' => 1
		];

		$invoiceMock = $this->createMock('App\Lib\Invoice');
		$invoiceMock->method('getByVatNumber')->with(123456789)->willReturn($returnData);

		$invoiceCalculatorModel = new InvoiceCalculatorModel();

		$total = $invoiceCalculatorModel->calculateInvoice($invoiceMock, $exchangeRates, 123456789);

		$this->assertEquals( 320, $total);
	}
}