<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\Models\IdentificationType;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;


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
        $this->validate(request(), [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'org' => 'required',
            'password' => 'required'
            
        ]);
        
       
        $user = new User;
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->org = $request->org;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        
        
        // $user = User::create([
        //     'name' => $request->name,
        //     'phone_number' => $request->phone_number,
        //     'org' => $request->org,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        
     
        
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
        return view('livewire.user.dashboard',compact('data'));

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

        ->orWhere('username','LIKE','%'.$request->search."%")

        ->orWhere('phone_number','LIKE','%'.$request->search."%")

        ->join('organizations', 'users.org', '=', 'organizations.id')
      
        ->select('users.*', 'organizations.org_name')
       
        ->get();
        
        foreach($users as $users)
        {
            $output.= 
            '
            <tr>
            <td>'.$users ->id.'</td>
            <td>'.$users->name.'</td>
            <td>'.$users ->username.'</td>
            <td>'.$users ->email.'</td>
            <td>'.$users ->phone_number.'</td>
            <td>'.$users ->org_name.'</td>

            <td>'.$users ->phone_number.'</td>
    
            <td>'.$users ->phone_number.'</td>
            <td>'.$users ->org.'</td>
            td> '.'
                <a href="" class=""style="padding-right:20px">'.' <i class="fas fa-pen-nib"></i> </a>

            '.' </td>
            </tr>
            ';
        }

        return response($output);
     
    }



}
