<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Report;
use App\Model\Product;
use Illuminate\Support\Facades\Input;
use DB;

class ReportController extends Controller
{

    public function index()
    {
        return view('report.index');
    }

    public function monthly()
    {
        return view('report.monthly'); 
    } 

    // relatório diario
    public function daily()
    {
        $date = Input::get('data');
        
        $date = date('Y-m-d', strtotime($date));
      
        if($date == NULL){
            return redirect()->back();
        }
       
        $data = explode("-" ,$date);
       
     
        $year   = $data[0];
        $month  = $data[1];
        $day    = $data[2];

        $daily = Report::daily($year, $month, $day);
       
        if(isset($daily)){
           
            return view('report.index' ,compact('daily', 'date'));
        }
        if($daily == null){
            return view('report.index' ,compact('daily', 'date'));
        }
       

    }

    // relatório mensal
    public function search()
    {

        $date = Input::get('data');
        
        $date = date('Y-m-d', strtotime($date));
      
        if($date == NULL){
            return redirect()->back();
        }
       
        $data = explode("-" ,$date);
       
     
        $year   = $data[0];
        $month  = $data[1];

        $report = Report::month($year, $month);

        if(isset($report)){
            return view('report.monthly' ,compact('report', 'date'));
        }
        
    }

}
