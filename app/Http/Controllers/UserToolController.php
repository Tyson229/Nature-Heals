<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\tools as ToolModel;
use App\Models\toolStatus as ToolStatusModel;

class UserToolController extends Controller
{
    /**
     * get listing of published tools
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function tools()
    {
        $publishedStatus = ToolStatusModel::where('status', 'Published')->first();

        $tools = ToolModel::where('status_ID', $publishedStatus->id)->paginate(10);

        return view('UserSide.tools', compact('tools'));
    }

    /**
     * get detailed description of tool
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function detailed($id)
    {
        $tool = ToolModel::with('linkLists')->findOrFail($id);
        return view('UserSide.detailed', compact('tool'));
    }

    
}
