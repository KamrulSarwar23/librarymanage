<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'category_id',
        'publisher_id',
        'isbn',
        'publication_date',
        'number_of_pages',
        'summary',
        'cover_image',
        'status',
        'quantity',
        'type',
        'preview',
        'shelf',
        'row'

    ];


    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rating()
    {
        return $this->hasMany(Review::class);
    }

    // define the relationship with BookQuantity
    public function quantities()
    {
        return $this->hasMany(BookQuantity::class);
    }

    public function borrow()
    {
        return $this->hasMany(Borrow::class, 'qty_id', 'id');
    }
}
