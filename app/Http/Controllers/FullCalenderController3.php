<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Routing\Controller;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Auth;

class FullCalenderController3 extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {

        if($request->ajax()) {
             //$data = Event::whereDate('start', '>=', $request->start)
             //          ->whereDate('end',   '<=', $request->end)
             //          ->get(['id', 'title', 'start', 'end']);
             $sql = "select id,title,start,end,
             CASE event_meal   
                WHEN '午餐' THEN '#eb7f47'
                WHEN '晚餐' THEN '#0288d1'   
             END as color   
             from Events
             where  start>='".$request->start."' and end <='".$request->end."' ";
             $data = DB::select($sql);
             return response()->json($data);
        }
  
        return view('fullcalender3');
    }

    public function delete_order(Request $request)
    {

        if($request->ajax()) {
             //$data = Event::whereDate('start', '>=', $request->start)
             //          ->whereDate('end',   '<=', $request->end)
             //          ->get(['id', 'title', 'start', 'end']);
             $sql = "select id,title,start,end,
             CASE event_meal   
                WHEN '午餐' THEN '#eb7f47'
                WHEN '晚餐' THEN '#0288d1'   
             END as color   
             from Events
             where  start>='".$request->start."' and end <='".$request->end."' ";
             $data = DB::select($sql);
             return response()->json($data);
        }
  
        return view('delete_order');
    }     
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}