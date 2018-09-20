<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Shedule extends Model
{
    protected $fillable = [
        'name', 'phone', 'date', 'hora', 'color'
    ];

    // agendamento do dia
    public static function Sheduleday()
    {
        return DB::table('shedules')
               ->select('id','name','phone','date', 'hora', 'color')
               ->whereDate('date', '=', date('Y/m/d'))
               ->orderBy('hora', 'asc')
               ->get();
    }

    public static function sheduleSelect($date)
    {
        return DB::table('shedules')
               ->select('id','name','phone','date', 'hora', 'color')
               ->whereDate('date', '=', date('Y-m-d', strtotime($date)))
               ->orWhere('name', '=', $date)
               ->orderBy('hora', 'asc')
               ->get();
    }


}
