<?php

namespace App\Http\Controllers;

use Exception;      //inbuilt php class if any exception occurs
use App\Mail\ContactMail;          //mail class which has been created
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;        //inbuild Mail facade from which we send the email

class ContactController extends Controller
{
    /**
     * send information in contact us page through email
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function sendContactUs(Request $request)
    {
        try{
            $toAddress = config('app.receive_contact_form_email');   //fetch email address to which the email must be sent. Address in config/app.php

            $name = $request->name; 
            $email = $request->email;
            $category = $request->category;
            $contactMessage = $request->contact_message;

            /*$this->validate($request, [
                'name' => 'required',
                'contact_message' => 'required',                        
            ]);*/

            //initiate mail sending procedure
            Mail::to($toAddress)->send(new ContactMail($name, $email, $category, $contactMessage));

            @if $request->session()->flash('status', ['status_type' => 'success', 'message' => 'Thank you for your message, it has been send successfully.']);
            return redirect()->route('contact.index');
            @endif
        }
        /*catch(Exception $e) 
        {
            $request->session()->flash('status', ['status_type' => 'danger', 'message' => 'Name and Message is required']);
            return redirect()->route('contact.index');*/
        } 
    }
}
