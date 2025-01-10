@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to the Chat Room: {{ $chatRoom->room_name }}</h1>

        <div class="chat-box">
            @foreach ($messages as $message)
                <div class="message" id="message-{{ $message->id }}">
                    <strong>{{ $message->user->username }}</strong>: {{ $message->content }}
                    <br>

                    <!-- Reply form -->
                    <form action="{{ route('chat.storeReply') }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $message->id }}">
                        <textarea name="content" placeholder="Type your reply..." required></textarea>
                        <button type="submit">Reply</button>
                    </form>

                    <!-- Display replies -->
                    @foreach ($message->replies as $reply)
                        <div class="reply">
                            <strong>{{ $reply->user->username }}:</strong> {{ $reply->content }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <hr>

        <!-- Post a new message -->
        <form action="{{ route('chat.storeMessage') }}" method="POST">
            @csrf
            <textarea name="content" placeholder="Type a message..." required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
@endsection
