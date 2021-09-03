<?php

namespace App\Http\Controllers;

use App\Mail\IngredientsWeeklyReport;
use App\Models\RegionalManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function send_mail(Request $request)
    {
        $regionalManager = RegionalManager::all();

        foreach($regionalManager as $manager) {
            Mail::to($manager->email)->send(new IngredientsWeeklyReport($manager));
        }
    }
}
