<?php

namespace Tir\User\Scaffold;

use Tir\Crud\Support\Scaffold\BaseScaffold;
use Tir\Crud\Support\Scaffold\Fields\Password;
use Tir\Crud\Support\Scaffold\Fields\Select;
use Tir\Crud\Support\Scaffold\Fields\Text;
use Tir\FileManager\Scaffold\Fields\FileUploader;

trait UserScaffold
{
    use BaseScaffold;


    public function setLocale(): bool
    {
        return true;
    }

    protected function setModuleName(): string
    {
        return 'user';
    }

    protected function setFields(): array
    {
        return [
            Text::make('name')->rules('required'),
            Text::make('email')->rules('required', 'unique:users,email,' . $this->id),
            FileUploader::make('profile')->maxCount(1)->hideFromIndex(),
            Password::make('password')->creationRules('required', 'min:6')->hideFromIndex(),
            Select::make('type')
            ->data( [['text' => 'Admin', 'value' => 'admin'], ['text' => 'User', 'value' => 'user']] )->rules('required'),
            Select::make('roles')->relation('roles','name' )->multiple()->rules('required'),
            Select::make('status')->data([['label'=>'Disabled','value'=>'disabled'], ['label'=>'Enabled','value'=>'enabled']])->rules('required')
        ];

    }


}
