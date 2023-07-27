<?php

namespace App\View\Components;

use Arr;
use Illuminate\View\Component;

class AutoCompleteSearch extends Component
{

    public $name;
    public $route;
    public $placeholder;
    public $options;
    public $id;
    public $defaults;
    public $ignore;
    public $single;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id,
        $name,
        $route,
        $placeholder,
        $options = [],
        $defaults = [],
        $ignore = [],
        $single = false
    ) {
        $this->name = $name;
        $this->route = $route;
        $this->placeholder = $placeholder;
        $this->options = $options;
        $this->id = $id;
        $this->setDefaults($defaults);
        $this->ignore = $ignore;
        $this->single = $single;
    }

    public function setDefaults($defaults)
    {

        if (is_object($defaults) && method_exists($defaults, 'toArray')) {

            $defaults = $defaults->toArray();
        } else if (is_null($defaults)) {

            $defaults = [];
        } else if (!is_array($defaults)) {

            $defaults = [$defaults];
        }

        $defaults = array_filter($defaults, function ($item) {

            return !is_null($item);
        });

        $this->defaults = $defaults;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.auto-complete-search');
    }
}
