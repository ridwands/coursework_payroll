<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    function get_salary(){
        $position=DB::table('position')->get();

        $data=[
            "menu" => "salary",
            "sub_menu" => "Show",
            "table_title" => "Data salary",
            "title" => "salary",
            "position" => $position
        ];
        return view('dashboard.master.salary.show',["data" => $data]);
    }

    function get_salary_json(Request $r){

        $limit = $r->input('length');
        $start = $r->input('start');
        $search = $r->input('search.value');

        $data = DB::table('m_salary as e')
            ->offset($start)
            ->limit($limit)
            ->get();
        $i_display = DB::table('m_salary as e')
            ->offset($start)
            ->limit($limit)
            ->count();
        $total_filter = $i_display;
        if (!empty($search)) {
            $data = DB::table('m_salary as e')
                ->where(function ($query) use ($search) {
                    $query->where('e.position_code', 'LIKE', "%" . $search . "%");

                })
                ->offset($start)
                ->limit($limit)
                ->get();
            $total_filter = DB::table('m_salary as e')
                ->where(function ($query) use ($search) {
                    $query->where('e.position_code', 'LIKE', "%" . $search . "%");

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

    function delete_salary(Request $r){
        $id=$r->id;

        DB::table('m_salary')->where('id',$id)->delete();

        return response()->json([
            "code" => 200,
            "message" => "Success Delete"
        ]);
    }

    function post_salary(Request $r){
        $salary = $r->input('salary');
        $salary = explode('.', $salary);
        $salary = implode($salary);
        $p_code=$r->p_code;
        $id=\Str::random(10);
        $data=[
            "id" => $id,
            "salary_per_hour" => $salary,
            "position_code" => $p_code
        ];

        $c_em=DB::table('m_salary')->where('position_code',$p_code)->first();

        if (!empty($c_em)){
            return response()->json([
                "code" => 2400,
                "message" => "Salary already input"
            ]);
        }

        DB::table('m_salary')->insert($data);

        return response()->json([
            "code" => 2200,
            "message" => "Success to Input Data"
        ]);
    }
}
