<?php

namespace App\Console\Commands;

use App\Models\Borrow;
use App\Models\BookQuantity;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RejectPendingBorrowBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'borrows:reject-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reject pending borrow books if overdue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve borrow records with status 'pending'
        $borrowBooks = Borrow::where('status', 'pending')->get();

        foreach ($borrowBooks as $borrowBook) {
            // Check if the borrow request is older than 5 hours
            if (strtotime($borrowBook->created_at) + (60) <= strtotime(now())) {
                Log::info("Borrow ID {$borrowBook->id} is pending and now overdue.");

                // Find the book quantity record associated with the borrow request
                $bookQuantity = BookQuantity::find($borrowBook->qty_id);

                if ($bookQuantity) {
                    // Increment the current quantity of the book
                    $bookQuantity->increment('current_qty');
                } else {
                    Log::warning("BookQuantity ID {$borrowBook->qty_id} not found for Borrow ID {$borrowBook->id}");
                }

                // Update the borrow request status to 'reject' and reset other fields
                $borrowBook->update([
                    'status' => 'reject',
                    'issued_at' => null,
                    'returned_at' => null,
                ]);
            }
        }
        
        $this->info('Pending borrow books rejected.');
    }
}
