<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    function show_att(){

        $m_employees=DB::table('m_employees')->get();
        $data=[
            "menu" => "Attendance",
            "sub_menu" => "Show",
            "table_title" => "Data Attendance",
            "title" => "Attendance",
            "m_employees" => $m_employees
        ];
        return view('dashboard.attendance.show',["data" => $data]);
    }


    function show_att_json(Request $r){
      
        $limit = $r->input('length');
        $start = $r->input('start');
        $search = $r->input('search.value');

        $data = DB::table('attendance as a')
            ->offset($start)
            ->limit($limit)
            ->get();
        $i_display = DB::table('attendance as a')
            ->offset($start)
            ->limit($limit)
            ->count();
        $total_filter = $i_display;
        if (!empty($search)) {
            $data = DB::table('attendance as a')
                ->where(function ($query) use ($search) {
                    $query->where('a.nik', 'LIKE', "%" . $search . "%");

                })
                ->offset($start)
                ->limit($limit)
                ->get();
            $total_filter = DB::table('attendance as a')
                ->where(function ($query) use ($search) {
                    $query->where('a.nik', 'LIKE', "%" . $search . "%");

                })
                ->offset($start)
                ->limit($limit)
                ->count();

        }

        $no = 1+$start;
        foreach ($data as $item) {
            $item->no = $no++;
        }

        return response()->json([
            "draw" => intval($r->input('draw')),
            'recordsFiltered' => $total_filter,
            'recordsTotal' => $i_display,
            "data" => $data,
        ]);
    }

    function post_att(Request $r){
        $nik=$r->nik;
        $date=$r->date;
        $time_in=$r->time_in;
        $time_out=$r->time_out;

        $id= \Str::random('10');

        $data=[
            "id" => $id,
            "nik" => $nik,
            "date_in" => $date,
            "time_in" => $time_in,
            "time_out" => $time_out
        ];
        DB::table('attendance')->insert($data);

        return response()->json([
            "code" => 2200,
            "message" => "success input"
        ]);
    }
}
