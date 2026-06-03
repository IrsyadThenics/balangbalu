<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\OracleResetService;

class MigrateFreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:fresh 
                            {--database= : The database connection to use}
                            {--path= : The path to the migrations}
                            {--realpath : Treat the path as a real, absolute path}
                            {--seed : Indicate that the seed task should be re-run}
                            {--seeder= : The class name of the root seeder}
                            {--force : Force the operation to run when in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables and re-run all migrations (Oracle-safe)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return 1;
        }

        // Use custom reset for Oracle
        if (config('database.default') === 'oracle') {
            $this->components->info('Dropping all Oracle tables and sequences...');
            try {
                OracleResetService::dropAllTables();
                $this->components->info('All tables and sequences dropped successfully.');
            } catch (\Exception $e) {
                $this->components->error('Error dropping tables: ' . $e->getMessage());
                return 1;
            }
        } else {
            // Use default behavior for other databases
            $this->call('migrate:reset', array_filter([
                '--database' => $this->option('database'),
                '--force' => true,
            ]));
        }

        // Run migrations
        $this->components->info('Running migrations...');
        
        $this->call('migrate', array_filter([
            '--database' => $this->option('database'),
            '--path' => $this->option('path'),
            '--realpath' => $this->option('realpath'),
        ]));

        // Run seeding if requested
        if ($this->option('seed') || $this->option('seeder')) {
            $this->components->info('Running seeders...');
            $this->call('db:seed', array_filter([
                '--database' => $this->option('database'),
                '--class' => $this->option('seeder'),
            ]));
        }

        return 0;
    }

    /**
     * Confirm before proceeding in production.
     */
    protected function confirmToProceed()
    {
        if ($this->option('force')) {
            return true;
        }

        if (app()->environment() === 'production') {
            return $this->confirm('This action will drop all tables. Continue?');
        }

        return true;
    }
}
