<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PrivacyImpactAssessmentVersion;
use App\Models\PrivacyImpactAssessment;
use App\Models\Process;
use App\Models\DataFields;
use App\Models\RiskAssessment;
use App\Models\DataFlow;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
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




    // dpo

    public function createAdminUser()
    {
        $adminData = [
            'lastname' => 'DPO',
            'firstname' => 'Admin',
            'middlename' => '',
            'completename' => 'DPO Admin',
            'email' => 'admin@example.com',
            'usertype' => 'admin',
            'contactnumber' => '1234567890',
            'password' => Hash::make('admin123'), // Replace 'password' with the desired password
        ];
    
        // Create the admin user
        $adminUser = User::create($adminData);
    
        if ($adminUser) {
            return 'Admin user created successfully.';
        } else {
            return 'Failed to create admin user.';
        }
    }

    // dept head parts

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
        $UserID = auth()->id();
    
        if (session()->has('PrivacyImpactAssessmentID')) { // user returned to edit the title
            $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', session('PrivacyImpactAssessmentID'))->first();
            
            // Validate the request data
            request()->validate([
                'ProcessName' => 'required|string',
            ]);

            // Update the existing Process instance with new values
            $PrivacyImpactAssessment->update([
                'ProcessName' => $request->get('ProcessName'),
            ]);
        } else { // user just started
            // Validate the request data
            request()->validate([
                'ProcessName' => 'required|string',
            ]);

            // Create a new PrivacyImpactAssessment instance
            $PrivacyImpactAssessment = new PrivacyImpactAssessment([
                'UserID' => $UserID,
                'PrivacyImpactAssessmentVersionID' => $PrivacyImpactAssessmentVersionID,
                'ProcessName' => request('ProcessName'),
            ]);
            $PrivacyImpactAssessment->save();

        }    

        session()->put('PrivacyImpactAssessmentID', $PrivacyImpactAssessment->PrivacyImpactAssessmentID);

        return $this->proceed_to_process($request);
    }
    




    public function InsertProcess(Request $request)
    {
        if ($request->has('delete_datafield')) {
            // Run the code for deleting the data field
        
            // Get the DataFieldsID from the request
            $DataFieldsID = $request->input('delete_datafield');
        
            // Find the data field based on the DataFieldsID
            $DataFields = DataFields::where('DataFieldsID', $DataFieldsID)->first();
        
            // Check if the data field exists
            if ($DataFields) {
                // Delete the data field
                $DataFields->delete();
            }
        }        

        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        $result = Process::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
        
        // Validate the request data
        $request->validate([
            'DataSubject' => 'nullable|string',
            'PurposeforProcessing' => 'nullable|string',
            'SecurityMeasure' => 'nullable|string',
            'ProcessNarrative' => 'nullable|string',
            'SectionA' => 'nullable|array',
            'SectionB' => 'nullable|array',
            'SectionC' => 'nullable|array',
            'SectionD' => 'nullable|array',
        ]);

        if ($result) {
            // Data exists, update the data

            // Update the existing Process instance with new values
            $result->update([
                'DataSubject' => $request->get('DataSubject'),
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

            // Create a new Process instance
            $Process = new Process([
                'PrivacyImpactAssessmentID' => $PrivacyImpactAssessmentID,
                'DataSubject' => $request->get('DataSubject'),
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

        if (isset($request->FormUsed) && isset($request->Datacollected)) {
            $this->InsertDataFields($request);
        }
        if ($request->Button == "Next") {
            return $this->proceed_to_risk_assessment();
        } elseif ($request->Button == "FormData") {
            return $this->proceed_to_process($request);
        } elseif ($request->Button == "Back") {
            return $this->proceed_to_start($request);
        } else {
            return $this->proceed_to_process($request);
        } 
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
        
        $DataFields->save();
        // Redirect or return a response as needed
        return;
    }

    public function InsertRiskAssessment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'ThreatsVulnerabilities' => 'required|string',
            'Impact' => 'required|integer',
            'Probability' => 'required|integer',
        ]);

        $riskRating = $request->get('Impact') * $request->get('Probability');
        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');

        $RiskAssessment = new RiskAssessment([
            'PrivacyImpactAssessmentID' => $PrivacyImpactAssessmentID,
            'ThreatsVulnerabilities' => $request->get('ThreatsVulnerabilities'),
            'Impact' => $request->get('Impact'),
            'Probability' => $request->get('Probability'),
            'RiskRating' => $riskRating,
        ]);
        $RiskAssessment->save();

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
        if(isset($request->PrivacyImpactAssessmentID)) { // edit
            $request->session()->put('PrivacyImpactAssessmentID', $request->PrivacyImpactAssessmentID);
        } 
        
        if(!Session::exists('PrivacyImpactAssessmentID')) { // when a user visits this page without an ID
            return $this->index();
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
        if(!Session::exists('PrivacyImpactAssessmentID')) { // when a user visits this page without an ID
            return $this->index();
        }
        
        $RiskAssessment = RiskAssessment::all();
        //dd($RiskAssessment);
        if ($RiskAssessment) {
            // Data exists, pass the data to the view
            return view('pia2/proceed_to_risk_assessment', ['RiskAssessment' => $RiskAssessment]);
        } else {
            // Data doesn't exist
            return view('pia2/proceed_to_risk_assessment');
        }
    }
    public function proceed_to_flowchart()
    {   
        if(!Session::exists('PrivacyImpactAssessmentID')) { // when a user visits this page without an ID
            return $this->index();
        }
        
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
        if(!Session::exists('PrivacyImpactAssessmentID')) { // when a user visits this page without an ID
            return $this->index();
        }

        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();

        if ($PrivacyImpactAssessment) {
            $PrivacyImpactAssessment->touch();
            $PrivacyImpactAssessment->save();
        }

        return $this->view_pia($request);
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
        $this->reset();
        $PrivacyImpactAssessment = PrivacyImpactAssessment::sortable()->paginate(10);
        $User = User::sortable()->paginate(10);
        $CurrentUser = auth()->user();
        
        return view('pialist', compact('PrivacyImpactAssessment', 'User', 'CurrentUser'));

    }

    public function manage(Request $request)
    {
        return view('manage');
    }



    public function test(Request $request)
    {
        //dd(Session::all());
        dd(auth()->user());
    }

    public function view_pia(Request $request)
    {
        if(!Session::exists('PrivacyImpactAssessmentID')){ // when a user visits this page without an ID
            $request->validate([
                'PrivacyImpactAssessmentID' => 'required|integer',
            ]);
            $PrivacyImpactAssessmentID = $request->get('PrivacyImpactAssessmentID');
        } else {
            $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        }

        $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();

        if ($PrivacyImpactAssessment) {
            session()->put('PrivacyImpactAssessmentID', $PrivacyImpactAssessment->PrivacyImpactAssessmentID);
            session()->put('PrivacyImpactAssessmentVersionID', $PrivacyImpactAssessment->PrivacyImpactAssessmentVersionID);
            $Process = Process::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
            $DataFields = DataFields::all();
            $RiskAssessment = RiskAssessment::all();
            $DataFlow = DataFlow::all();

            return view('viewpia', compact('Process', 'DataFields', 'RiskAssessment', 'DataFlow', 'PrivacyImpactAssessment'));
        }

        // Handle the case when PrivacyImpactAssessment is not found
        return redirect()->back()->with('error', 'Privacy Impact Assessment not found.');
    }

    public function delete_riskassessment(Request $request)
    {
        $RiskAssessmentID = $request->get('RiskAssessmentID');
        
        $RiskAssessment = RiskAssessment::where('RiskAssessmentID', $RiskAssessmentID)->first();

        if ($RiskAssessment) {
            // Delete the Risk Management
            $RiskAssessment->delete();
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