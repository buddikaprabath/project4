@extends('Admin.adminHome')

@section('Admin_Content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Generate Report</div>

                <div class="card-body">
                    <form action="{{ route('Admin.pages.Report.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Report Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Report Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
