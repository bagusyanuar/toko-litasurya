<div
    class="{{ $parentClassName }}"
    wire:ignore
>
    <label class="text-sm text-neutral-700 {{ $label !== '' ? 'block mb-1' : '' }}">{{ $label }}</label>
    <div class="relative w-full h-full">
        <div class="dropzone" id="{{ $dropperID }}">
            <div class="dz-message text-center w-full flex flex-col items-center justify-center" wire:ignore>
                <i
                    data-lucide="cloud-upload"
                    class="text-brand-500 group-focus-within:text-neutral-900 w-16 h-16"
                    stroke-width="1"
                >
                </i>
                <p class="text-sm text-brand-500 font-semibold mt-1">Import your file</p>
                <p class="text-xs text-neutral-500">Drag or click to upload</p>
            </div>
        </div>
        <div x-show="{{ $dropperLoading }}">
            <div
                class="absolute inset-0 z-[20] bg-gray-900 bg-opacity-50 flex items-center justify-center text-white text-sm font-semibold"
                x-cloak
            >
                Uploading...
            </div>
        </div>
    </div>
</div>

<style>
    .dropzone {
        width: 100%;
        height: 12rem;
        border: 2px dashed #cceae5;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .dropzone:hover {
        background-color: #f8f8f8;
    }

    .dropzone .dz-progress {
        height: 10px !important; /* Menyesuaikan tinggi progress bar */
        background-color: #e6f5f2 !important; /* Warna latar belakang progress bar */
        border-radius: 2px !important; /* Menambahkan sudut membulat */
        overflow: hidden; /* Menyembunyikan bagian yang melebihi progress */
        border: 1px solid darkgrey !important;
    }

    /* Styling untuk progress bar yang terisi */
    .dropzone .dz-progress .dz-upload {
        height: 100% !important;;
        background-color: #4caf50 !important; /* Warna hijau untuk progress */
        width: 0%; /* Secara default, progress adalah 0% */
        transition: width 0.4s ease-in-out !important; /* Animasi smooth saat progress berubah */
    }

    /* Gaya tambahan untuk progress ketika proses upload berlangsung */
    .dropzone .dz-progress.dz-error .dz-upload {
        background-color: #f44336 !important; /* Warna merah jika terjadi error */
    }

    .dropzone .dz-message {
        font-size: 12px !important; /* Ukuran font */
        color: #94a3b8 !important; /* Warna teks */
    }

    .dz-error-mark {
        display: none !important;
    }

    .dz-default.dz-message {
        display: none;
    }
</style>
