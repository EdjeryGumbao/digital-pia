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
use App\Models\ProcessQuestions;
use App\Models\Recommendation;
use App\Models\Comments;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\PDF;


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
            'lastname' => '',
            'firstname' => '',
            'middlename' => '',
            'department' => 'DPO',
            'email' => 'admin@usep.edu.ph',
            'usertype' => 'admin',
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

    public function threatlist(Request $request)
    {   
        if (auth()->user()->usertype == 'admin') {
            $RiskAssessment = RiskAssessment::sortable()->orderBy('RiskAssessmentID', 'desc')->get();
            $PrivacyImpactAssessment = PrivacyImpactAssessment::sortable()->orderBy('Author', 'desc')->get();

            return view('threatlist', compact('PrivacyImpactAssessment', 'RiskAssessment'));
        } else {
            return redirect()->to(url('dashboard'));
        }
    }

    public function dataflowlist(Request $request)
    {   
        if (auth()->user()->usertype == 'admin') {
            $DataFlow = DataFlow::sortable()->orderBy('DataFlowID', 'desc')->get();
            $PrivacyImpactAssessment = PrivacyImpactAssessment::sortable()->orderBy('Author', 'desc')->get();
            $User = User::sortable()->orderBy('id', 'desc')->get();

            return view('dataflowlist', compact('PrivacyImpactAssessment', 'DataFlow', 'User'));
        } else {
            return redirect()->to(url('dashboard'));
        }
    }

    public function recommendationlist(Request $request)
    {   
        if (auth()->user()->usertype == 'admin') {
            $Recommendation = Recommendation::sortable()->orderBy('RecommendationID', 'desc')->get();
            $PrivacyImpactAssessment = PrivacyImpactAssessment::sortable()->orderBy('PrivacyImpactAssessmentID', 'desc')->get();
            $User = User::sortable()->orderBy('id', 'desc')->get();

            return view('recommendationlist', compact('PrivacyImpactAssessment', 'Recommendation', 'User'));
        } else {
            return redirect()->to(url('dashboard'));
        }
    }

    public function manage()
    {
        if (auth()->user()->usertype == 'admin') {
            $User = User::sortable()->orderBy('id', 'desc')->get();
            $PrivacyImpactAssessmentVersion = PrivacyImpactAssessmentVersion::all();
            $ProcessQuestions = ProcessQuestions::sortable()->orderBy('ProcessQuestionsID', 'desc')->get();
    
            return view('manage', compact('User', 'ProcessQuestions', 'PrivacyImpactAssessmentVersion'));
        } else {
            return redirect()->to(url('dashboard'));
        }
    }

    public function add_question_set(Request $request)
    {
        return view('add_question_set');
    }
    
    public function delete_question_set(Request $request)
    {
        $ProcessQuestionsID = $request->input('ProcessQuestionsID');
        $ProcessQuestions = ProcessQuestions::where('ProcessQuestionsID', $ProcessQuestionsID)->first();

        if ($ProcessQuestions) {
            $ProcessQuestions->delete();
        }
        return redirect()->to(url('manage'));
    } 

    public function delete_account(Request $request)
    {
        $UserID = $request->input('id');
        $User = User::where('id', $UserID)->first();
        if ($User) {
            $User->delete();
        }
        return redirect()->to(url('manage'));
    }


    public function InsertProcessQuestion(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'QuestionSetName' => 'required|string',
            'SectionATitle' => 'required|string',
            'SectionBTitle' => 'required|string',
            'SectionCTitle' => 'required|string',
            'SectionDTitle' => 'required|string',
            'SectionAQuestions' => 'required|array',
            'SectionBQuestions' => 'required|array',
            'SectionCQuestions' => 'required|array',
            'SectionDQuestions' => 'required|array',
        ]);

        
        //dd($request->all());

        $ProcessQuestions = new ProcessQuestions();
        $ProcessQuestions->QuestionSetName = $request->input('QuestionSetName');
        $ProcessQuestions->SectionATitle = $request->input('SectionATitle');
        $ProcessQuestions->SectionBTitle = $request->input('SectionBTitle');
        $ProcessQuestions->SectionCTitle = $request->input('SectionCTitle');
        $ProcessQuestions->SectionDTitle = $request->input('SectionDTitle');
        $ProcessQuestions->SectionAQuestions = $request->input('SectionAQuestions');
        $ProcessQuestions->SectionBQuestions = $request->input('SectionBQuestions');
        $ProcessQuestions->SectionCQuestions = $request->input('SectionCQuestions');
        $ProcessQuestions->SectionDQuestions = $request->input('SectionDQuestions');
        
        //dd($ProcessQuestions);
        
        $ProcessQuestions->save();
        
        // Set the version of the PIA
        $data = [
            'IsActive' => true,
            'PIAVersion' => $ProcessQuestions->ProcessQuestionsID,
        ];

        $request = new Request($data);
        
        $this->InsertPrivacyImpactAssessmentVersion($request);

        return redirect()->to(url('manage'));
    }

    public function activate_question_set(Request $request) {
        $this->TurnOffAllPIA();

        $ProcessQuestionsID = $request->get('ProcessQuestionsID');
        $PrivacyImpactAssessmentVersion = PrivacyImpactAssessmentVersion::where('PIAVersion', $ProcessQuestionsID)->first();
        
        if ($PrivacyImpactAssessmentVersion) {
            $PrivacyImpactAssessmentVersion->IsActive = true;
            $PrivacyImpactAssessmentVersion->save();
        }
        
        return redirect()->to(url('manage'));
    }

    public function ToggleChecked() {
        $PrivacyImpactAssessmentVersion = PrivacyImpactAssessmentVersion::all();
        foreach ($PrivacyImpactAssessmentVersion as $version) {
            $version->IsActive = false;
            $version->save();
        }
        return;
    }

    public function TurnOffAllPIA() {
        $PrivacyImpactAssessmentVersion = PrivacyImpactAssessmentVersion::all();
        foreach ($PrivacyImpactAssessmentVersion as $version) {
            $version->IsActive = false;
            $version->save();
        }
        return;
    }

    public function registerNewAccount() {
        return view('auth.register');
    }

    public function validatePIA(Request $request) {
        $PrivacyImpactAssessmentID = $request->get('PrivacyImpactAssessmentID');
        $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
        if ($request->get('button') == 'validate') {
            $PrivacyImpactAssessment->Status = 'Validated'; // green
            $PrivacyImpactAssessment->DateValidated = date('Y-m-d H:i:s', time());
            $PrivacyImpactAssessment->save();
        }
        elseif ($request->get('button') == 'invalidate') {
            $PrivacyImpactAssessment->Status = 'Pending'; // yellow
            $PrivacyImpactAssessment->save();
        }
        elseif ($request->get('button') == 'revise') {
            $PrivacyImpactAssessment->Status = 'Needs Revision'; // red
            $PrivacyImpactAssessment->save();
        }
        elseif ($request->get('button') == 'revised') {
            $PrivacyImpactAssessment->Status = 'Revised'; // blue
            $PrivacyImpactAssessment->save();
        }

        return redirect()->to(url('pialist'));
    }

    // dept head parts

    public function InsertPrivacyImpactAssessmentVersion(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'IsActive' => 'required|boolean',
            'PIAVersion' => 'required|integer',
        ]);

        $this->TurnOffAllPIA();
        // Create a new PrivacyImpactAssessmentVersion instance
        $privacyImpactAssessmentVersion = new PrivacyImpactAssessmentVersion;
        $privacyImpactAssessmentVersion->IsActive = $validatedData['IsActive'];
        $privacyImpactAssessmentVersion->PIAVersion = $validatedData['PIAVersion'];
        $privacyImpactAssessmentVersion->save();

        return;
    }

    public function create_pia_version_one()
    {
        // Create a new PrivacyImpactAssessmentVersion instance
        $privacyImpactAssessmentVersion = new PrivacyImpactAssessmentVersion;
        $privacyImpactAssessmentVersion->IsActive = true; // Set the value for IsActive as needed
        $privacyImpactAssessmentVersion->PIAVersion = 1;
        $privacyImpactAssessmentVersion->save();
        return;
    }
    

    public function CreateDefaultQuestions()
    {
        $processQuestions = new ProcessQuestions();
        $processQuestions->QuestionSetName = 'Process-level Analysis: Data Lifecycle';
        $processQuestions->SectionATitle = 'Data Collection';
        $processQuestions->SectionBTitle = 'Data Use';
        $processQuestions->SectionCTitle = 'Data Disclosure';
        $processQuestions->SectionDTitle = 'Data Storage or Disposal';
        $processQuestions->SectionAQuestions = [
            'Data Source:',
            'Collection Method:',
            'Timing of Collection:',
        ];
        $processQuestions->SectionBQuestions = [
            'Is the data being used as is, or does it undergo further processing?',
            'Is there automated decision-making?',
        ];
        $processQuestions->SectionCQuestions = [
            'Is data being transferred to third parties?',
            'Third-party recipients',
            'Purpose/s of the transfer to the third party?',
            'Is the data transfer supported by a data sharing agreement or a data outsourcing agreement?',
            'Is the personal data transferred outside of the Philippines? If so, where?',
        ];
        $processQuestions->SectionDQuestions = [
            'Retention period',
            'Location of data/how stored',
            'Is personal data being destroyed?',
        ];
        $processQuestions->save();

        return;
    }

    public function InsertPrivacyImpactAssessment(Request $request)
    {
        $UserID = auth()->id();

        if (auth()->user()->middlename !== null && auth()->user()->middlename !== '') {
            $Author = auth()->user()->firstname . ' ' . substr(auth()->user()->middlename, 0, 1) . '. ' . auth()->user()->lastname;
        } else {
            $Author = auth()->user()->firstname . ' ' . auth()->user()->lastname;
        }
        
        $Department = auth()->user()->department;
        
        // generating questions
        $PrivacyImpactAssessmentVersion = PrivacyImpactAssessmentVersion::where('IsActive', true)->first();
        $PrivacyImpactAssessmentVersionID = $PrivacyImpactAssessmentVersion->PIAVersion;

        // Validate the request data
        request()->validate([
            'ProcessName' => 'required|string',
        ]);
    
        if (session()->has('PrivacyImpactAssessmentID')) { // user returned to edit the title
            $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', session('PrivacyImpactAssessmentID'))->first();
            
            // Update the existing Process instance with new values
            $PrivacyImpactAssessment->update([
                'ProcessName' => $request->get('ProcessName'),
            ]);
        } else { // user just started

            // Create a new PrivacyImpactAssessment instance
            $PrivacyImpactAssessment = new PrivacyImpactAssessment([
                'PIAVersion' => $PrivacyImpactAssessmentVersionID,
                'UserID' => $UserID,
                'Author' => $Author,
                'Department' => $Department,
                'ProcessName' => request('ProcessName'),
            ]);
            $PrivacyImpactAssessment->save();

        }    

        session()->put('PrivacyImpactAssessmentID', $PrivacyImpactAssessment->PrivacyImpactAssessmentID);
        
        return redirect()->to(url('proceed_to_process'));
    }
    




    public function InsertProcess(Request $request)
    {
        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        $result = Process::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();

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
        } else if ($request->has('edit_datafield')) {
            $DataFields = DataFields::where('DataFieldsID', $request->get('edit_datafield'))->first();
            
            return view('edit_data', compact('DataFields'));
        }

        
        // Validate the request data
        $request->validate([
            'DataSubject' => 'nullable|string',
            'PurposeforProcessing' => 'nullable|string',
            'SecurityMeasure' => 'nullable|string',
            'ProcessNarrative' => 'nullable|array',
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
                'ProcessNarrative' => $request->input('ProcessNarrative'),
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
                'ProcessNarrative' => $request->input('ProcessNarrative'),
                'SectionA' => $request->input('SectionA'),
                'SectionB' => $request->input('SectionB'),
                'SectionC' => $request->input('SectionC'),
                'SectionD' => $request->input('SectionD'),
            ]);

            // Set values for other attributes
            $Process->save();
        }

        if (isset($request->FormUsed) || isset($request->Datacollected)) {
            $this->InsertDataFields($request);
        }
        if ($request->Button == "Next") {
            return redirect()->to(url('proceed_to_risk_assessment'));
        } elseif ($request->Button == "FormData") {
            return redirect()->to(url('proceed_to_process'));
        } elseif ($request->Button == "Back") {
            return redirect()->to(url('proceed_to_start')); 
        } else {
            return redirect()->to(url('proceed_to_process'));
        } 
    }


    public function InsertDataFields(Request $request)
    {
        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');

        // Validate the request data
        $request->validate([
            'FormUsed' => 'required|string',
            'Datacollected' => 'required|array',
        ], [
            'FormUsed.required' => 'The Data Collection Form field is required.',
            'FormUsed.string' => 'The Data Collection Form field must be a string.',
            'Datacollected.required' => 'The Data fields is required.',
            'Datacollected.array' => 'The Data fields must be an array.',
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
        
        return redirect()->to(url('proceed_to_risk_assessment'));
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

        return redirect()->to(url('proceed_to_flowchart'));
    }

    public function InsertRecommendation(Request $request)
    {
        // Validate the request data
        $request->validate([
            'Recommendation' => 'required|string',
            'Priority' => 'required|integer',
        ]);

        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');

        $Priority = $request->get('Priority');

        // Check if the ranking already exists for the given PrivacyImpactAssessmentID
        $existingRecommendation = Recommendation::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)
            ->where('Priority', $Priority)
            ->first();
    
        if ($existingRecommendation) {
            return redirect()->back()->withErrors(['Priority' => 'The priority number already exists. Please choose a different priority number.']);
        } else if ($Priority < 1) {
            return redirect()->back()->withErrors(['Priority' => 'Invalid priority number. Please choose a priority number greater than or equal to 1.']);
        }

        $Recommendation = new Recommendation([
            'PrivacyImpactAssessmentID' => $PrivacyImpactAssessmentID,
            'Recommendation' => $request->get('Recommendation'),
            'Priority' => $request->get('Priority'),
        ]);
        $Recommendation->save();

        return redirect()->to(url('proceed_to_recommendation'));
    }

    public function proceed_to_disclaimer(Request $request) {
        return view('pia2/proceed_to_disclaimer');
    }

    public function proceed_to_start(Request $request)
    {        
        if(isset($request->PrivacyImpactAssessmentID)) { 
            session()->put('PrivacyImpactAssessmentID', $request->PrivacyImpactAssessmentID);
        }

        if(PrivacyImpactAssessmentVersion::count() === 0){ // user just started their first PIA
            $this->create_pia_version_one();
        }

        if(ProcessQuestions::count() === 0) {
            $this->CreateDefaultQuestions();
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
        $request->session()->put('PrivacyImpactAssessmentVersion', $PrivacyImpactAssessmentVersion->PIAVersion);

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

        // generating questions
        $PrivacyImpactAssessmentVersion = PrivacyImpactAssessmentVersion::where('IsActive', true)->first();
        $ProcessQuestions = ProcessQuestions::where('ProcessQuestionsID', $PrivacyImpactAssessmentVersion->PIAVersion)->first();

        // generating already given data
        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        $Process = Process::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
        $DataFields = DataFields::all();
        
        //dd($Process);
        //dd($DataFields);

        if ($Process || $DataFields) {
            // Data exists, pass the process data to the view
            return view('pia2/proceed_to_process', compact('Process', 'DataFields', 'ProcessQuestions'));
        } else {
            // Data doesn't exist
            return view('pia2/proceed_to_process', compact('ProcessQuestions'));
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

    public function proceed_to_recommendation()
    {           
        if(!Session::exists('PrivacyImpactAssessmentID')) { // when a user visits this page without an ID
            return $this->index();
        }
        
        $Recommendation = Recommendation::all();
        //dd($Recommendation);
        if ($Recommendation) {
            // Data exists, pass the data to the view
            return view('pia2/proceed_to_recommendation', ['Recommendation' => $Recommendation]);
        } else {
            // Data doesn't exist
            return view('pia2/proceed_to_recommendation');
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
        
        $RiskAssessment = RiskAssessment::all();
        $labels = ['1', '2-4', '6-8','9','12','16'];
        $ranges = [1, 4, 8, 9, 12, 16];
        $counts = [];

        foreach ($ranges as $index => $range) {
            if ($index === 0) {
                $count = $RiskAssessment->where('RiskRating', '=', $range)->count();
            } else {
                $prevRange = $ranges[$index - 1] + 1;
                $count = $RiskAssessment->whereBetween('RiskRating', [$prevRange, $range])->count();
            }
            $counts[] = $count;
        }

        $trueCount = PrivacyImpactAssessment::where('Status', 'Validated')->count();
        $falseCount = PrivacyImpactAssessment::where('Status', '<>', 'Validated')->count();
        $piaCount = PrivacyImpactAssessment::count();
        $riskAssessment = RiskAssessment::count();

        // Return the dashboard view
        return view('dashboard', compact('counts', 'labels', 'trueCount', 'falseCount', 'piaCount', 'riskAssessment'));
    }

    public function pialist(Request $request)
    {
        $this->reset();
        $PrivacyImpactAssessment = PrivacyImpactAssessment::orderBy('PrivacyImpactAssessmentID', 'desc')->get();
        $User = User::all();
        $CurrentUser = auth()->user();

        return view('pialist', compact('PrivacyImpactAssessment', 'User', 'CurrentUser'));
    }

    public function test(Request $request)
    {

        

        //dd(Session::all());
        dd(auth()->user()->id);
    }

    public function view_pia(Request $request)
    {
        if(!Session::exists('PrivacyImpactAssessmentID')){ // when a user visits this page without an ID
            $request->validate([
                'PrivacyImpactAssessmentID' => 'required|integer',
            ]);
            $PrivacyImpactAssessmentID = $request->get('PrivacyImpactAssessmentID'); // gets the value from the form
        } elseif($request->has('PrivacyImpactAssessmentID')) { // this fix the bug of downloading the same thing over again
            $PrivacyImpactAssessmentID = $request->get('PrivacyImpactAssessmentID'); // gets the value from the form 
        }else {
            $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        } 

        $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
        
        if ($PrivacyImpactAssessment) {
            session()->put('PrivacyImpactAssessmentID', $PrivacyImpactAssessment->PrivacyImpactAssessmentID);
            session()->put('PrivacyImpactAssessmentVersionID', $PrivacyImpactAssessment->PrivacyImpactAssessmentVersionID);

            // generating questions
            $PrivacyImpactAssessmentVersion = PrivacyImpactAssessmentVersion::where('PIAVersion', $PrivacyImpactAssessment->PIAVersion)->first();
            $ProcessQuestions = ProcessQuestions::where('ProcessQuestionsID', $PrivacyImpactAssessmentVersion->PIAVersion)->first();

            $Process = Process::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
            $DataFields = DataFields::all();
            $RiskAssessment = RiskAssessment::all();
            $DataFlow = DataFlow::all();
            $Recommendation = Recommendation::all();
            
            if($request->has('download')) {
                $pdf = PDF::loadView('pdf.downloadPIA', compact('Process', 'DataFields', 'RiskAssessment', 'DataFlow', 'Recommendation', 'PrivacyImpactAssessment', 'ProcessQuestions'))->setOptions(['defaultFont' => 'sans-serif']);
                $filename = $PrivacyImpactAssessment->ProcessName . '.pdf';

                return $pdf->stream($filename);
                //return $pdf->download($filename);
            }
            
            return view('viewpia', compact('Process', 'DataFields', 'RiskAssessment', 'DataFlow', 'Recommendation', 'PrivacyImpactAssessment', 'ProcessQuestions'));
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

        return redirect()->to(url('proceed_to_risk_assessment'));
    }
    public function delete_pia(Request $request)
    {
        $PrivacyImpactAssessmentID = $request->get('PrivacyImpactAssessmentID');
        
        $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
        $Process = Process::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
        $DataFields = DataFields::all();
        $RiskAssessment = RiskAssessment::all();
        $DataFlow = DataFlow::all();

        if ($PrivacyImpactAssessment) {
            $PrivacyImpactAssessment->delete();
            
            if($Process) {
                $Process->delete();
            }

            if($DataFields) {
                foreach ($DataFields as $dataField) {
                    if ($dataField->PrivacyImpactAssessmentID == $PrivacyImpactAssessmentID) {
                        $dataField->delete();
                    }
    
                }
            }

            if($RiskAssessment) {
                foreach ($RiskAssessment as $riskAssessment) {
                    if ($riskAssessment->PrivacyImpactAssessmentID == $PrivacyImpactAssessmentID) {
                        $riskAssessment->delete();
                    } 
                }
            }

            if($DataFlow) {
                foreach ($DataFlow as $dataFlow) {
                    if ($dataFlow->PrivacyImpactAssessmentID == $PrivacyImpactAssessmentID) {
                        $dataFlow->delete();
                    }
                }
            }

        }
        return redirect()->to(url('pialist'));
    }

    public function delete_dataflow(Request $request)
    {
        $DataFlowID = $request->get('DataFlowID');
        
        $DataFlow = DataFlow::where('DataFlowID', $DataFlowID)->first();

        if ($DataFlow) {
            // Delete the data flow
            $DataFlow->delete();
        }
        return redirect()->to(url('proceed_to_flowchart'));
    }    

    public function delete_recommendation(Request $request)
    {
        $RecommendationID = $request->get('RecommendationID');
        
        $Recommendation = Recommendation::where('RecommendationID', $RecommendationID)->first();

        if ($Recommendation) {
            $Recommendation->delete();
        }

        return redirect()->to(url('proceed_to_recommendation'));
    }

    public function proceed_to_edit_data(Request $request)
    {   
        if(!Session::exists('PrivacyImpactAssessmentID')) { // when a user visits this page without an ID
            return $this->index();
        }
        $PrivacyImpactAssessmentID = session('PrivacyImpactAssessmentID');
        $DataFields = DataFields::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
        
        return view('edit_data', compact('DataFields'));
    }

    public function edit_data(Request $request)
    {
        // Validate the request data
        $request->validate([
            'FormUsed' => 'required|string',
            'Datacollected' => 'required|array',
        ], [
            'FormUsed.required' => 'The Data Collection Form field is required.',
            'FormUsed.string' => 'The Data Collection Form field must be a string.',
            'Datacollected.required' => 'The Data fields is required.',
            'Datacollected.array' => 'The Data fields must be an array.',
        ]);

        $DataFields = DataFields::where('DataFieldsID', $request->input('DataFieldsID'))->first();
        
        if ($DataFields) {
            $DataFields->FormUsed = $request->input('FormUsed');
            $DataFields->Datacollected = $request->input('Datacollected');
            // Set values for other attributes
            
            $DataFields->save();
        } else {
            // The record does not exist, create a new record
            $newDataFields = new DataFields([
                'PrivacyImpactAssessmentID' => $PrivacyImpactAssessmentID,
                'FormUsed' => $request->input('FormUsed'),
                'Datacollected' => $request->input('Datacollected'),
                // Set values for other attributes
            ]);

            $newDataFields->save();
        }

        return redirect()->to(url('proceed_to_process'));
    }

    public function comments(Request $request)
    {
        if ($request->input('Button') == 'add') {
            $request->validate([
                'Message' => 'required|string',
            ]);
            $UserID = auth()->id();
    
            $Comment = new Comments ([
                'PrivacyImpactAssessmentID' => $request->input('PrivacyImpactAssessmentID'),
                'UserID' => $UserID,
                'Message' => $request->input('Message'),
                'Status' => 'unread',
            ]);
            // dd($Comment->UserID);
            $Comment->save();
        }


        $PrivacyImpactAssessmentID = $request->get('PrivacyImpactAssessmentID');
    
        // Check if PrivacyImpactAssessmentID is set
        if (isset($PrivacyImpactAssessmentID)) {
            // Get the PrivacyImpactAssessment by ID
            $PrivacyImpactAssessment = PrivacyImpactAssessment::where('PrivacyImpactAssessmentID', $PrivacyImpactAssessmentID)->first();
    
            // Get the current user
            $currentUser = auth()->user();
    
            // Get all comments and users (you might want to modify this based on your requirements)
            $Comments = Comments::orderBy('created_at', 'desc')->get();
            $Users = User::all();
    
            // Pass the data to the 'comments' view
            return view('comments', compact('PrivacyImpactAssessment', 'currentUser', 'Users', 'Comments'));
        } else {
            // PrivacyImpactAssessmentID is not set or empty, handle this case accordingly.
            return $this->pialist($request);
            // You can redirect to some other route or return a view with an error message.
        }
    }
}
