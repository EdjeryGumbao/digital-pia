<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\PrivacyImpactAssessment;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function show_data_on_dashboard()
    {
        $data = PrivacyImpactAssessment::all();
        return view('dashboard', compact('data'));
    }
}
