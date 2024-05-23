<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
        :label-sr-only="$isLabelHidden()"
>
    <div
        x-data="codeEditorFormComponent({
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
            autocomplete_variables: @js($getAutoCompleteVariables()),
            @if($darkMode() == 'media')
			theme: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'materialDark' : 'materialLight'),
			@elseif($darkMode() == 'class')
			theme: (document.querySelector('html').getAttribute('class').includes('dark') ? 'materialDark' : 'materialLight'),
			@elseif($darkMode() == 'force')
			theme: 'materialDark',
			@elseif($darkMode() == false)
			theme: 'materialLight',
			@else
			theme: (window.matchMedia('(prefers-color-scheme: dark)').matches || document.querySelector('html').getAttribute('class').includes('dark') ? 'materialDark' : 'materialLight'),
			@endif
        })"
    >
        <div
            wire:ignore
            class="w-full border rounded-lg overflow-hidden border-gray-300 dark:border-gray-600"
            x-ref="codeeditor"
            style="min-height: 150px;"
        ></div>
    </div>

    <style>
        .cm-gutters {
            min-height: 150px !important;
        }

        .cm-scroller {
            min-height: 150px !important;
        }

        .cm-gutters {
            min-height: 150px !important;
        }
    </style>

</x-dynamic-component>
