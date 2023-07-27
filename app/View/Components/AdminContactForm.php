<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminContactForm extends Component
{

    public $id;
    public $contacts;
    public $formId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($contacts = [], $formId = "submit-form", $id = "contacts-form")
    {
        $this->contacts = $contacts;
        $this->formId = $formId;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-contact-form');
    }
}
