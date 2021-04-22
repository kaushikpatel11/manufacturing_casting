<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Banner;
use App\Product;
use App\Content;
use App\User;

class ClientController extends Controller
{
    public function clientpanel(Request $request)
    {                          

        return view('client.home');
    }

    public function detail(Request $request)
    {                          

        return view('client.detail');
    }
   public function contact(Request $request)
    {                          

        return view('client.contact');
    }
}
