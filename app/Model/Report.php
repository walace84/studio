<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Report extends Model
{
    protected $fillable = [
        'total', 'status', 'product_id', 'client_id', 'prodname', 'order_id'
    ];


    // busca do Relatório diário
    public static function daily($year, $month, $day)
    {
        return DB::table('reports')
        ->join('products', 'products.id', '=', 'reports.product_id')
        ->select('products.product', 'products.price')
        ->selectRaw('product_id, sum(total) as total, count(1) as qtd')
        ->whereMonth('reports.created_at', '=', $month)
        ->whereYear('reports.created_at','=', $year)
        ->whereDay ('reports.created_at','=', $day)
        ->groupBy('product_id', 'products.product', 'products.price')
        ->orderBy('product_id', 'desc')->first();
    }

    // busca do Relatório mensal
    public static function month($year, $month)
    {
        return DB::table('reports')
        ->join('products', 'products.id', '=', 'reports.product_id')
        ->select('products.product', 'products.price')
        ->selectRaw('product_id, sum(total) as total, count(1) as qtd')
        ->whereMonth('reports.created_at', '=', $month)
        ->whereYear('reports.created_at','=', $year)
        ->groupBy('product_id', 'products.product', 'products.price')
        ->orderBy('product_id', 'desc')->get();
    }

}
