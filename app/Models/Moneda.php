<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;
    
    protected $table = 'moneda';
    
     protected $fillable = ['name', 'symbol', 'country', 'value', 'date'];
    
}
