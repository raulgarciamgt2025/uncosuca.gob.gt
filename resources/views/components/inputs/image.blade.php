@props(['label', 'description', 'name'])

<div class="mb-3">
    <x-inputs.basic
        type="file"
        accept=".png, .jpg"
        :name="$name"
        label="{{ $label ?? ''}}"
        :attributes="$attributes">
    </x-inputs.basic>
    <small class="form-text text-muted">{{ $description }}</small>
</div>
