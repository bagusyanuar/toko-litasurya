<?php

namespace App\View\Components\Typography;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionTitle extends Component
{
    public $title;
    public $baseClass;

    /**
     * Create a new component instance.
     * @param string $title
     */
    public function __construct($title = 'Section Title')
    {
        $this->title = $title;
        $this->baseClass = 'text-neutral-500 text-sm font-semibold';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.typography.section-title');
    }
}
