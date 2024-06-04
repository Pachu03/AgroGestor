<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;
use App\Models\User;

class TestMailCommand extends Command
{
    protected $signature = 'test:mail';
    protected $description = 'Send a test email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $user = User::first(); // Asegúrate de que tienes un usuario en la base de datos
        if (!$user) {
            $this->error('No user found in the database.');
            return;
        }

        try {
            Mail::to($user->email)->send(new UserCreatedMail($user));
            $this->info('Test email sent successfully.');
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
        }
    }
}
