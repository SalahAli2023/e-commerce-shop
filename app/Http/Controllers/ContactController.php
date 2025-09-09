<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        //validation
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10|max:500'
        ]);

        // if we want send email
        // Mail::send(...);
        
        return redirect()->back()
                        ->with('success', 'Your message has been sent successfully!');
    }
}
