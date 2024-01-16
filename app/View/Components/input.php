<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     */

    public $label;
    public $name;
    public $type;


    public function __construct($label, $name, $type)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
