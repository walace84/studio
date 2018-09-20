<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $fillable = [
        'product', 'description', 'price', 'phone', 'provider', 'points'
    ];

    // lista os produtos na ordem alfabetica
    public static function ClientProd()
    {
        return DB::table('products')
               ->select('id','product', 'description', 'price', 'provider', 'points', 'phone')
               ->orderByRaw('product', '=', 'ASC')
               ->get();
    }

}
