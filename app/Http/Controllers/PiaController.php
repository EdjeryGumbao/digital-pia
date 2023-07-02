<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PiaController extends Controller
{
    public function proceed_to_system_description()
    {
        return view('pia/system_description');
    }

    public function proceed_to_threshold_analysis(Request $request)
    {
        $value = $request->input('value');
    
        return view('pia/threshold_analysis', ['value' => $value]);
    }

    public function proceed_to_data_flows(Request $request)
    {
        $value = $request->input('value');
    
        return view('pia/data_flows', ['value' => $value]);
    }
    public function proceed_to_privacy_impact_analysis(Request $request)
    {
        $value = $request->input('value');
    
        return view('pia/privacy_impact_analysis', ['value' => $value]);
    }

    public function proceed_to_privacy_risk_management(Request $request)
    {
        $value = $request->input('value');
    
        return view('pia/privacy_risk_management', ['value' => $value]);
    }

    public function proceed_to_recommended_privacy_solutions(Request $request)
    {
        $value = $request->input('value');
    
        return view('pia/recommended_privacy_solutions', ['value' => $value]);
    }




    public function proceed_to_start()
    {
        return view('pia2/proceed_to_start');
    }
    
    public function proceed_to_process()
    {   
        return view('pia2/proceed_to_process');
    }
    public function proceed_to_risk_assessment()
    {   
        return view('pia2/proceed_to_risk_assessment');
    }
    public function proceed_to_flowchart()
    {   
        return view('pia2/proceed_to_flowchart');
    }
    public function proceed_to_end(Request $request)
    {
        return view('pia2/proceed_to_end');
    }
}
