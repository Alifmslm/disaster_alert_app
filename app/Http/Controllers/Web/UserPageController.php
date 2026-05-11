<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SafetyGuide;
use App\Http\Resources\SafetyGuideResource;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function home()
    {
        return view('pages.user.home');
    }

    public function map()
    {
        return view('pages.user.map-evacuation');
    }

    public function report()
    {
        return view('pages.user.report-disaster');
    }

    public function safety()
    {
        
        $guides = SafetyGuide::all();

        
        return view('pages.user.safety-guide', [
            'guides' => SafetyGuideResource::collection($guides)
        ]);
    }

    public function profile()
    {
        return view('pages.user.profile');
    }
}