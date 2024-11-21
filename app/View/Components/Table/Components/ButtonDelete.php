<?php

namespace App\View\Components\Table\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonDelete extends Component
{
    public $baseClass;
    public $modalKey;
    public $title;
    public $targetMenu;
    public $targetName;
    public $processTarget;
    public $processTargetLoading;

    /**
     * Create a new component instance.
     * @param $modalKey
     * @param $processTarget
     * @param $processTargetLoading
     * @param string $title
     * @param string $targetMenu
     * @param string $targetName
     */
    public function __construct(
        $modalKey,
        $processTarget,
        $processTargetLoading,
        $title = 'Apakah anda yakin ingin menghapus?',
        $targetMenu = 'Data',
        $targetName = 'yang anda pilih'
    )
    {
        $this->modalKey = $modalKey;
        $this->processTarget = $processTarget;
        $this->processTargetLoading = $processTargetLoading;
        $this->title = $title;
        $this->targetMenu = $targetMenu;
        $this->targetName = $targetName;
        $this->modalKey = $modalKey;
        $this->baseClass = 'bg-danger-500 text-white py-1 px-2 rounded-[4px] hover:bg-danger-700 transition-all duration-200 ease-in';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public
    function render(): View|Closure | string
    {
        return view('components.table.components.button-delete');
    }
}
