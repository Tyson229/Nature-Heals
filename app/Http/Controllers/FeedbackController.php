<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\toolsFeedback as ToolFeedbackModel;
use App\Models\request as tool_request;

class FeedbackController extends Controller
{
<<<<<<< HEAD
  
    public function index(Request $request)
    {
        $feedbacks = ToolFeedbackModel::with('tool')->orderBy('id', 'DESC')->paginate(7);
        return view('AdminSide.feedback', compact('feedbacks'));
    }


=======
   
    public function index(Request $request)
    {
        $requests = tool_request::get();        
        $request_number = count($requests);   
        $feedbacks = ToolFeedbackModel::with('tool')->orderBy('id', 'DESC')->paginate(7);
        return view('AdminSide.feedback', compact('feedbacks'))->with('request_number',$request_number);
    }

    
>>>>>>> origin/TysonBranch
    public function destroy($id)
    {
        $feedback = ToolFeedbackModel::where('id', $id)->first();
        
        $feedback->delete();
        
        return back()->with('message', 'Feedback has been deleted successfully.');
    }
}