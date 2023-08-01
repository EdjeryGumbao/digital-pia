@extends('layouts.sidebar_layout')

@section('title', 'Comments')

@section('content') 

    <style>
        /* Add your custom CSS here */
        .message-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .message {
            background-color: white;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .message.sent {
            background-color: #f3f3f3;
            text-align: right;
        }
    </style>


    <h4 class="text-center">
        Process name: <strong>{{ $PrivacyImpactAssessment->ProcessName ?? '' }}</strong>
    </h4>

    @if ($Comments)
        @php
            $hasComments = false;
        @endphp


        <div class="message-container">
            @foreach ($Comments as $Comment)
                @if ($Comment->PrivacyImpactAssessmentID == $PrivacyImpactAssessment->PrivacyImpactAssessmentID)
                    @php
                        $hasComments = true;
                    @endphp
                    @if ($currentUser->id == $Comment->UserID)
                        <div class="message">
                            <strong>{{ $currentUser->department }}:</strong>
                            <p>{{ $Comment->Message }}</p>
                            <small>{{ $Comment->created_at }}</small>
                        </div>
                    @else 
                        @foreach ($Users as $User)
                            @if ($Comment->UserID == $User->id)
                                <div class="message sent">
                                    <strong>{{ $User->department }}:</strong>
                                    <p>{{ $Comment->Message }}</p>
                                    <small>{{ $Comment->created_at }}</small>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endif
            @endforeach
        </div> <!-- Message Container -->
        @if (!$hasComments)
            <p class="text-center p-2">No messages yet</p>
        @endif
    @endif
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="text-center">
                <form action="" method="POST">
                    @csrf
                    <div class="input-group">
                        <textarea class="form-control" name="Message"></textarea>
                        <input type="hidden" name="PrivacyImpactAssessmentID" value="{{ $PrivacyImpactAssessment->PrivacyImpactAssessmentID }}">
                        <div class="input-group-append" style="padding-left:20px">
                            <button type="submit" class="btn btn-primary btn-lg" name="Button" value="add">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>    
    </div>

    <div class="p-2">
        <form action='view_pia' method='POST' class="">
            @csrf
            <button type='submit' name='PrivacyImpactAssessmentID' class='btn btn-primary' value='{{ $PrivacyImpactAssessment->PrivacyImpactAssessmentID }}'>
                Back        
            </button>
        </form>
    </div>
@stop