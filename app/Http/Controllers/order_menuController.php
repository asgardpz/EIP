<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\order_menu;
use Validator;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Input;
class order_menuController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function api()
    {    
      return view('/menu_api');       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_menus = order_menu::latest()->paginate(100);  //每頁為6
        $response = [
          'pagination' => [
            'total' => $order_menus->total(),
            'per_page' => $order_menus->perPage(),
            'current_page' => $order_menus->currentPage(),
            'last_page' => $order_menus->lastPage(),
            'from' => $order_menus->firstItem(),
            'to' => $order_menus->lastItem()
          ],
          'data' => $order_menus
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
          'menu_type' => 'required',
          'menu_plant' => 'required',
          'menu_meal' => 'required',
          'menu_restaurant' => 'required',
          'menu_item' => 'required',
          'menu_money' => 'required',
       ]);
     
        $create = order_menu::create($request->all());
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
        'menu_type' => 'required',
        'menu_plant' => 'required',
        'menu_meal' => 'required',
        'menu_restaurant' => 'required',
        'menu_item' => 'required',
        'menu_money' => 'required',
      ]);
      $edit = order_menu::find($id)->update($request->all());
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
        order_menu::find($id)->delete();
        return response()->json(['done']);
    }
}
