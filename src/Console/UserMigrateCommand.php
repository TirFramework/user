<?php 

namespace Tir\User\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Output\BufferedOutput;

class UserMigrateCommand extends Command 
{
    protected $signature = 'user:migrate';

    protected $description = 'Run user migrations';

    public function handle()
    {
        $output = new BufferedOutput;
        
        $this->call('migrate', ['--path'=> '/vendor/tir/user/src/Database/Migrations'], $output);
        $output->fetch();
    }
}


