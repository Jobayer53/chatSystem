<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="chat">
        <div id="messages">
            @foreach($messages as $message)
                <div class="message">
                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                </div>
            @endforeach
        </div>
        <form id="message-form" >
            @csrf
            <input type="text" name="content" id="content" placeholder="Type your message...">
            <button type="submit">Send</button>
        </form>
    </div>

    <script src="{{ asset('js/chat.js') }}"></script>
</body>
</html>
