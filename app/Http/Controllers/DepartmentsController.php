<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Departments;
use App\Models\Employees;
use DB;
class DepartmentsController extends Controller
{
    public function getEmployees($departmentid,$id2,$id3){

    	// Fetch Employees by Departmentid
        //$empData['data'] = Employees::orderby("name","asc")
        //			->select('id','name')
        //			->where('department',$departmentid)
        //            ->get();
        if ($id3=='自付')
        {
            $empData['data'] = DB::select('select DISTINCT id,menu_restaurant,menu_item from order_menu where menu_meal=? and menu_plant=? and menu_type=?',[$id2,$departmentid,$id3]);
        }
        else
        {
            $empData['data'] = DB::select('select DISTINCT menu_item from order_menu where menu_meal=? and menu_plant=? and menu_type=?',[$id2,$departmentid,$id3]);
        }

        return response()->json($empData);
     
    }

    public function get_order_information($departmentid,$id2,$id3){

    	// Fetch Employees by Departmentid
        //$empData['data'] = Employees::orderby("name","asc")
        //			->select('id','name')
        //			->where('department',$departmentid)
        //            ->get();
                    
        $empData['data'] = DB::select('select * from order_information where inf_meal=? and inf_plant=? and inf_type =?',[$id2,$departmentid,$id3]);
        return response()->json($empData);
     
    }   

    public function get_order_menu($departmentid,$id2,$id3){

                    
        $empData['data'] = DB::select('select * from order_menu where menu_meal=? and menu_plant=? and menu_type =?',[$id2,$departmentid,$id3]);
        return response()->json($empData);
     
    }       
}