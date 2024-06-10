<?php

namespace App\Models;

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
    ];

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
