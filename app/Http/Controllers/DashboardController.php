<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard() {
    $pageTitle = 'Dashboard';
    return view('dashboard', compact('pageTitle'));
    }
}
