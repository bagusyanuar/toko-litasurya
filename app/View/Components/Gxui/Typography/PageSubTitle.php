<?php

namespace App\View\Components\Gxui\Typography;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageSubTitle extends Component
{
    public $text;

    /**
     * Create a new component instance.
     * @param string $text
     */
    public function __construct($text = 'Page Sub Title')
    {
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.typography.page-sub-title');
    }
}
