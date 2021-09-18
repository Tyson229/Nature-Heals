<?php

namespace App\Http\Controllers;

use Exception;     
use App\Mail\ContactMail;          
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;        

class ContactController extends Controller
{
    /**
     * send information in contact us page through email
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function sendContactUs(Request $request)
    {
     
            $toAddress = config('app.receive_contact_form_email');   

            $name = $request->name; 
            $email = $request->email;
            $category = $request->category;
            $contactMessage = $request->contact_message;
            
            Mail::to($toAddress)->send(new ContactMail($name, $email, $category, $contactMessage));

            $request->session()->flash('status', ['status_type' => 'success', 'message' => 'Your query has been submitted successfully.']);
            return redirect()->route('contact.index');
    
    
    }
}
