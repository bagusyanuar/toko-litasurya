<?php

namespace App\View\Components\Tab;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UiTabItem extends Component
{
    public $title;
    public $icon;
    public $active;
    public $handleChange;

    /**
     * Create a new component instance.
     * @param string $title
     * @param string $icon
     * @param bool $active
     * @param $handleChange
     */
    public function __construct($title = '', $icon = 'circle', $active = false, $handleChange = '')
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->active = $active;
        $this->handleChange = $handleChange;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tab.ui-tab-item');
    }
}
