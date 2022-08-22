<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable = ['amount'];
    function relationtoproduct(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
