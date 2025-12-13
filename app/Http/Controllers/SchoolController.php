<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\School;

class SchoolController extends Controller
{
    public function showBeranda() {
        return view('Beranda');
    }

    public function showSekolah() {

        return view('Sekolah');
    }

    public function showDetailSekolah($id)
    {
        return view('DetailSekolah');
    }
}
