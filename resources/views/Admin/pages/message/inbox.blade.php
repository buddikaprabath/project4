@extends('Admin.adminHome')

@section('Admin_Content')
<div class="message-container">
    <h2>Inbox</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="message-list">
        @foreach($users as $user)
        <div class="message">
            <div class="message-content">
                <p>{{ $user->name }}</p>
                <a href="{{ route('Admin.pages.message.show', $user->national_id) }}" class="btn btn-primary">View</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
