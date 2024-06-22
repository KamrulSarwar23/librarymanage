<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'issued_at',
        'due_at',
        'qty_id',
        'returned_at',
        'status',
        'notify',
        'platform',
        'fine'
    ];
    
    public function calculateFine()
    {

        $policy = Policy::first();

        if ($this->due_at) {
            $dueDate = Carbon::parse($this->due_at)->startOfDay(); // Ensure dueDate is at the start of the day
            $currentDate = $this->returned_at ? Carbon::parse($this->returned_at)->startOfDay() : Carbon::now()->startOfDay();

            if ($currentDate->greaterThan($dueDate)) {
                $daysOverdue = $dueDate->diffInDays($currentDate); // Only count full days
                $finePerDay =  $policy->fine_amount; // Set your fine amount per day in integer
                return $daysOverdue * $finePerDay;
            }
        }
        return 0;
    }


    // Define the relationships with User and Book models
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookQty()
    {
        return $this->belongsTo(BookQuantity::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
