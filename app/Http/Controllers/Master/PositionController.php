<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PositionController extends Controller
{
    function get_position(){
        $position=DB::table('position')->get();

        $data=[
            "menu" => "position",
            "sub_menu" => "Show",
            "table_title" => "Data position",
            "title" => "position",
            "position" => $position
        ];
        return view('dashboard.master.position.show',["data" => $data]);
    }

    function get_position_json(Request $r){

        $limit = $r->input('length');
        $start = $r->input('start');
        $search = $r->input('search.value');

        $data = DB::table('position as e')
            ->offset($start)
            ->limit($limit)
            ->get();
        $i_display = DB::table('position as e')
            ->offset($start)
            ->limit($limit)
            ->count();
        $total_filter = $i_display;
        if (!empty($search)) {
            $data = DB::table('position as e')
                ->where(function ($query) use ($search) {
                    $query->where('e.position_code', 'LIKE', "%" . $search . "%");

                })
                ->offset($start)
                ->limit($limit)
                ->get();
            $total_filter = DB::table('position as e')
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

    function delete_position(Request $r){
        $position=$r->position_code;

        DB::table('position')->where('position_code',$position)->delete();

        return response()->json([
            "code" => 200,
            "message" => "Success Delete"
        ]);
    }

    function post_position(Request $r){
        $p_name=$r->p_name;
        $p_code=$r->p_code;

        $data=[
            "position_name" => $p_name,
            "position_code" => $p_code
        ];

        $c_em=DB::table('position')->where('position_code',$p_code)->first();

        if (!empty($c_em)){
            return response()->json([
                "code" => 2400,
                "message" => "Position is not available"
            ]);
        }

        DB::table('position')->insert($data);

        return response()->json([
            "code" => 2200,
            "message" => "Success to Input Data"
        ]);
    }
}
