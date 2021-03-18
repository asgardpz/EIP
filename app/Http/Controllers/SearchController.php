<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;


class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
   public function index()
    {
        return view('search',['event_type' => '公司']);
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
        $output="";
        //$products=DB::table('events')->where('event_jobid','LIKE','%'.$request->search.'%')->whereDate('start', '=', $request->dateFrom)->get();

        if ($request->search=="*") 
        {
            $sql = "select DATE_FORMAT(start, '%Y-%m-%d') as start,event_jobid,event_plant,event_meal,event_type,event_item,event_count
            from Events
            where  event_type='公司' and start='".$request->dateFrom."' ";
            $products = DB::select($sql);
        }
        else
        {
            $sql = "select DATE_FORMAT(start, '%Y-%m-%d') as start,event_jobid,event_plant,event_meal,event_type,event_item,event_count
            from Events
            where event_type='公司' and event_jobid = '".$request->search."' and start='".$request->dateFrom."' ";
            $products = DB::select($sql);
        }

        if($products)
        {
            foreach ($products as $key => $product) {
            $output.='<tr>'.
            '<td>'.$product->start.'</td>'.
            '<td>'.$product->event_jobid.'</td>'.
            '<td>'.$product->event_plant.'</td>'.
            '<td>'.$product->event_meal.'</td>'.
            '<td>'.$product->event_type.'</td>'.
            '<td>'.$product->event_item.'</td>'.
            '<td>'.$product->event_count.'</td>'.
            '</tr>';
        }
        return Response($output);
        }
        }
    }

    public function index_month()
    {
        return view('search_month');
    }

    public function search_month(Request $request)
    {
        if($request->ajax())
        {
        $output="";
        //$products=DB::table('events')->where('event_jobid','LIKE','%'.$request->search.'%')->whereDate('start', '=', $request->dateFrom)->get();

        if ($request->search=="*") 
        {
            $sql = "select DATE_FORMAT(start, '%Y-%m') as start,event_jobid,event_plant,event_meal,event_type,event_item,sum(event_count) as event_count
            from Events
            where event_type='公司' and  DATE_FORMAT(start, '%Y-%m') = '".$request->dateFrom."' 
            group by DATE_FORMAT(start, '%Y-%m'),event_jobid,event_plant,event_meal,event_type,event_item ";
            $products = DB::select($sql);
        }
        else
        {
            $sql = "select DATE_FORMAT(start, '%Y-%m') as start,event_jobid,event_plant,event_meal,event_type,event_item,sum(event_count) as event_count
            from Events
            where event_type='公司' and DATE_FORMAT(start, '%Y-%m') = '".$request->dateFrom."' and event_jobid = '".$request->search."' 
            group by DATE_FORMAT(start, '%Y-%m'),event_jobid,event_plant,event_meal,event_type,event_item ";
            $products = DB::select($sql);
        }
        if($products)
        {
            foreach ($products as $key => $product) {
            $output.='<tr>'.
            '<td>'.$product->start.'</td>'.
            '<td>'.$product->event_jobid.'</td>'.
            '<td>'.$product->event_plant.'</td>'.
            '<td>'.$product->event_meal.'</td>'.
            '<td>'.$product->event_type.'</td>'.
            '<td>'.$product->event_item.'</td>'.
            '<td>'.$product->event_count.'</td>'.
            '</tr>';
            }
        return Response($output);
        }
        }
    } 
    
    public function search2(Request $request)
    {
        if($request->ajax())
        {
        $output="";
        //$products=DB::table('events')->where('event_jobid','LIKE','%'.$request->search.'%')->whereDate('start', '=', $request->dateFrom)->get();

        if ($request->search=="*") 
        {
            $sql = "select DATE_FORMAT(start, '%Y-%m-%d') as start,event_jobid,event_plant,event_meal,event_type,event_item,event_count
            from Events
            where  event_type='公司' and DATE_FORMAT(start, '%Y-%m')='".$request->dateFrom."' ";
            $products = DB::select($sql);
        }
        else
        {
            $sql = "select DATE_FORMAT(start, '%Y-%m-%d') as start,event_jobid,event_plant,event_meal,event_type,event_item,event_count
            from Events
            where event_type='公司' and event_jobid = '".$request->search."' and start='".$request->dateFrom."' ";
            $products = DB::select($sql);
        }
        if($products)
        {
            foreach ($products as $key => $product) {
            $output.='<tr>'.
            '<td>'.$product->start.'</td>'.
            '<td>'.$product->event_jobid.'</td>'.
            '<td>'.$product->event_plant.'</td>'.
            '<td>'.$product->event_meal.'</td>'.
            '<td>'.$product->event_type.'</td>'.
            '<td>'.$product->event_item.'</td>'.
            '<td>'.$product->event_count.'</td>'.
            '</tr>';
            }
        return Response($output);
        }
        }
    }

}
