<?php

namespace App\View\Components\panel\layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class admin extends Component
{
    public $pageinfo ;
    /**
     * Create a new component instance.
     */
    public function __construct($pageinfo)
    {
        $this->pageinfo = $pageinfo;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.panel.layout.admin');
    }
}
