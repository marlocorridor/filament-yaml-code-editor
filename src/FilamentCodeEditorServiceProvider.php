<?php

namespace KamotePh\FilamentCodeEditor;

use Filament\Facades\Filament;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;

class FilamentCodeEditorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-code-editor')->hasViews();
    }

    public function bootingPackage() {
        FilamentAsset::register([
            Js::make('filament-tools', __DIR__.'/../dist/filament-tools.js'),
        ]);
    }
}
