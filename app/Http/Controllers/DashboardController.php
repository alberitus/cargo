<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company; 

class DashboardController extends Controller
{
    public function index()
    {
        $totalCompanies = Company::count();
        notify()->success('Laravel Notify is awesome!');
        return view('index', compact('totalCompanies'));
    }
}
