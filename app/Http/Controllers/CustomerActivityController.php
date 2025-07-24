<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerActivityController extends Controller
{
    public function index(){
         return view('customer.customer-activity');
    }
}
