<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Models\Account;

class ProfileController extends Controller
{
    public function showProfil() {
        return view('Profil');
    }
}

