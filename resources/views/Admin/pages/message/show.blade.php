@extends('Admin.adminHome')

@section('Admin_Content')
<div class="message-container">
    <h2>Messages with {{ $user->name }}</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="message-history">
        @foreach($messages as $message)
        <div id="message-{{ $message->id }}" class="message {{ $message->status == 'sent' ? 'message-sent' : 'message-received' }}">
            <div class="message-content">
                <p>{{ $message->content }}</p>
                @if ($message->image)
                <img src="{{ asset('storage/' . $message->image) }}" alt="Image" class="message-image">
                @endif
                <span class="message-time">{{ $message->created_at->format('h:i A') }}</span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="message-input">
        <form id="reply-form" action="{{ route('Admin.pages.message.reply', $messages->first()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <textarea name="content" placeholder="Type your message..." required></textarea>
            <input type="file" name="image">
            <button type="submit" class="btn-send">
                <i class="fas fa-paper-plane"></i> Send
            </button>
        </form>
    </div>
</div>

@endsection
