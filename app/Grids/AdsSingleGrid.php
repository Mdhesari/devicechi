<?php

namespace App\Grids;

use Closure;
use Leantony\Grid\Grid;
use Modules\Admin\Entities\Admin;

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
			'admin_status' => [
				'label' => __(" Latest Review Status "),
				"search" => [
					"enabled" => false
				],
				"filter" => [
					"enabled" => false,
					"operator" => "="
				],
				"presenter" => function ($columnData, $columnName) {

					if (!isset($columnData->meta_ad['admin_id'])) return __(" No Review ");

					$admin = Admin::find($columnData->meta_ad['admin_id']);

					if ($columnData->isAccepted()) return __(" Accepted by :admin ", [
						'admin' => $admin->email,
					]);

					return __(" Rejected by :admin, :desc ", [
						'admin' => $admin->email,
						'desc' => isset($columnData->meta_ad['reject_description']) ? $columnData->meta_ad['reject_description'] : __(' No Description '),
					]);
				},
			]
		]);
	}
}
