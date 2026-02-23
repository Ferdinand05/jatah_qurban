<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HouseholdRegistrationController extends Controller
{
    public function index(Request $request)
    {

        return view("household.index");
    }
}
