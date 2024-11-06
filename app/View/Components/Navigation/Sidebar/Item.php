<?php

namespace App\View\Components\Navigation\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public $title;
    public $to;
    public $icon;
    public $active;

    /**
     * Create a new component instance.
     * @param string $title
     * @param string $to
     * @param string $icon
     * @param bool $active
     */
    public function __construct($title = '', $to = '#', $icon = 'circle', $active = false)
    {
        $this->title = $title;
        $this->to = $to;
        $this->icon = $icon;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.sidebar.item');
    }
}
