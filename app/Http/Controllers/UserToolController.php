<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\tools as ToolModel;
use App\Models\toolStatus as ToolStatusModel;

class UserToolController extends Controller
{
    public function tools()
    {
        $publishedStatus = ToolStatusModel::where('status', 'Published')->first();

        $tools = ToolModel::where('status_ID', $publishedStatus->id)->paginate(10);

        return view('UserSide.tools', compact('tools'));
    }

    public function detailed($id)
    {
        $tool = ToolModel::with('linkLists')->findOrFail($id);
        return view('UserSide.detailed', compact('tool'));
    }

    public function search(Request $request)
    {
        $publishedStatus = ToolStatusModel::where('status', 'Published')->first();

        $tools = ToolModel::where('status_ID', $publishedStatus->id)
        ->when(isset($request->searched_keyword) && $request->searched_keyword != '', function($query) use($request){
            $query->where('tool_name', 'like' , '%' .$request->searched_keyword . '%')
            ->orWhere('tool_description', 'like' , '%' .$request->searched_keyword . '%');
        })
        ->when(isset($request->domains) && count($request->domains) > 0, function($query) use($request){
            $query->whereIn('health_domain', $request->domains);
        })
        ->when(isset($request->conditions) && count($request->conditions) > 0, function($query) use($request){
            $query->whereIn('health_condition', $request->conditions);
        })
        ->when(isset($request->modalities) && count($request->modalities) > 0, function($query) use($request){
            $query->whereIn('modality', $request->modalities);
        })
        ->when(isset($request->settings) && count($request->settings) > 0, function($query) use($request){
            $query->whereIn('settings', $request->settings);
        })
        ->when(isset($request->ageGroups) && count($request->ageGroups) > 0, function($query) use($request){
            $query->whereIn('age_group', $request->ageGroups);
        })
        ->paginate(10);

        $request->session()->flash('searched_keyword', $request->searched_keyword);
        $request->session()->flash('domains', $request->domains);
        $request->session()->flash('conditions', $request->conditions);
        $request->session()->flash('modalities', $request->modalities);
        $request->session()->flash('settings', $request->settings);
        $request->session()->flash('ageGroups', $request->ageGroups);
        
        return view('UserSide.tools', compact('tools'));
    }
    
}
