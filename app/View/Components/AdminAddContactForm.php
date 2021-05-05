<?php

namespace App\View\Components;

use App\Models\Ad\AdContact;
use App\Models\Ad\AdContactType;
use Illuminate\View\Component;

class AdminAddContactForm extends Component
{

    public $contact;
    public $selected;
    public $contactTypes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($contact = null, $selected = false, $contactTypes = null)
    {
        $this->contact = $contact ?: new AdContact;
        $this->selected = $selected;
        $this->contactTypes = $contactTypes ?: AdContactType::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-add-contact-form');
    }
}
