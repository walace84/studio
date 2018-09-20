<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderProd extends Model
{
    protected $fillable = [
        'price', 'status', 'order_id', 'product_id', 'product', 'points', 'client_id', 'discount'
    ];

     // faz o relacionamento da table OrderProd com a table product
     // através do product_id da tabela product e o id da tabela OrderProd
    public function Tableprod()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


}
