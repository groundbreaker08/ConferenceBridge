<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->truncateAllTables();
        $this->seedAllTables();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();

    }
    public function truncateAllTables(){
        // Truncate all tables, except migrations
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            if ($table->Tables_in_conferencebridge !== 'migrations')
                DB::table($table->Tables_in_conferencebridge)->truncate();
        }
    }
    public function seedAllTables(){
        $this->call('CompanySeeder');
        $this->call('LanguageSeeder');

        $this->call('ConferenceTypeSeeder');
        $this->call('ConferenceVenuesSeeder');

        $this->call('PermissionSeeder');
        $this->call('RoleSeeder');
        
        $this->call('Permission_RoleSeeder');

        $this->call('UserSeeder');
        $this->call('ContactSeeder');
        $this->call('Role_UserSeeder');
    }
}
