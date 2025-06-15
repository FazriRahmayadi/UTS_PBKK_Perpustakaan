<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'book_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'book_id',
        'title',
        'isbn',
        'publisher',
        'year_published',
        'stock',
    ];
}
