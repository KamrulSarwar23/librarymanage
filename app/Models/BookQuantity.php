<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookQuantity extends Model
{
    use HasFactory;
    // Define fillable columns
    protected $fillable = ['quantity', 'book_id', 'current_qty', 'status'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
