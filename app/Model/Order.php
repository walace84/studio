<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $fillable = [
        'client_id', 'status'
    ];

     // faz uma consulta para verificar se existe um pepido reservado
     public static function queryId($where)
     {
         $pedido = self::where($where)->first(['id']);
         // se o valor do pedido.id não for vazio retorna para a função
         return !empty($pedido->id) ? $pedido->id : null;
     }

     // item da orderProd
     public function OrderproductItens()
     {
         return $this->hasMany(OrderProd::class);
     }


     // faz a soma do valores que está na tabela orderProd
     public function TableOrderprod()
     {
         return $this->hasMany(OrderProd::class)
             ->select( \DB::raw('product_id, sum(discount) as discount, sum(price) as price, count(1) as qtd') )
             ->groupBy('product_id')
             ->orderBy('product_id', 'desc');
     }

}
