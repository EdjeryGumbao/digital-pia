
@extends('layouts.sidebar_layout')

@section('title', 'Data Flow List')

@section('content')
    <style>
        .image-container {
        position: relative;
        display: inline-block;
        }

        .view-text {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        opacity: 0; /* Hide the text by default */
        transition: opacity 0.3s ease;
        }

        .image-container:hover .view-text {
        opacity: 1; /* Show the text when the container is hovered */
        }
    </style>

    @if ($DataFlow->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Flow List</h3>
            </div>    <!-- /card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr> 
                            <th width="80px">Department</th>
                            <th class="text-center">Image</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DataFlow as $item)
                            <tr>
                                <td class="text-center">
                                    @foreach($PrivacyImpactAssessment as $item2)
                                        @if ($item->PrivacyImpactAssessmentID == $item2->PrivacyImpactAssessmentID)
                                            @foreach($User as $item3)
                                                @if ($item2->UserID == $item3->id)
                                                    {{ $item3->department }}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="/images/{{ $item->FileName }}" target="_blank">
                                        <div class="image-container">
                                            <img src="/images/{{ $item->FileName }}" alt="{{ $item->FileName }}" class="card-img-top" height="50">
                                            <span class="view-text">View</span>
                                        </div>
                                    </a>
                                </td>
                                <td>{{ $item->created_at->format('Y, F d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /card-body -->
        </div> <!-- /card -->
    @else
        <p>There are no Data Flowchart listed yet.</p>
    @endif
@stop