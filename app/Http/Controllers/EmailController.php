<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;

class EmailController extends Controller
{
    public function index()
    {
        $testMailData = [
            'title' => 'Test Email From AllPHPTricks.com',
            'body' => 'This is the body of test email.'
        ];
        Mail::to('lalaina.nancia64@gmail.com')->send(new MyEmail($testMailData));
        dd('Success! Email has been sent successfully.');
    }
}
