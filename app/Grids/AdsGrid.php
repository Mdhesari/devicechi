<?php

namespace App\Grids;

use Closure;
use Leantony\Grid\Grid;

class AdsGrid extends Grid implements AdsGridInterface
{
	/**
	 * The name of the grid
	 *
	 * @var string
	 */
	protected $name = 'Ads';

	/**
	 * List of buttons to be generated on the grid
	 *
	 * @var array
	 */
	protected $buttonsToGenerate = [
		'create',
		'view',
		'delete',
		'refresh',
		'export'
	];

	/**
	 * Specify if the rows on the table should be clicked to navigate to the record
	 *
	 * @var bool
	 */
	protected $linkableRows = false;

	/**
	 * Set the columns to be displayed.
	 *
	 * @return void
	 * @throws \Exception if an error occurs during parsing of the data
	 */
	public function setColumns()
	{
		$this->columns = [
			"id" => [
				"label" => __(" ID "),
				"filter" => [
					"enabled" => true,
					"operator" => "like"
				],
				"styles" => [
					"column" => "grid-w-10"
				]
			],
			"picture" => [
				"label" => __(" Picture "),
				"search" => [
					"enabled" => false
				],
				"filter" => [
					"enabled" => false,
					"operator" => "like"
				],
				"presenter" => function ($columnData) {

					$url = url("/images/default_ad_picture.png");

					if ($media = $columnData->media()->activeOnly()->first()) {
						$url = $media->thumb_url;
					}

					return sprintf('<img src="%s" class="image-ad-grid-preview" alt="%s">', $url, optional($columnData->phoneModel)->name);
				},
				"raw" => true,
			],
			"title" => [
				"label" => __(" Title "),
				"search" => [
					"enabled" => true
				],
				"filter" => [
					"enabled" => true,
					"operator" => "like"
				]
			],
			"model" => [
				"label" => __(" Model "),
				"filter" => [
					"enabled" => true,
					"operator" => "like",
				],
				"presenter" => function ($columnData, $columnName) {

					if (is_null($columnData->phoneModel)) return "";

					return $columnData->phoneModel->name;
				},
				"export" => false
			],
			"brand" => [
				"label" => __(" Brand "),
				"filter" => [
					"enabled" => true,
					"operator" => "like",
				],
				"presenter" => function ($columnData, $columnName) {

					if (is_null($columnData->phoneModel)) return "";

					return $columnData->phoneModel->brand->name;
				},
			],
			"state" => [
				"label" => __(" City State "),
				"filter" => [
					"enabled" => true,
					"operator" => "like"
				],
				"presenter" => function ($columnData, $columnName) {

					if (is_null($columnData->state)) return __(" Nothing ");

					return $columnData->state->city->name . ', ' . $columnData->state->name;
				},
				"export" => false
			],
			'price' => [
				'label' => __(' Price '),
				'filter' => [
					'enabled' => true,
					'operator' => '=',
				],
				'presenter' => function ($columnData, $columnName) {

					return number_format($columnData->price) . ' تومان ';
				}
			],
			"user" => [
				"label" => __(" User "),
				"filter" => [
					"enabled" => true,
					"operator" => "like",
				],
				"presenter" => function ($columnData, $columnName) {

					if (is_null($columnData->user)) return __(' No User ');

					$route = route('admin.users.show', [
						'user' => $columnData->user->id,
					]);

					return '<a href="' . $route . '" class="btn btn-link text-primary">' . $columnData->user->name . '</a>';
				},
				"raw" => true,
			],
			"status" => [
				"label" => __(" City "),
				"search" => [
					"enabled" => true
				],
				"filter" => [
					"enabled" => true,
					"operator" => "like"
				],
				"presenter" => function ($columnData, $columnName) {

					return $columnData->getStatus();
				},
			],
			"created_at" => [
				"label" => __(" Created At "),
				"sort" => true,
				"date" => "true",
				"filter" => [
					"enabled" => false,
				]
			]
		];
	}

	/**
	 * Set the links/routes. This are referenced using named routes, for the sake of simplicity
	 *
	 * @return void
	 */
	public function setRoutes()
	{
		// searching, sorting and filtering
		$this->setIndexRouteName('admin.ads.list');

		// crud support
		$this->setCreateRouteName('admin.ads.add');
		$this->setViewRouteName('admin.ads.show');
		$this->setDeleteRouteName('admin.ads.destroy');

		// default route parameter
		$this->setDefaultRouteParameter('id');
	}

	/**
	 * Return a closure that is executed per row, to render a link that will be clicked on to execute an action
	 *
	 * @return Closure
	 */
	public function getLinkableCallback(): Closure
	{
		return function ($gridName, $item) {
			return route($this->getViewRouteName(), [$gridName => $item->id]);
		};
	}

	/**
	 * Configure rendered buttons, or add your own
	 *
	 * @return void
	 */
	public function configureButtons()
	{
		// call `addRowButton` to add a row button
		// call `addToolbarButton` to add a toolbar button
		// call `makeCustomButton` to do either of the above, but passing in the button properties as an array

		// call `editToolbarButton` to edit a toolbar button
		// call `editRowButton` to edit a row button
		// call `editButtonProperties` to do either of the above. All the edit functions accept the properties as an array
	}

	/**
	 * Returns a closure that will be executed to apply a class for each row on the grid
	 * The closure takes two arguments - `name` of grid, and `item` being iterated upon
	 *
	 * @return Closure
	 */
	public function getRowCssStyle(): Closure
	{
		return function ($gridName, $item) {
			// e.g, to add a success class to specific table rows;
			// return $item->id % 2 === 0 ? 'table-success' : '';
			return "";
		};
	}
}
