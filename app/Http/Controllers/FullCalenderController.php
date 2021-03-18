<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Routing\Controller;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Auth;


class FullCalenderController extends Controller
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
             $event_jobid =Auth::user()->jobid;
             $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->where('event_jobid',   '=', $event_jobid)
                       ->get(['id', 'title', 'start', 'end']);
  
             return response()->json($data);
        }
  
        return view('fullcalender');
    }

    public function Company_lunch(Request $request)
    {
        $event_jobid =Auth::user()->jobid;
        if($request->ajax()) {
             $data = Event::whereDate('start', '=', $request->start)
                       ->where('event_jobid',   '=', $event_jobid)
                       ->get(['id', 'title', 'start', 'end']);
             return response()->json($data);
        }

        $departmentData['data'] = DB::select('select DISTINCT menu_plant from order_menu where menu_meal=? and menu_type=?',['午餐','公司']);
        return view('fullcalender',['menu_type' => '公司','menu_meal' => '午餐','departmentData' => $departmentData]);
    }

    public function Pay_lunch(Request $request)
    {
        $event_jobid =Auth::user()->jobid;
        if($request->ajax()) {
             $data = Event::whereDate('start', '=', $request->start)
                       ->where('event_jobid',   '=', $event_jobid)
                       ->get(['id', 'title', 'start', 'end']);
             return response()->json($data);
        }

        $departmentData['data'] = DB::select('select DISTINCT menu_plant from order_menu where menu_meal=? and menu_type=?',['午餐','自付']);
        return view('pay_lunch',['menu_type' => '自付','menu_meal' => '午餐','departmentData' => $departmentData]);
    }

    public function Company_dinner(Request $request)
    {
        $getDate= date("Y-m-d");
        $event_jobid =Auth::user()->jobid;
        if($request->ajax()) {
             $data = Event::whereDate('start', '>=',$getDate)
                       ->where('event_jobid',   '=', $event_jobid)
                       ->get(['id', 'title', 'start', 'end']);

             return response()->json($data);
        }

        $departmentData['data'] = DB::select('select DISTINCT menu_plant from order_menu where menu_meal=? and menu_type=?',['晚餐','公司']);
        return view('fullcalender',['menu_type' => '公司','menu_meal' => '晚餐','departmentData' => $departmentData]);
    } 

    public function Pay_dinner(Request $request)
    {
        $getDate= date("Y-m-d");
        $event_jobid =Auth::user()->jobid;
        if($request->ajax()) {
             $data = Event::whereDate('start', '>=',$getDate)
                       ->where('event_jobid',   '=', $event_jobid)
                       ->get(['id', 'title', 'start', 'end']);

             return response()->json($data);
        }

        $departmentData['data'] = DB::select('select DISTINCT menu_plant from order_menu where menu_meal=? and menu_type=?',['晚餐','自付']);
        return view('fullcalender',['menu_type' => '自付','menu_meal' => '晚餐','departmentData' => $departmentData]);
    } 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {

        switch ($request->type) {
           case 'add':
             $add = Event::whereDate('start', '=', $request->start)
                       ->where('event_plant',   '=', $request->event_plant)
                       ->where('event_meal',   '=', $request->event_meal)
                       ->where('event_jobid',   '=', $request->event_jobid)
                       ->get(['id']);

              if ($add->isEmpty()){
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->start,
                    'event_plant' => $request->event_plant,
                    'event_meal' => $request->event_meal,
                    'event_item' => $request->event_item,
                    'event_jobid' => $request->event_jobid,
                    'event_type' => $request->event_type,
                    'event_count' => $request->event_count,
                ]);
                return response()->json($event);
                break;
              }else
              {

              }

  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }

    public function Company_lunch_day(Request $request)
    {

        $getDate= date("Y-m-d");
        $events = DB::select('select * from Events where start=? and event_type=? and event_meal=?',[$getDate,'公司','午餐']);

        $sql = "select event_plant,event_meal,event_item,
        sum(event_count) as sum
        from Events
        where start ='$getDate'and event_type='公司' and event_meal='午餐'
        group by event_plant,event_meal,event_item ";
        $item_sums = DB::select($sql);
        
        $sql = "select event_plant,event_meal,
        sum(event_count) as sum
        from Events
        where start ='$getDate' and event_type='公司' and event_meal='午餐'
        group by event_plant,event_meal ";
        $meal_sums = DB::select($sql);

        return view('Company_lunch_day',['events' => $events,'item_sums' => $item_sums,'meal_sums' => $meal_sums]);
    }

    public function Company_dinner_day(Request $request)
    {

        $getDate= date("Y-m-d");
        $events = DB::select('select * from Events where start=? and event_type=? and event_meal=?',[$getDate,'公司','晚餐']);

        $sql = "select event_plant,event_meal,event_item,
        sum(event_count) as sum
        from Events
        where start ='$getDate'and event_type='公司' and event_meal='晚餐'
        group by event_plant,event_meal,event_item ";
        $item_sums = DB::select($sql);
        
        $sql = "select event_plant,event_meal,
        sum(event_count) as sum
        from Events
        where start ='$getDate' and event_type='公司' and event_meal='晚餐'
        group by event_plant,event_meal ";
        $meal_sums = DB::select($sql);

        return view('Company_lunch_day',['events' => $events,'item_sums' => $item_sums,'meal_sums' => $meal_sums]);
    }

    public function Pay_lunch_day(Request $request)
    {

        $getDate= date("Y-m-d");
        $events = DB::select('select * from Events where start=? and event_type=? and event_meal=?',[$getDate,'自付','午餐']);

        $sql = "select event_jobid,event_plant,event_meal,event_item,menu_restaurant,menu_item,menu_money,event_count
        from Events,order_menu
        where start ='$getDate' and event_type='自付' and event_meal='午餐'
        and Events.event_item=order_menu.id
        ";
        $events = DB::select($sql);

        $sql = "select event_plant,event_meal,event_item,menu_restaurant,menu_item,menu_money,
        sum(event_count) as sum
        from Events,order_menu
        where start ='$getDate' and event_type='自付' and event_meal='午餐'
        and Events.event_item=order_menu.id
        group by event_plant,event_meal,event_item,menu_restaurant,menu_item,menu_money
        ";
        $item_sums = DB::select($sql);
        
        $sql = "select event_plant,event_meal,
        sum(event_count) as sum,sum(event_count*menu_money) as sum_money
        from Events,order_menu
        where start ='$getDate' and event_type='自付' and event_meal='午餐'
        and Events.event_item=order_menu.id
        group by event_plant,event_meal
        ";
        $meal_sums = DB::select($sql);

        return view('Pay_lunch_day',['events' => $events,'item_sums' => $item_sums,'meal_sums' => $meal_sums]);
    }

    public function Pay_dinner_day(Request $request)
    {

        $getDate= date("Y-m-d");
        $events = DB::select('select * from Events where start=? and event_type=? and event_meal=?',[$getDate,'自付','晚餐']);

        $sql = "select event_jobid,event_plant,event_meal,event_item,menu_restaurant,menu_item,menu_money,event_count
        from Events,order_menu
        where start ='$getDate' and event_type='自付' and event_meal='晚餐'
        and Events.event_item=order_menu.id
        ";
        $events = DB::select($sql);

        $sql = "select event_plant,event_meal,event_item,menu_restaurant,menu_item,menu_money,
        sum(event_count) as sum
        from Events,order_menu
        where start ='$getDate' and event_type='自付' and event_meal='晚餐'
        and Events.event_item=order_menu.id
        group by event_plant,event_meal,event_item,menu_restaurant,menu_item,menu_money
        ";
        $item_sums = DB::select($sql);
        
        $sql = "select event_plant,event_meal,
        sum(event_count) as sum,sum(event_count*menu_money) as sum_money
        from Events,order_menu
        where start ='$getDate' and event_type='自付' and event_meal='晚餐'
        and Events.event_item=order_menu.id
        group by event_plant,event_meal
        ";
        $meal_sums = DB::select($sql);

        return view('Pay_lunch_day',['events' => $events,'item_sums' => $item_sums,'meal_sums' => $meal_sums]);
    }    
}