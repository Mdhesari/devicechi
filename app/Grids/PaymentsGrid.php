<?php

namespace App\Grids;

use Closure;
use Leantony\Grid\Grid;

class PaymentsGrid extends Grid implements PaymentsGridInterface
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Payments';

    /**
     * List of buttons to be generated on the grid
     *
     * @var array
     */
    protected $buttonsToGenerate = [
        'create',
        'view',
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
                "label" => "ID",
                "filter" => [
                    "enabled" => true,
                    "operator" => "="
                ],
                "styles" => [
                    "column" => "grid-w-10"
                ]
            ],
            "amount" => [
                "label" => __(" Amount "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "=",
                ],
                "presenter" => function ($columnData, $columnName) {

                    return $columnData->formattedAmount;
                },
            ],
            "status" => [
                "label" => __(" Status "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "=",
                ],
            ],
            "user" => [
                "label" => __(" User "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "=",
                ],
                "presenter" => function ($columnData, $columnName) {

                    $route = route('admin.users.show', [
                        'user' => $columnData->user->id,
                    ]);

                    return '<a href="' . $route . '" class="btn btn-link text-primary">' . $columnData->user->name . '</a>';
                },
                "raw" => true,
            ],
            "admin" => [
                "label" => __(" Admin "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "=",
                ],
                "presenter" => function ($columnData, $columnName) {

                    if (is_null($columnData->admin)) return __(' No Admin ');

                    $route = route('admin.admins.show', [
                        'admin' => $columnData->admin->id,
                    ]);

                    return '<a href="' . $route . '" class="btn btn-link text-primary">' . $columnData->admin->name . '</a>';
                },
                "raw" => true,
            ],
            "discount" => [
                "label" => __(" Discount "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "=",
                ],
                "presenter" => function ($columnData, $columnName) {

                    // $route = route('admin.users.show', [
                    //     'user' => $columnData->user->id,
                    // ]);

                    $route = "#";

                    $amount = $columnData->discount ? $columnData->discount->amount : 0;

                    $txt = sprintf("%s تومان", $amount);

                    if ($amount > 0)
                        return '<a href="' . $route . '" class="btn btn-link text-primary">' . $txt . '</a>';

                    return '<p class="text-muted">' . $txt . '</p>';
                },
                "raw" => true,
            ],
            "verified_code" => [
                "label" => __(" Verified Code "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "=",
                ],
                "presenter" => function ($columnData, $columnName) {

                    return $columnData->verified_code ?? __(' No Payment ');
                },
            ],
            "verified_at" => [
                "sort" => false,
                "date" => "true",
                "filter" => [
                    "enabled" => true,
                    "type" => "date",
                    "operator" => "<="
                ],
                "presenter" => function ($columnData, $columnName) {

                    return $columnData->verified_at ?? __(' No Verification ');
                },
            ],
            "created_at" => [
                "sort" => false,
                "date" => "true",
                "filter" => [
                    "enabled" => true,
                    "type" => "date",
                    "operator" => "<="
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
        $this->setIndexRouteName('admin.payments.list');

        // crud support
        $this->setCreateRouteName('admin.payments.add');
        $this->setViewRouteName('admin.payments.show');
        // $this->setDeleteRouteName('admin.payments.list');

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
