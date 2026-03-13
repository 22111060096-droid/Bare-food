<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('membership.index', [
            'user' => $user,
        ]);
    }
}

