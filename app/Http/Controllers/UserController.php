<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = DB::table('users')
                    ->join('roles','role_ID','=','roles.id')
                    ->select('users.id','fname', 'lname' ,'email','password','roles.role_name')
                    ->get();   
        return view('AdminSide.userManagement')
                    ->with('users', $users);         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate =$request->validate([
            'email' => 'bail|email:rfc|unique:users|required',
            'fname' => 'string',
            'lname' => 'string',

        ]);

        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $password = $request -> input('password');
        $role = $request->input('roles');

        $data = array('fname'=>$fname, 'lname'=>$lname, 'email'=>$email, 'password'=>$password, 'role_ID' => $role, 'created_at' => now(), 'updated_at' => now());

        DB::table('users')->insert($data);

        return redirect('/login/user');
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
        $validate =$request->validate([
            'email' => [
                'bail',
                'required',
                'email:rfc',
                Rule::unique('users')->ignore($id,'users.id')
            ],
            'fname' => 'string',
            'lname' => 'string',
        ]);

        $user = User::find($id);
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role_ID = $request->input('roles');
        $user->updated_at = now();

        $user->save();
        return redirect('login/user');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::find($id);
        $user->delete();
        return redirect('login/user');
    }
}
