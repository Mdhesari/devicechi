<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminInfoBox extends Component
{
   
    /**
     * box
     *
     * @var array
     */
    public $box;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $box)
    {
        $this->box = $box;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin-info-box');
    }
}
