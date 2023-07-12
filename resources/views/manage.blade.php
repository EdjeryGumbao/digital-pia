
@extends('layouts.sidebar_layout')

@section('title', 'Manage')

@section('content')

    <h3><strong>Manage Accounts</strong></h3>

    <div class="d-flex flex-row-reverse">
        <div class="p-2">
            <a href="{{ url('registerNewAccount') }}" class="btn btn-success">Create Account</a>
        </div>
    </div></br>
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                <th>@sortablelink('id', 'User ID')</th>
                <th>@sortablelink('completename', 'Complete Name')</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
            @if(isset($User))
                @foreach ($User as $item)
                    @if ($item->usertype == 'user')
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->completename }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="p-2">
                                        <form action="delete_account" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" name="id" value="{{ $item->id }}">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @else
                <p>There are currently no users</p>
            @endif
            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div><br>


    <h3><strong>Current Active Question Set:</strong></h3>
    <p>Note: The question set version is the version of the PIA</p>

    @if(isset($ProcessQuestions))
        @foreach ($ProcessQuestions as $questions)
            @if(isset($PrivacyImpactAssessmentVersion))
                @foreach ($PrivacyImpactAssessmentVersion as $PIAversion)
                    @if ($PIAversion->Version == $questions->ProcessQuestionsID && $PIAversion->IsActive == true)
                        <div class="row justify-content-center mt-5">
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>Question Set Version: {{ $questions->ProcessQuestionsID ?? '' }}</strong></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p><strong>{{ $questions->QuestionSetName ?? '' }}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-nowrap"><strong>SectionA:</strong></td>
                                                    <td>{{ $questions->SectionATitle ?? '' }}</td>
                                                    <td>
                                                        <ul>
                                                            @if(isset($questions->SectionAQuestions))
                                                                @foreach ($questions->SectionAQuestions as $sectionQuestion)
                                                                    <li>{{ $sectionQuestion }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-nowrap"><strong>SectionB:</strong></td>
                                                    <td>{{ $questions->SectionBTitle ?? '' }}</td>
                                                    <td>
                                                        <ul>
                                                            @if(isset($questions->SectionBQuestions))
                                                                @foreach ($questions->SectionBQuestions as $sectionQuestion)
                                                                    <li>{{ $sectionQuestion }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-nowrap"><strong>SectionC:</strong></td>
                                                    <td>{{ $questions->SectionCTitle ?? '' }}</td>
                                                    <td>
                                                        <ul>
                                                            @if(isset($questions->SectionCQuestions))
                                                                @foreach ($questions->SectionCQuestions as $sectionQuestion)
                                                                    <li>{{ $sectionQuestion }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-nowrap"><strong>SectionD:</strong></td>
                                                    <td>{{ $questions->SectionDTitle ?? '' }}</td>
                                                    <td>
                                                        <ul>
                                                            @if(isset($questions->SectionDQuestions))
                                                                @foreach ($questions->SectionDQuestions as $sectionQuestion)
                                                                    <li>{{ $sectionQuestion }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            @if(isset($PrivacyImpactAssessmentVersion))
                                                                @foreach ($PrivacyImpactAssessmentVersion as $PIAversion)
                                                                    @if ($PIAversion->Version == $questions->ProcessQuestionsID && $PIAversion->IsActive == false)
                                                                        <div class="p-2">
                                                                            <form action="activate_question_set" method="post">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-success" name="ProcessQuestionsID" value="{{ $questions->ProcessQuestionsID }}">Activate</button>
                                                                            </form>
                                                                        </div>
                                                                    @elseif ($PIAversion->Version == $questions->ProcessQuestionsID && $PIAversion->IsActive == true)
                                                                        <div class="p-2">
                                                                            <span class="text-success">Active</span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            <div class="p-2">
                                                                <form action="delete_question_set" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger" name="ProcessQuestionsID" value="{{ $questions->ProcessQuestionsID }}">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach

        <h3><strong>Manage Question Set</strong></h3>

        <div class="d-flex flex-row-reverse">
            <div class="p-2">
                <a href="{{ url('add_question_set') }}" class="btn btn-success">Add Question Set</a>
            </div>
        </div>

        @foreach ($ProcessQuestions as $questions)
            <div class="row justify-content-center mt-5">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Questions Version: {{ $questions->ProcessQuestionsID ?? '' }}</strong></h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap"><strong>SectionA:</strong></td>
                                        <td>{{ $questions->SectionATitle ?? '' }}</td>
                                        <td>
                                            <ul>
                                                @if(isset($questions->SectionAQuestions))
                                                    @foreach ($questions->SectionAQuestions as $sectionQuestion)
                                                        <li>{{ $sectionQuestion }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap"><strong>SectionB:</strong></td>
                                        <td>{{ $questions->SectionBTitle ?? '' }}</td>
                                        <td>
                                            <ul>
                                                @if(isset($questions->SectionBQuestions))
                                                    @foreach ($questions->SectionBQuestions as $sectionQuestion)
                                                        <li>{{ $sectionQuestion }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap"><strong>SectionC:</strong></td>
                                        <td>{{ $questions->SectionCTitle ?? '' }}</td>
                                        <td>
                                            <ul>
                                                @if(isset($questions->SectionCQuestions))
                                                    @foreach ($questions->SectionCQuestions as $sectionQuestion)
                                                        <li>{{ $sectionQuestion }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap"><strong>SectionD:</strong></td>
                                        <td>{{ $questions->SectionDTitle ?? '' }}</td>
                                        <td>
                                            <ul>
                                                @if(isset($questions->SectionDQuestions))
                                                    @foreach ($questions->SectionDQuestions as $sectionQuestion)
                                                        <li>{{ $sectionQuestion }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                @if(isset($PrivacyImpactAssessmentVersion))
                                                    @foreach ($PrivacyImpactAssessmentVersion as $PIAversion)
                                                        @if ($PIAversion->Version == $questions->ProcessQuestionsID && $PIAversion->IsActive == false)
                                                            <div class="p-2">
                                                                <form action="activate_question_set" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success" name="ProcessQuestionsID" value="{{ $questions->ProcessQuestionsID }}">Activate</button>
                                                                </form>
                                                            </div>
                                                        @elseif ($PIAversion->Version == $questions->ProcessQuestionsID && $PIAversion->IsActive == true)
                                                            <div class="p-2">
                                                                <span class="text-success">Active</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <div class="p-2">
                                                    <form action="delete_question_set" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger" name="ProcessQuestionsID" value="{{ $questions->ProcessQuestionsID }}">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>There are currently no question set, a default one will be created when a user starts the privacy impact assessment</p>
    @endif
@stop