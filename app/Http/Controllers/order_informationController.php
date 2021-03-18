<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\order_information;
use Validator;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Input;
class order_informationController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function api()
    {    
      return view('/inf_api');       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_informations = order_information::where('inf_type', '=', '公司')->latest()->paginate(100);  //每頁為6
        
        $response = [
          'pagination' => [
            'total' => $order_informations->total(),
            'per_page' => $order_informations->perPage(),
            'current_page' => $order_informations->currentPage(),
            'last_page' => $order_informations->lastPage(),
            'from' => $order_informations->firstItem(),
            'to' => $order_informations->lastItem()
          ],
          'data' => $order_informations
        ];
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'inf_type' => 'required',
          'inf_plant' => 'required',
          'inf_meal' => 'required',
          'inf_time' => 'required',
          'inf_1' => 'required',
          'inf_2' => 'required',
          'inf_3' => 'required',
          'inf_4' => 'required',
          'inf_5' => 'required',
       ]);
     
        $create = order_information::create($request->all());
        return response()->json($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'inf_type' => 'required',
        'inf_plant' => 'required',
        'inf_meal' => 'required',
        'inf_time' => 'required',
        'inf_1' => 'required',
        'inf_2' => 'required',
        'inf_3' => 'required',
        'inf_4' => 'required',
        'inf_5' => 'required',
      ]);
      $edit = order_information::find($id)->update($request->all());
      return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        order_information::find($id)->delete();
        return response()->json(['done']);
    }
}
