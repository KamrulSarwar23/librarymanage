<?php

namespace App\Console\Commands;

use App\Models\Borrow;
use App\Mail\DueDateReminder;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendDueDateReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send-due-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send due date reminders to users with borrowed books due soon';
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
     * @return int
     */
    public function handle()
    {
        $return_books = Borrow::whereNotNull('issued_at')
            ->whereNotNull('due_at')
            ->whereNull('returned_at')
            ->where('notify', false)
            ->get();

        foreach ($return_books as $return_book) {
            if (strtotime($return_book->due_at) - 86400 == strtotime(Carbon::today()->toDateString())) {
                $recipientEmail = $return_book->user->email;

                // Send email
                Mail::to($recipientEmail)->send(new DueDateReminder($return_book));
                $return_book->update(['notify' => true]);

                // Optionally, you can log the action
                // Log::info("Due date reminder email sent for Borrow ID: " . $return_book->id);
            }
        }

        $this->info('Due date reminders have been processed.');
    }
}
