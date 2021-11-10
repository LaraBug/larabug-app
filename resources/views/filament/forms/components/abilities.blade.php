<x-forms::field-group
    :column-span="$formComponent->getColumnSpan()"
    :error-key="$formComponent->getName()"
    :for="$formComponent->getId()"
    :help-message="$formComponent->getHelpMessage()"
    :hint="$formComponent->getHint()"
    :label="$formComponent->getLabel()"
    :required="$formComponent->isRequired()"
>
    <div class="space-y-3">
        @foreach($formComponent->getAbilities() as $key => $label)
            <div class="flex items-center space-x-3">
                <input
                    type="checkbox"
                    id="{{ $key }}"
                    name="{{ $formComponent->getName() . '.' . $key }}"
                    {!! $formComponent->isChecked($key) ? 'checked=checked' : null !!}
                    {!! $formComponent->getName() ? "{$formComponent->getBindingAttribute()}=\"{$formComponent->getNameForOption($key)}\"" : null !!}
                    class="rounded text-primary-600 shadow-sm focus:border-primary-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50 {{ $errors->has($formComponent->getName()) ? 'border-danger-600 ' : 'border-gray-300' }}">
                <label class="text-sm font-medium leading-tight" for="{{ $key }}">{{ $label }}</label>
            </div>
        @endforeach
    </div>
</x-forms::field-group>
