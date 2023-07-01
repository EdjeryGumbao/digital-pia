@extends('layouts.sidebar_layout')

@section('title', 'Threshold Analysis')

@section('content')

@if($value == 1)
    <p>Welcome to the Threshold Analysis!</p>

    <p>
        The following questions are intended to help you decide whether a PIA is necessary. 
        Answering ‘yes’ to any of these questions is an indication that a PIA would be a useful exercise. 
        You can expand on your answers as the project develops if you need to.
    </p>
    
    <form action="proceed_to_data_flows" method="post">
        @csrf
        <p>a. Will the project or system involve the collection of new information about individuals?</p>
        <label><input type="radio" id="radioPrimary1" name="question_a" value="no"> No</label>
        <label><input type="radio" id="radioPrimary1" name="question_a" value="yes"> Yes</label>

        <p>b. Is the information about individuals sensitive in nature and likely to raise privacy concerns or expectations e.g. health records, criminal records or other information people would consider particularly private?</p>
        <label><input type="radio" name="question_b" value="no"> No</label>
        <label><input type="radio" name="question_b" value="yes"> Yes</label>

        <p>c. Are you using information about individuals for a purpose it is not currently used for, or in a way it is not currently used?</p>
        <label><input type="radio" name="question_c" value="no"> No</label>
        <label><input type="radio" name="question_c" value="yes"> Yes</label>

        <p>d. Will the initiative require you to contact individuals in ways which they may find intrusive?</p>
        <label><input type="radio" name="question_d" value="no"> No</label>
        <label><input type="radio" name="question_d" value="yes"> Yes</label>

        <p>e. Will information about individuals be disclosed to organizations or people who have not previously had routine access to the information?</p>
        <label><input type="radio" name="question_e" value="no"> No</label>
        <label><input type="radio" name="question_e" value="yes"> Yes</label>

        <p>f. Does the initiative involve you using new technology which might be perceived as being privacy intrusive (e.g. biometrics or facial recognition)?</p>
        <label><input type="radio" name="question_f" value="no"> No</label>
        <label><input type="radio" name="question_f" value="yes"> Yes</label>

        <p>g. Will the initiative result in you making decisions or taking action against individuals in ways which can have a significant impact on them?</p>
        <label><input type="radio" name="question_g" value="no"> No</label>
        <label><input type="radio" name="question_g" value="yes"> Yes</label>

        <p>h. Are the personal data collected prior to August 2016?</p>
        <label><input type="radio" name="question_h" value="no"> No</label>
        <label><input type="radio" name="question_h" value="yes"> Yes</label>

        <br><button type="submit" class="btn btn-primary" value="1" name="value">Submit</button> <!-- Change value here later -->
    </form>

@else
    <p>You have to agree.</p>
    <a href="{{ url('system_description') }}" class="btn btn-primary">Start Again</a>
@endif


@stop