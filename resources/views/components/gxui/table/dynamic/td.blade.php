@props(['contentClass' => []])
@php
    $contentClassAttributes = new \Illuminate\View\ComponentAttributeBag(["class" => $contentClass])
@endphp
<div
    {{ $attributes->merge(["class" => "py-3 px-2.5"]) }}
>
    <div {{ $contentClassAttributes->merge(["class" => "w-full flex item-center text-neutral-700"]) }}>
        {{ $slot }}
    </div>
</div>
