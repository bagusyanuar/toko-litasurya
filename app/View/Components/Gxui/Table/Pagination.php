<?php

namespace App\View\Components\Gxui\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $perPageOptions;
    public $shownPages;
    public $currentPage;

    /**
     * Create a new component instance.
     * @param string $shownPages
     * @param string $perPageOptions
     * @param int $currentPage
     */
    public function __construct(
        $shownPages = '[]',
        $perPageOptions = '[10, 25, 50]',
        $currentPage = 0
    )
    {
        $this->shownPages = $shownPages;
        $this->perPageOptions = $perPageOptions;
        $this->currentPage = $currentPage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gxui.table.pagination');
    }
}
