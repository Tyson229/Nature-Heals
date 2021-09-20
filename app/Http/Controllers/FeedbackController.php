<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\toolsFeedback as ToolFeedbackModel;

class FeedbackController extends Controller
{
    /**
     * get listing of resoruce
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $feedbacks = ToolFeedbackModel::with('tool')->orderBy('id', 'DESC')->paginate(10);
        return view('AdminSide.feedback', compact('feedbacks'));
    }

    /**
     * delete feedbacks from storage
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = ToolFeedbackModel::where('id', $id)->first();
        
        $feedback->delete();
        
        return back()->with('message', 'Feedback has been deleted successfully.');
    }
}