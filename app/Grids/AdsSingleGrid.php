<?php

namespace App\Grids;

use Closure;
use Leantony\Grid\Grid;

class AdsSingleGrid extends AdsGrid
{
	/**
	 * Set the columns to be displayed.
	 *
	 * @return void
	 * @throws \Exception if an error occurs during parsing of the data
	 */
	public function setColumns()
	{
		parent::setColumns();
		$this->columns = array_merge($this->columns, [
			'description' => [
				'label' => __(" Description "),
				'filter' => [
					'enabled' => false,
				],
				'presenter' => function ($columnData, $columnName) {

					return $columnData->printableDesc;
				},
				'raw' => true,
			],
			'accessories' => [
				'label' => __(" Accessories "),
				'filter' => [
					'enabled' => false,
				],
				'presenter' => function ($columnData, $columnName) {

					return join(" </br> ", $columnData->accessories()->pluck('title')->toArray());
				},
				'raw' => true,
			],
			'contacts' => [
				'label' => __(" Contacts "),
				'filter' => [
					'enabled' => false,
				],
				'presenter' => function ($columnData, $columnName) {

					return join(" </br> ", $columnData->contacts()->pluck('value')->toArray());
				},
				'raw' => true,
			],
			"age" => [
				"search" => [
					"enabled" => true
				],
				"filter" => [
					"enabled" => true,
					"operator" => "="
				],
				"presenter" => function ($columnData, $columnName) {

					return $columnData->getAgeInfo();
				},
			],
		]);
	}
}
