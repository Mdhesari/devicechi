<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SlugForm extends Component
{

    public $textFormId;
    public $modelClass;
    public $slug;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($textFormId, $modelClass, $slug = '')
    {
        $this->textFormId = $textFormId;
        $this->modelClass = $modelClass;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.slug-form');
    }
}
