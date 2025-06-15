<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'loan_id',
        'user_id',
        'book_id',
    ];

    public function user()
    {
        return $this->belongsTo(User1::class, 'user_id', 'user_id');
    }

    public function books()
    {
        return $this->belongsTo(Books::class, 'book_id', 'book_id');
    }
}
