<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index() {
        return view('employer.home');
    }

    public function profile() {
        return view('employer.profile');
    }
}
