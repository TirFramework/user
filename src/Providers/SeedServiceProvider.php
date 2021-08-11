<?php


namespace Tir\User\Providers;


use Tir\Crud\CrudServiceProvider;
use Tir\Crud\Providers\CrudSeedServiceProvider;
use Tir\User\Database\Seeders\DatabaseSeeder;

class SeedServiceProvider extends CrudSeedServiceProvider
{
    public function boot()
    {
        $this->seeders = [
            DatabaseSeeder::class
        ];
        parent::boot();
    }
}