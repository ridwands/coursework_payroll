<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class ReportController extends Controller
{
    function show(Request $r){
        $data=[
            "menu" => "Attendance",
            "sub_menu" => "Show",
            "table_title" => "Data Attendance",
            "title" => "Attendance",
        ];
        return view('dashboard.report.show',["data" => $data]);
    }

    function get_pdf(Request $r){
        // return view('dashboard.report.pdf');
        $month=$r->input('month');
        $year=$r->input('year');

       
switch ($month) {
    case "01":
      $monthName="January";
      break;
      case "02":
      $monthName="February";
      break;
      case "03":
      $monthName="March";
      break;
      case "04":
      $monthName="April";
      break;
      case "05":
      $monthName="Mei";
      break;
      case "06":
      $monthName="June";
      break;
      case "07":
      $monthName="July";
      break;
      case "08":
      $monthName="August";
      break;
      case "09":
      $monthName="September";
      break;
      case "10":
      $monthName="November";
      break;
      case "11":
      $monthName="November";
      break;
      case "12":
      $monthName="December";
      break;
    default:
     $monthName=NULL;
  }

        $where=$year.'-'.$month;
        $report=DB::table('attendance as a')
            ->join('m_employees as e','e.nik','a.nik')
            ->join('m_salary as s','s.position_code','e.position_code')
            ->select('e.*','a.*','s.*')
            ->where('a.date_in', 'like', '%'.$where.'%')
            ->get();
            // dd($report);
        
        $data=[];

        foreach ($report as $item_order) {
            $shouldAdd = true;

            $start = strtotime($item_order->time_in.':00');
            $end = strtotime($item_order->time_out.':00');
            $total_work = ($end - $start)/3600;
           
            $item_order->total_work=$total_work;
            $item_order->salary=$total_work*$item_order->salary_per_hour;



            foreach ($data as $key => $item_data) {
                if ($item_data['nik'] == $item_order->nik) {
                    $data_order = $item_order->salary;
                    array_push($data[$key]['salary'], $data_order);
                    $shouldAdd = false;
                }
            }

            if ($shouldAdd) {
                $data_order = [
                    "nik" => $item_order->nik,
                    "salary" => [
                      $item_order->salary,
                 
                    ],
                ];
                array_push($data, $data_order);
            }

        }


        $t_data=[];
        foreach ($data as $item){
           $t=array_sum($item['salary']);
           $arr=round($t,2);
           $d=[
                "nik" => $item['nik'],
                "total" => $arr,
           ];
            array_push($t_data,$d);
        }
    
        // return view('dashboard.report.pdf',['data' => $t_data]);
        // dd($monthName);
        $pdf = PDF::loadView('dashboard.report.pdf',['data' => $t_data, 'monthName' => $monthName]);
        return $pdf->stream();
    }
}
