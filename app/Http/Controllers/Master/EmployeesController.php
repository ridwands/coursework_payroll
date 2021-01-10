<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EmployeesController extends Controller
{
    function get_employees(){


        $position=DB::table('position')->get();

        $data=[
            "menu" => "Employees",
            "sub_menu" => "Show",
            "table_title" => "Data Employees",
            "title" => "Employees",
            "position" => $position
        ];
        return view('dashboard.master.employees.get_employees',["data" => $data]);
    }

    function get_employees_json(Request $r){

        $limit = $r->input('length');
        $start = $r->input('start');
        $search = $r->input('search.value');

        $data = DB::table('m_employees as e')
            ->offset($start)
            ->limit($limit)
            ->get();
        $i_display = DB::table('m_employees as e')
            ->offset($start)
            ->limit($limit)
            ->count();
        $total_filter = $i_display;
        if (!empty($search)) {
            $data = DB::table('m_employees as e')
                ->where(function ($query) use ($search) {
                    $query->where('e.nik', 'LIKE', "%" . $search . "%");

                })
                ->offset($start)
                ->limit($limit)
                ->get();
            $total_filter = DB::table('m_employees as e')
                ->where(function ($query) use ($search) {
                    $query->where('e.nik', 'LIKE', "%" . $search . "%");
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

    function delete_employee(Request $r){
        $nik=$r->nik;

        DB::table('m_employees')->where('nik',$nik)->delete();

        return response()->json([
            "code" => 200,
            "message" => "Success Delete"
        ]);
    }

    function post_employees(Request $r){
        $nik=$r->nik;
        $name=$r->name;
        $position=$r->position;

        $data=[
            "nik" => $nik,
            "name" => $name,
            "position_code" => $position
        ];

        $c_em=DB::table('m_employees')->where('nik',$nik)->first();

        if (!empty($c_em)){
            return response()->json([
                "code" => 2400,
                "message" => "Nik is not available"
            ]);
        }

        DB::table('m_employees')->insert($data);

        return response()->json([
            "code" => 2200,
            "message" => "Success to Input Data"
        ]);
    }
}
