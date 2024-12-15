<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\TestMail;


class ContactController extends Controller
{
    public function index()
    {
        Mail::to('a@a.com')->send(new TestMail);
        dd('success');
    }
}
