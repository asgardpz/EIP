<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\user;
use Validator;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class pwController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function api()
    {    
      return view('/pw_api');       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::where('jobid', '<>', 'admin')->latest()->paginate(100);  //每頁為6
        
        $response = [
          'pagination' => [
            'total' => $users->total(),
            'per_page' => $users->perPage(),
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'from' => $users->firstItem(),
            'to' => $users->lastItem()
          ],
          'data' => $users
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
        'password' => 'required',
      ]);
      $password = DB::select('select password from users where id = ?', [$id]);
      $input = $request->all(); 
      if ($input['password']!= $password ) {
        $update = $request->only(['password']);
        $update['password'] = Hash::make($update['password']);
        $edit = user::find($id)->update($update);
      }  
      
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

    }
}
