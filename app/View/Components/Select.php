<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{

    public $id;

    public $name;

    public $label;

    public $visibility;

    public $type;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $label, $name, $visibility = true, $type = null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->name = $name;
        $this->visibility = $visibility;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
