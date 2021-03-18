<?php

namespace App\Model;

use App\Lib\Invoice;
use Tests\TestCase;

class DocumentStructureTest extends TestCase
{
	public function testGetAll()
	{
		$expectedArray = [
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
		$docModel = new Invoice('tests/Unit/Test_Data/invoices.csv');
		$data = $docModel->getAll();
		$this->assertIsArray($data);
		$this->assertSame($expectedArray, $data);
	}

	public function testGetByVatNumber()
	{
		$expectedArray = [
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
		$docModel = new Invoice('tests/Unit/Test_Data/invoices.csv');

		// Success test
		$data = $docModel->getByVatNumber(123456789);
		$this->assertIsArray($data);
		$this->assertSame($expectedArray, $data);

		// Test when you dont found Vat Number
		$data = $docModel->getByVatNumber(12345678339);
		$this->assertIsArray($data);
		$this->assertSame([], $data);
	}
}