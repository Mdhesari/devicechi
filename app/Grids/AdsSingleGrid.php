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
			'price' => [
				'label' => __(' Price '),
				'filter' => [
					'enabled' => true,
					'operator' => '=',
				],
				'presenter' => function ($columnData, $columnName) {

					return number_format($columnData->price) . ' تومان ';
				}
			]
		]);
	}
}
