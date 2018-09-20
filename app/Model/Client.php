<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'data', 'bairro', 'company', 'city', 'credits'
    ];
    // usado na homecontroller conta os inativos
    public static function inativos()
    {
        return DB::table('clients')
               ->select('id', 'name', 'phone', 'email', 'updated_at')
               ->whereDate('updated_at', '<=', date('Y-m-d', strtotime('-30 days')))
               ->get();
    }
    // usado na homecontroller lista os inativos
    public static function inativosPage($page)
    {
        return DB::table('clients')
               ->select('id', 'name', 'phone', 'email', 'updated_at')
               ->whereDate('updated_at', '<=', date('Y-m-d', strtotime('-30 days')))
               ->paginate($page);
    }

    // aniversário do cliente
    public static function birthday()
    {
        return DB::table('clients')
               ->select('id', 'name', 'phone', 'email', 'data')
               ->whereMonth('data', '=', date('m'))
               ->whereDay('data', '=',  date('d'))
               ->get();
    }

    // lista os clientes pelo orden alfabetica
    public static function ClientList($page)
    {
        return DB::table('clients')
               ->select('id','name', 'phone', 'email')
               ->orderByRaw('name', '=', 'ASC')
               ->paginate($page);
    }


}
