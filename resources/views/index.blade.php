<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJAX Chat</title>
</head>
<body>
    <form id="ajax-form" action="{{ route('store') }}" method="post">
        @csrf
        <input type="text" name="message">
        <button type="submit">submit</button>
    </form>

    <div id="success-message" style="display: none; color: green;">Message sent successfully!</div>
    <div id="error-message" style="display: none; color: red;">There was an error sending the message.</div>

    <div id="messages">
        @foreach ($messages as $message)
            <p>{{ $message->message }}</p>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ajax-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting via the browser

                let formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#ajax-form')[0].reset(); // Reset the form fields

                        // Update the messages list
                        fetchMessages();
                    },
                    error: function(xhr) {
                        $('#error-message').show().delay(3000).fadeOut();
                    }
                });
            });

            function fetchMessages() {
                $.ajax({
                    url: '{{ route('messages.fetch') }}',
                    type: 'GET',
                    success: function(response) {
                        let messagesContainer = $('#messages');
                        messagesContainer.empty();
                        response.messages.forEach(function(message) {
                            messagesContainer.append('<p>' + message.message + '</p>');
                        });
                    }
                });
            }

            // Fetch messages every 1 seconds
            setInterval(fetchMessages, 1000);

            // Fetch messages initially when the page loads
            fetchMessages();
        });
    </script>
</body>
</html>
