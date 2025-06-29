@props([
    'name',
    'label',
    'value',
    'disabled' => null
])

<x-inputs.basic :disabled="$disabled" type="text" :name="$name" label="{{ $label ?? ''}}" :value="$value ?? ''" :attributes="$attributes" maxlength="255"></x-inputs.basic>
