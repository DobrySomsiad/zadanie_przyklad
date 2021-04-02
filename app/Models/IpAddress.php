<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    protected $table = 'ip_address';
    protected $fillable = [
        'id',
        'ip_address',
    ];

}
