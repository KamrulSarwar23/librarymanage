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
        $borrowBooks = Borrow::where('status', 'pending')->get();

        foreach ($borrowBooks as $borrowBook) {
            if (strtotime($borrowBook->created_at) + (5 * 3600) >= strtotime(now())) {
                Log::info("Borrow ID {$borrowBook->id} is pending but not yet overdue");
                $bookQuantity = BookQuantity::find($borrowBook->qty_id);
                $bookQuantity->increment('current_qty');

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
