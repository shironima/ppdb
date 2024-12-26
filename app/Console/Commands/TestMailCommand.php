<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mail {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test sending an email to a specified address';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');

        try {
            Mail::raw('This is a test email from Laravel.', function ($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email');
            });

            $this->info('Test email sent successfully to ' . $email);
        } catch (\Exception $e) {
            $this->error('Failed to send email. Error: ' . $e->getMessage());
        }

        return 0;
    }
}
