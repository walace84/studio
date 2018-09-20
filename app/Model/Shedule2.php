<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class shedule2 extends Model
{
    protected $fillable = [
        'name', 'phone', 'date', 'hora', 'color'
    ];

    // agendamento do dia
    public static function Sheduleday2()
    {
        return DB::table('shedule2s')
               ->select('id','name','phone','date', 'hora', 'color')
               ->whereDate('date', '=', date('Y/m/d'))
               ->orderBy('hora', 'asc')
               ->get();
    }

    public static function sheduleSelect2($date)
    {
        return DB::table('shedule2s')
               ->select('id','name','phone','date', 'hora', 'color')
               ->whereDate('date', '=', date('Y-m-d', strtotime($date)))        
               ->orWhere('name', '=', $date)
               ->orderBy('hora', 'asc')
               ->get();
    }
}
