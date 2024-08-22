@extends('Admin.adminHome')

@section('Admin_Content')
<div class="reportcontainer">
    <h2>Generated Reports</h2>
    <button class="btn btn-info"><a href="{{ route('Admin.pages.Report.generate') }}">Add</a></button>
    <ul>
        @foreach($reports as $report)
        <li>{{ $report->title }} -
            @if ($report->file_path)
            <a href="{{ route('Admin.pages.Report.download', $report->id) }}">Download</a>
            @else
            No file available
            @endif
        </li>
        @endforeach
    </ul>
</div>
@endsection
