<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        "id",
        "delivery_date",
        "product",
        "sender",
        "destination",
        "qty",
        "note",
    ];

    public function products(){
        return $this->hasOne(Product::class, 'id', 'product');
    }

}
