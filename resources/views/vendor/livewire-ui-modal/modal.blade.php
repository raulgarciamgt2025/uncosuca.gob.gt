<div>
    @isset($jsPath)
        <script>{!! file_get_contents($jsPath) !!}</script>
    @endisset
    @isset($cssPath)
        <style>{!! file_get_contents($cssPath) !!}</style>
    @endisset

    <div
        x-data="LivewireUIModal()"
        x-init="
            init();
            $watch('show', (show) => {
                if(show){
                    $($refs.livewireModal).modal('show');
                    return;
                }

                $($refs.livewireModal).modal('hide')
            });
            "
        x-on:close.stop="setShowPropertyTo(false)"
        x-on:keydown.escape.window="closeModalOnEscape()"
        x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
        x-ref="livewireModal"
        class="modal fade"
    >
        <div class="modal-dialog modal-lg" role="document" id="modal-container" x-on:click.away="closeModalOnClickAway()">
            <div class="modal-content">
                <div class="modal-body">
                    @forelse($components as $id => $component)
                        <div x-show.immediate="activeComponent == '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}">
                            @livewire($component['name'], $component['attributes'], key($id))
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
