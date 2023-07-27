<?php

namespace Modules\Admin\View;

use Illuminate\View\Component;

class ListGroupItems extends Component
{

    public $data;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('admin::components.list', [
            'data' => $this->data,
        ]);
    }
}
