<div>

    <style>
        /* custom css disini */
    </style>

     <form wire:submit="create">
        {{ $this->form }}
    </form>
    
    <x-filament-actions::modals />
</div>
