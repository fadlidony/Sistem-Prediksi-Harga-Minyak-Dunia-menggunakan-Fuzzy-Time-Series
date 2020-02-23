<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = 'dataset';

    protected $fillable = [
        'tanggal', 'harga',
    ];
}
