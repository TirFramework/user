<?php

namespace Tir\User\Scaffold;

use Tir\Crud\Support\Scaffold\BaseScaffold;
use Tir\Crud\Support\Scaffold\Fields\Select;
use Tir\Crud\Support\Scaffold\Fields\Text;

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
            Text::make('password')->creationRules('required', 'min:6')->onlyOnCreating(),
            Select::make('type')
            ->data( [['text' => 'Admin', 'value' => 'admin'], ['text' => 'User', 'value' => 'user']] ),
        ];

    }


}