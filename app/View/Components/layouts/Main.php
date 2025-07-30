<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    /**
     * Create a new component instance.
     */

    // title
    public string $title = '';
    // actions
    public array $actions = [];
    // breadcrumbs
    public array $breadcrumbs = [];

    public function __construct($actions = [], $title = '',  $breadcrumbs = [])
    {
        $this->title = $title;
        $this->actions = $actions;
        $this->breadcrumbs = $breadcrumbs;
        // $this->page_active = $page_active;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.main');
    }
}
