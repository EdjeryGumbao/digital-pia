<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PrivacyImpactAssessmentVersion;
use App\Models\PrivacyImpactAssessment;
use App\Models\Process;
use App\Models\DataFields;
use App\Models\RiskManagement;
use App\Models\DataFlow;

use Illuminate\Support\Facades\Session;

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







    public function InsertPrivacyImpactAssessmentVersion(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'IsActive' => 'required|boolean',
        ]);

        // Create a new PrivacyImpactAssessmentVersion instance
        $privacyImpactAssessmentVersion = new PrivacyImpactAssessmentVersion;
        $privacyImpactAssessmentVersion->IsActive = $validatedData['IsActive'];
        $privacyImpactAssessmentVersion->save();

        return;
    }

    public function create_pia_version_one()
    {
        // Create a new PrivacyImpactAssessmentVersion instance
        $privacyImpactAssessmentVersion = new PrivacyImpactAssessmentVersion;
        $privacyImpactAssessmentVersion->IsActive = true; // Set the value for IsActive as needed
        $privacyImpactAssessmentVersion->save();
        return;
    }
    

    public function InsertPrivacyImpactAssessment(Request $request)
    {
        $PrivacyImpactAssessmentVersionID = session('PrivacyImpactAssessmentVersionID');
        $UserID = session('UserID');
    
        if (session()->has('PrivacyImpactAssessmentID')) { // user returned to edit the title
            $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', session('PrivacyImpactAssessmentID'))->first();
            
            // Validate the request data
            request()->validate([
                'Name' => 'required|string',
            ]);

            // Update the existing Process instance with new values
            $PrivacyImpactAssessment->update([
                'Name' => $request->get('Name'),
            ]);
        } else { // user just started
            // Validate the request data
            request()->validate([
                'Name' => 'required|string',
            ]);

            // Create a new PrivacyImpactAssessment instance
            $PrivacyImpactAssessment = new PrivacyImpactAssessment([
                'UserID' => $UserID,
                'PrivacyImpactAssessmentVersionID' => $PrivacyImpactAssessmentVersionID,
                'Name' => request('Name'),
            ]);
            $PrivacyImpactAssessment->save();

        }    

        session()->put('PrivacyImpactAssessmentID', $PrivacyImpactAssessment->PrivacyImpactAssessmentID);

        return $this->proceed_to_process($request);
    }
    

    public function InsertProcess(Request $request)
    {
        if (isset($request->Submit)) {

            $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
            $result = Process::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
    
            if ($result) {
                // Data exists, update the data
    
                // Validate the request data
                $request->validate([
                    'ProcessName' => 'nullable|string',
                    'DataSubject' => 'nullable|string',
                    'DataFieldsID' => 'nullable|integer',
                    'PurposeforProcessing' => 'nullable|string',
                    'SecurityMeasure' => 'nullable|string',
                    'ProcessNarrative' => 'nullable|string',
                    'SectionA' => 'nullable|array',
                    'SectionB' => 'nullable|array',
                    'SectionC' => 'nullable|array',
                    'SectionD' => 'nullable|array',
                ]);
    
                // Update the existing Process instance with new values
                $result->update([
                    'ProcessName' => $request->get('ProcessName'),
                    'DataSubject' => $request->get('DataSubject'),
                    'DataFieldsID' => $request->get('DataFieldsID'),
                    'PurposeforProcessing' => $request->get('PurposeforProcessing'),
                    'SecurityMeasure' => $request->get('SecurityMeasure'),
                    'ProcessNarrative' => $request->get('ProcessNarrative'),
                    'SectionA' => $request->input('SectionA'),
                    'SectionB' => $request->input('SectionB'),
                    'SectionC' => $request->input('SectionC'),
                    'SectionD' => $request->input('SectionD'),
                ]);
            } else {
                // Data doesn't exist, create a new Process instance
    
                // Validate the request data
                $request->validate([
                    'ProcessName' => 'nullable|string',
                    'DataSubject' => 'nullable|string',
                    'DataFieldsID' => 'nullable|integer',
                    'PurposeforProcessing' => 'nullable|string',
                    'SecurityMeasure' => 'nullable|string',
                    'ProcessNarrative' => 'nullable|string',
                    'SectionA' => 'nullable|array',
                    'SectionB' => 'nullable|array',
                    'SectionC' => 'nullable|array',
                    'SectionD' => 'nullable|array',
                ]);
    
                // Create a new Process instance
                $Process = new Process([
                    'PrivacyImpactAssessmentID' => $PrivacyImpactAssessmentID,
                    'ProcessName' => $request->get('ProcessName'),
                    'DataSubject' => $request->get('DataSubject'),
                    'DataFieldsID' => $request->get('DataFieldsID'),
                    'PurposeforProcessing' => $request->get('PurposeforProcessing'),
                    'SecurityMeasure' => $request->get('SecurityMeasure'),
                    'ProcessNarrative' => $request->get('ProcessNarrative'),
                    'SectionA' => $request->input('SectionA'),
                    'SectionB' => $request->input('SectionB'),
                    'SectionC' => $request->input('SectionC'),
                    'SectionD' => $request->input('SectionD'),
                ]);
    
                // Set values for other attributes
                $Process->save();
            }
    
            // Redirect to a specific route or URL
            return $this->proceed_to_risk_assessment();
        }

        if (isset($request->Datacollected) || isset($request->FormUsed)) {
            $this->InsertDataFields($request);
        }


        return $this->proceed_to_process($request);
    }


    public function InsertDataFields(Request $request)
    {
        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');

        // Validate the request data
        $request->validate([
            'FormUsed' => 'nullable|string',
            'Datacollected' => 'nullable|array',
        ]);

        // Create a new DataFields instance
        $DataFields = new DataFields([
            'PrivacyImpactAssessmentID' => $PrivacyImpactAssessmentID,
            'FormUsed' => $request->get('FormUsed'),
            'Datacollected' => $request->input('Datacollected'),
        ]);
        // Set values for other attributes
        
        //dd($DataFields);
        $DataFields->save();

        // Redirect or return a response as needed
        return $this->proceed_to_process($request);
    }

    public function InsertRiskManagement(Request $request)
    {
        // Validate the request data
        $request->validate([
            'ThreatsVulnerabilities' => 'required|string',
            'Impact' => 'required|integer',
            'Probability' => 'required|integer',
        ]);

        $riskRating = $request->get('Impact') * $request->get('Probability');
        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');

        $RiskManagement = new RiskManagement([
            'PrivacyImpactAssessmentID' => $PrivacyImpactAssessmentID,
            'ThreatsVulnerabilities' => $request->get('ThreatsVulnerabilities'),
            'Impact' => $request->get('Impact'),
            'Probability' => $request->get('Probability'),
            'RiskRating' => $riskRating,
        ]);
        $RiskManagement->save();

        return $this->proceed_to_risk_assessment();
    }

    public function InsertDataFlow(Request $request)
    {

        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        $result = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();


        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['FileName'] = "$postImage";
            $input['PrivacyImpactAssessmentID'] = $PrivacyImpactAssessmentID;
        }
  
        DataFlow::create($input);
   
        /*


        // Validate the request data
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // get name and store image
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/dataflowimages');

        // upload to database
        $DataFlow = new DataFlow([
            'PrivacyImpactAssessmentID' => $PrivacyImpactAssessmentID,
            'FileName' => $path,
        ]);

        //dd($DataFlow);
        $DataFlow->save();

        */

        return $this->proceed_to_flowchart();
    }

    public function proceed_to_start(Request $request)
    {        
        if(isset($request->PrivacyImpactAssessmentID)) {
            session()->put('PrivacyImpactAssessmentID', $request->PrivacyImpactAssessmentID);
        }

        if(PrivacyImpactAssessmentVersion::count() === 0){ // user just started their first PIA
            $this->create_pia_version_one();
        }

        if (session()->has('PrivacyImpactAssessmentID')) { // user returns back to start
            $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
            $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
            
            if ($PrivacyImpactAssessment) {
                // Data exists, pass the PrivacyImpactAssessment data to the view
                return view('pia2/proceed_to_start', ['PrivacyImpactAssessment' => $PrivacyImpactAssessment]);
            } else {
                // Data doesn't exist
                return view('pia2/proceed_to_start');
            }
        }
        
        $PrivacyImpactAssessmentVersion = PrivacyImpactAssessmentVersion::where('IsActive', true)->first();
        $request->session()->put('PrivacyImpactAssessmentVersionID', $PrivacyImpactAssessmentVersion->PrivacyImpactAssessmentVersionID);

        return view('pia2/proceed_to_start');
    }
    
    public function proceed_to_process(Request $request)
    {
        if(isset($request->PrivacyImpactAssessmentID)) {
            $request->session()->put('PrivacyImpactAssessmentID', $request->PrivacyImpactAssessmentID);
        }

        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        $Process = Process::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
        $DataFields = DataFields::all();
        
        //dd($Process);
        //dd($DataFields);

        if ($Process) {
            // Data exists, pass the process data to the view
            return view('pia2/proceed_to_process', ['Process' => $Process, 'DataFields' => $DataFields]);
        } else {
            // Data doesn't exist
            return view('pia2/proceed_to_process');
        }
    }
    
    
    public function proceed_to_risk_assessment()
    {   
        $RiskManagement = RiskManagement::all();
        
        if ($RiskManagement) {
            // Data exists, pass the data to the view
            return view('pia2/proceed_to_risk_assessment', ['RiskManagement' => $RiskManagement]);
        } else {
            // Data doesn't exist
            return view('pia2/proceed_to_risk_assessment');
        }
    }
    public function proceed_to_flowchart()
    {   
        $DataFlow = DataFlow::all();
        
        if ($DataFlow) {
            // Data exists, pass the data to the view
            return view('pia2/proceed_to_flowchart', ['DataFlow' => $DataFlow]);
        } else {
            // Data doesn't exist
            return view('pia2/proceed_to_flowchart');
        }
    }
    public function proceed_to_end(Request $request)
    {
        $keysToRemove = [
            'PrivacyImpactAssessmentVersionID',
            'PrivacyImpactAssessmentID',
        ];
        foreach ($keysToRemove as $key) {
            Session::forget($key);
        }
        return view('pia2/proceed_to_end');
    }
    public function reset()
    {
        $keysToRemove = [
            'PrivacyImpactAssessmentVersionID',
            'PrivacyImpactAssessmentID',
        ];
        foreach ($keysToRemove as $key) {
            Session::forget($key);
        }
        return view('dashboard');
    }

    public function index()
    {
        // Call the function you want to run
        $this->reset();

        // Return the dashboard view
        return view('dashboard');
    }

    public function pialist(Request $request)
    {
        $data = PrivacyImpactAssessment::all();

        return view('pialist', compact('data'));
    }

    public function edit_process(Request $request)
    {
        $request->validate([
            'PrivacyImpactAssessmentID' => 'required|integer',
        ]);
        $ID = $request->get('PrivacyImpactAssessmentID');
        $Process = Process::where('PrivacyImpactAssessmentID', $ID)->get();
        $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $ID)->first();
        session()->put('PrivacyImpactAssessmentID', $PrivacyImpactAssessment->PrivacyImpactAssessmentID);
        session()->put('PrivacyImpactAssessmentVersionID', $PrivacyImpactAssessment->PrivacyImpactAssessmentVersionID);

        return view('pia2/proceed_to_process', compact('Process'));
    }

    public function delete_riskmanagement(Request $request)
    {
        $RiskManagementID = $request->get('RiskManagementID');
        
        $RiskManagement = RiskManagement::where('RiskManagementID', $RiskManagementID)->first();

        if ($RiskManagement) {
            // Delete the Risk Management
            $RiskManagement->delete();
        }

        return $this->proceed_to_risk_assessment();
    }

    public function delete_dataflow(Request $request)
    {
        $DataFlowID = $request->get('DataFlowID');
        
        $DataFlow = DataFlow::where('DataFlowID', $DataFlowID)->first();

        if ($DataFlow) {
            // Delete the data flow
            $DataFlow->delete();
        }
        return $this->proceed_to_flowchart();
    }
}