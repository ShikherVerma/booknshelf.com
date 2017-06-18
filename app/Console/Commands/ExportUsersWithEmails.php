<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use League\Csv\Writer;

class ExportUsersWithEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:export-users-with-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all users that have email address set (for newsletter).';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne(\Schema::getColumnListing('users'));

        User::whereNotNull('email')->each(function ($user) use ($csv) {
            $csv->insertOne($user->toArray());
        });

        $csv->output('users_with_emails.csv');
    }
}
