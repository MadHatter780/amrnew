<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Block extends Component
{
    /**
     * Create a new component instance.
     */
    public $addition;

    public function __construct($addition)
    {
        $this->addition = $addition;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.block');
    }
}
