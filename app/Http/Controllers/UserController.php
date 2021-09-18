<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role_ID==2)
            return back();

        $users = DB::table('users')
                    ->join('roles','role_ID','=','roles.id')
                    ->select('users.id','fname', 'lname' ,'email','password','roles.role_name')
                    ->where([
                        [ function ($query) use ($request){
                            if(($term = $request->term)){
                                $query->orWhere('fname','LIKE','%' . $term . '%')
                                      ->orWhere('lname','LIKE','%' . $term . '%')
                                      ->orWhere('email','LIKE','%' . $term . '%');
                            }
                        }]
                    ])
                    ->orderBy('roles.role_name','desc')
                    ->orderBy('users.id','desc')
                    
                    ->paginate(7); 


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
        $validator = Validator::make($request->all(),[
            'fname' => 'alpha',
            'lname' => 'alpha',
            'email' => 'email:rfc|unique:users|required',
        ],[
            'fname.required' => 'First Name is required',
            'lname.required' => 'Last Name is required',
            'fname.alpha' => 'First Name must be alphabetic only',
            'lname.alpha' => 'Last Name must be alphabetic only',
            'email.email' => 'Email is invalid',
            'email.required' => 'Email is required',
            'email.unique' => 'Email has already been taken'
        ]);

        if($validator->fails()){
            return redirect('login/user')->withErrors($validator,'store')->withInput();
        }


        $user = new User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_ID = $request->roles;

        $user->save();

        return redirect('/login/user')->with('message', 'Successfully Created User!');
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
        $validator = Validator::make($request->all(),[
            'fname' => 'alpha',
            'lname' => 'alpha',
            'email' => ['email:rfc',
                        Rule::unique('users')->ignore($id),
                        'required'],
        ],[
            'fname.required' => 'First Name is required',
            'lname.required' => 'Last Name is required',
            'fname.alpha' => 'First Name must be alphabetic only',
            'lname.alpha' => 'Last Name must be alphabetic only',
            'email.email' => 'Email is invalid',
            'email.required' => 'Email is required',
            'email.unique' => 'Email has already been taken'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator,'update')->with('id',$id);
        }

        $user = User::find($id);
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->role_ID = $request->input('roles');
        $user->updated_at = now();

        $user->save();
        //return redirect('login/user')->with('message', 'Successfully Updated User!');
        return back()->with('message', 'Successfully Updated User!');

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
        return redirect('login/user')->with('message', 'Successfully Deleted User!');
    }
}
