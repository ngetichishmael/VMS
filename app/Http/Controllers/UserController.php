<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Brian2694\Toastr\Facades\Toastr;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.user.layout');
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
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
            'phone_number'=> 'required|numeric',
            'organization_id' => 'required',
            'role_id' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
     
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number  = $request->input('phone_number');
        $user->organization_id  = $request->input('organization_id');
        $user->role_id  = $request->input('role_id'); 
        $user->password  = Hash::make($request->password);
        $user->save();
        
        return redirect()->to('/organization/users');
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
        $data = DB::table('users')->where('id',$id)->get();
        return view('livewire.user.edit',compact('data'));

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    public function destroy($id)
    {
        // DB::destroy($id);
        // return redirect()->route('livewire.user.dashboard');

        // $user->delete();
        // return redirect()->route('OrganizationUsers')->with('success','User has been deleted successfully');

        $delete = user::find($id);
        $delete->delete();
        Toastr::success('Data deleted successfully :)','Success');
        return redirect()->route('OrganizationUsers');
    }

    public function status_update($id){

        //get user status with the help of  ID
        $users = DB::table('users')
                    ->select('status')
                    ->where('id','=',$id)
                    ->first();

        //Check user status
        if($users->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        //update user status
        $values = array('status' => $status );
        DB::table('users')->where('id',$id)->update($values);

        session()->flash('msg','User status has been updated successfully.');
        return redirect()->route('OrganizationUsers');
    }



    public function search(Request $request){
        
        $output = "";

        $users=DB::table('users')->where('name','LIKE','%'.$request->search."%")

        ->orWhere('email','LIKE','%'.$request->search."%")


        ->orWhere('phone_number','LIKE','%'.$request->search."%")


        ->get();
        
        foreach($users as $users)
        {
            $output.= 
            '
            <tr>
            <td>'.$users ->id.'</td>
            <td>'.$users->name.'</td>

            <td>'.$users ->email.'</td>
            <td>'.$users ->phone_number.'</td>
         
            <td>'.$users ->phone_number.'</td>
    
            <td>'.$users ->phone_number.'</td>
        
       
            </tr>
            ';
        }

        return response($output);
     
    }



}
