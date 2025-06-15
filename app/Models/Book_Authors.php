<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Book_Authors extends Model
{
    protected $table = 'book_authors';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'book_id',
        'author_id',
    ];

    public function books()
    {
        return $this->belongsTo(Books::class, 'book_id', 'book_id');
    }

    public function authors()
    {
        return $this->belongsTo(Authors::class, 'author_id', 'author_id');
    }
}
