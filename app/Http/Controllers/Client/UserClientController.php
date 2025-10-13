<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserClientController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('client.users.profile', compact('user'));
    }
}