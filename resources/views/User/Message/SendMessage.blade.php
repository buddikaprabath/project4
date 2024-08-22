@extends('User.home')

@section('User_Content')
<div class="message-container">
    <h2 class="message-title">Messages</h2>
    <div class="message-history">
        @foreach($messages->reverse() as $message)
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
        <form id="send-message-form" action="{{ route('User.Message.store') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
            @csrf
            <textarea name="content" placeholder="Type your message..." required class="flex-grow-1 mr-2"></textarea>

            <div class="file-input-wrapper">
                <label class="file-input-label position-relative d-inline-block bg-primary text-white rounded-pill py-1 px-3 cursor-pointer">
                    <span class="btn-plus">+</span>
                    <input type="file" name="image" class="file-input position-absolute top-0 start-0 opacity-0" />
                </label>
            </div>

            <button type="submit" class="btn-send btn bg-primary text-white rounded-pill px-4">
                <i class="fas fa-paper-plane"></i> Send
            </button>
        </form>
    </div>

</div>
@endsection
