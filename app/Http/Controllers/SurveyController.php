<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\School;
use App\Models\SurveyFood;
use App\Models\SurveyAllergy;

class SurveyController extends Controller
{
    public function showSurveyMakanan()
    {
        $schools = School::select('name')->get();
        return view('SurveyMakanan', compact('schools'));
    }
    

        public function showSurveyAlergi()
    {
        $schools = School::select('name')->get();
        return view('SurveyAlergi', compact('schools'));
    }
}