<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\DbDumper\Databases\MySql;
class BackupDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'db backup';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 
        File::put(path: 'dump.sql',contents:'');
        MySql::create()
            ->setDbName(env(key: 'DB_DATABASE'))
            ->setUserName(env(key: 'DB_USERNAME'))
            ->setPassword(env(key: 'DB_PASSWORD'))
            ->setHOST(env(key: 'DB_HOST'))
            ->setPort(env(key: 'DB_PORT'))
            ->dumpToFile(base_path(path:'dump.sql'));

    }
}
