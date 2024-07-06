$(document).ready(function() {




    console.log("Document ready");

    const channel = Echo.channel('chat');
    console.log("Subscribed to chat channel");

    channel.listen('.message.new', (e) => {
        console.log("New message received:", e);
        $('#messages').append(`
            <div class="message">
                <strong>${e.message.user.name}:</strong> ${e.message.content}
            </div>
        `);
    });
      // Set up CSRF token for AJAX requests
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle form submission
    $('#message-form').submit(function(e) {
        e.preventDefault();
        console.log("Form submitted");
        const content = $('#content').val();

        $.post('/messages', { content: content })
            .done(function(response) {
                $('#content').val('');
                $('#messages').append(`
                    <div class="message">
                        <strong>You:</strong> ${content}
                    </div>
                `);
            })
            .fail(function(xhr, status, error) {
                console.error("Error sending message:", status, error);
                alert("Failed to send message. Please try again.");
            });
    });
});

