<?php

namespace App\Lib;

class Invoice
{
	protected array $data = [];

	public function __construct(string $file)
	{
		$this->setData($file);
	}

	/**
	 * Return all data from the file
	 *
	 * @return array
	 */
	public function getAll(): array
	{
		return $this->data;
	}

	/**
	 * Return all data by VAT number
	 *
	 * @param int $vatNumber
	 *
	 * @return array
	 */
	public function getByVatNumber(int $vatNumber): array
	{
		$allVATNumbers = [];

		foreach ($this->data as $customer)
		{
			if ($customer['Vat number'] == $vatNumber)
			{
				$allVATNumbers[] = $customer;
			}
		}

		return $allVATNumbers;
	}

	/**
	 * Convert CSV file to array
	 *
	 * @param string $file
	 *
	 * @return void
	 */
	private function setData(string $file): void
	{
		$data = [];
		$columnNames = [];

		if (($handle = fopen($file, "r")) !== false) {
			$csvs = [];
			while (!feof($handle)) {
				$csvs[] = fgetcsv($handle);
			}

			foreach ($csvs[0] as $singleCsv) {
				$columnNames[] = $singleCsv;
			}

			foreach ($csvs as $key => $csv) {
				if ($key === 0) {
					continue;
				}
				foreach ($columnNames as $columnKey => $columnName) {
					$data[$key - 1][$columnName] = $csv[$columnKey];
				}
			}
			fclose($handle);
		}

		$this->data = $data;
	}
}