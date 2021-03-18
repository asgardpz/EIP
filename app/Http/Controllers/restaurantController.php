<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\restaurant;
use Validator;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class restaurantController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function api()
    {    
      return view('/rest_api');       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = restaurant::latest()->paginate(100);  //每頁為6
        
        $response = [
          'pagination' => [
            'total' => $restaurants->total(),
            'per_page' => $restaurants->perPage(),
            'current_page' => $restaurants->currentPage(),
            'last_page' => $restaurants->lastPage(),
            'from' => $restaurants->firstItem(),
            'to' => $restaurants->lastItem()
          ],
          'data' => $restaurants
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
          'restaurant_type' => 'required',
          'restaurant_plant' => 'required',
          'restaurant_meal' => 'required',
          'restaurant_name' => 'required',
       ]);
        $create = restaurant::create($request->all());
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
        'restaurant_type' => 'required',
        'restaurant_plant' => 'required',
        'restaurant_meal' => 'required',
        'restaurant_name' => 'required',
      ]);
      $edit = restaurant::find($id)->update($request->all());
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
        restaurant::find($id)->delete();
        return response()->json(['done']);
    }

    
}
