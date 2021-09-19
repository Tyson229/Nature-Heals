<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\tools;
use App\Models\request as tool_request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\linkList;
use App\Models\userCreatesTool;
use SebastianBergmann\Environment\Console;

use function PHPUnit\Framework\isNull;

class AdminRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user() && Auth::user()->role_ID == 1){
            $tools = DB::table('tools')
                    ->join('requests','requests.tool_ID','=','tools.id')
                    ->where([
                        [ function ($query) use ($request){
                            if(($term = $request->term)){
                                $query->orWhere('tools.tool_name','LIKE','%'.$term.'%' )
                                    ->orWhere('tools.health_domain','=',$term )
                                    ->orWhere('requests.visitor_name','LIKE','%'.$term.'%' );
                            }
                        }]
                    ])
                    ->orderBy('tools.created_at','desc')
                    ->paginate(7);

            $link = DB::table('tools')
                    ->join('link_lists','link_lists.tool_ID','=','tools.id')
                    -> select('tools.id','link_lists.study_name','link_lists.link')
                    ->get();

            return view('AdminSide.pendingRequest')->with('tools', $tools)->with('link_lists',$link);
        }
        else
            return back();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
