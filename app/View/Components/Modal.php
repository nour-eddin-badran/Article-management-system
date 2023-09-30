<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{

    /** @var */
    public $id;

    /** @var */
    public $title;

    /** @var */
    public $uri;

    /** @var */
    public $dataTableId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $uri, $dataTableId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->uri = $uri;
        $this->dataTableId = $dataTableId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
