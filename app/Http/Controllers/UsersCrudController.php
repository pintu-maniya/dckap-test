<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('crud.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get(["name","id"]);
        return view('crud.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'          => 'required|unique:users,email,'.$request->email,
            'address'       => 'required',
            'dob'           => 'required',
            'status'        => 'required',
            'education'     => 'required',
            'pincode'       => 'required',
            'profile_pic'   => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            'country'       => 'required',
            'city'          => 'required',
        ]);
        $fileName = time().'.'.$request->profile_pic->extension();

        $request->profile_pic->move(public_path('uploads'), $fileName);
        $request = $request->all();
        $request['profile_pic'] = $fileName;
        $request['password'] = Hash::make('123456789'); // static password
        User::create($request);

        return redirect()->route('users.index')
            ->with('success','Users created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('crud.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $countries = Country::get(["name","id"]);
        return view('crud.edit',compact('user','countries'));
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

        $request->validate([
            'name'          => 'required',
            'email'         => ['required',Rule::unique('users')->ignore($id),],
            'address'       => 'required',
            'dob'           => 'required',
            'status'        => 'required',
            'education'     => 'required',
            'pincode'       => 'required',
            'country'       => 'required',
            'city'          => 'required',
        ]);



        if($request->profile_pic){
            $request->validate([
                'profile_pic'   => 'mimes:jpg,jpeg,png,gif|max:2048',
            ]);
            $fileName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('uploads'), $fileName);
            $request = $request->all();
            $request['profile_pic'] = $fileName;
        }else{
            $request = $request->all();
            $request['profile_pic'] = $request['old_profile_pic'];
        }
        $user = User::find($id);

        $user->update($request);

        return redirect()->route('users.index')
            ->with('success','Users updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')
            ->with('success','Users deleted successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("country_id",$request->country_id)
            ->get(["name","id"]);
        return response()->json($data);
    }
}
