<?php

namespace KamotePh\FilamentCodeEditor\Components;

use Filament\Forms\Components\Field;
//use Filament\Support\Concerns\EvaluatesClosures;

class CodeEditor extends Field
{
//    use EvaluatesClosures;
    protected string $view = 'filament-code-editor::components.code-editor';
    protected \Closure|array $autoCompleteVariables = [];
    protected string|bool $darkMode;

    protected function setUp(): void
    {
        parent::setUp();
        $this->darkMode = config('filament-code-editor.darkMode', 'auto');
    }

    public function darkMode(): string | bool
    {
        return $this->darkMode;
    }


    public function autoCompleteVariables(\Closure|array $values): static {
        $this->autoCompleteVariables = $values;
        return  $this;
    }

    public function getAutoCompleteVariables(): array {
        return  (array) $this->evaluate($this->autoCompleteVariables);
    }
}
