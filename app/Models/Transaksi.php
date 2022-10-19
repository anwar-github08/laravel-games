<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function game()
    {
        return $this->belongsTo(Games::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
