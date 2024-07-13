<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .hide {
            display: none;
        }

        .user{
            cursor: pointer;
        }
        .cross{
            cursor: pointer;
        }
        .scroll {
        flex: 1;
        overflow-y: auto;
        padding-bottom: 20px; /* Add padding if necessary */
    }

    /* Hide scrollbar for Chrome, Safari, and Edge */
    .scroll::-webkit-scrollbar {
        width: 0; /* Remove scrollbar space */
    }

    /* Hide scrollbar for Firefox */
    .scroll {
        scrollbar-width: none; /* Firefox */
    }
    </style>
</head>

    <title>Document</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inbox <span class="count badge rounded-pill bg-danger"></span></a>
                          </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    <ul>
                        @foreach ($users as  $data)
                            <li class="user" data-id="{{ $data->id }}" > {{ $data->name }} </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-10">
                    <div class="card convo hide">
                        <div class="card-header">
                            <h5 class="name"></h5>
                            <span class="float-end cross">X</span>
                        </div>
                        <div class="card-body">
                            <div class="flex flex-col  ">
                                <div class="bg-white shadow rounded-b-lg p-4">

                                    <div class="flex flex-col space-y-4 scroll" style="height: 300px; overflow-y: auto" >

                                            <div class="flex items-center">
                                                <div class="flex flex-col">
                                                    <span class="font-bold  "></span>
                                                </div>
                                            </div>

                                                <div id="message-container" style="flex: 1; overflow-y: auto;"></div>

                                    </div>

                                    <form id="message-form" action="{{ route('chat.store') }}" method="post" class="mt-4">
                                        @csrf
                                        <input type="text" name="message" id="message" class=" px-4 py-2 border rounded-lg" placeholder="Type a message..." style="width: 91%">
                                        <input type="hidden" name="receiver_id" id="receiver_id">
                                        <button type="submit" id="send-message" class="px-4 py-2 btn btn-dark text-white ">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     let name ='' ;
     let auth = '{{ Auth::user()->id }}';

    $(document).ready(function() {
        $(document).on('click', '.user', function() {
            $('.convo').removeClass('hide');
             name = $(this).text().trim();

            let id = $(this).data('id');
            $('.name').text(name);
            $('#receiver_id').val(id);

            $.ajax({
                type: "GET",
                url: `/get/messages/${id}`,
                data:id,
                success: function(response) {
                   console.log(response);
                   displayMessages(response);

                }


            });
        });

        function displayMessages(response) {
            let messageContainer = $('#message-container');
            messageContainer.empty(); // Clear previous messages

            response.forEach(function(item) {
                let messageDiv = $('<div></div>').addClass('flex items-center');
                let messageContent = `
                    <div class="flex flex-col
                     `+ (item.sender_id == auth ? 'float-end' : '')  +`">
                     <span class="font-bold name

                     ">
                     `+
                     (item.sender_id == auth ? 'You' : name)
                     + `

                     :
                            </span> <!-- Replace with actual user name if available -->
                        <span class="message

                        ">${item.message}</span>
                    </div>
                    <br>
                `;
                messageDiv.html(messageContent);
                messageContainer.append(messageDiv);
            });
        }
        $(document).on('click', '.cross', function() {
            $('.convo').addClass('hide');
        });

        let lastCount = 0;

    // Function to fetch messages
    function fetchMessages(id) {
        $.ajax({
            type: "GET",
            url: `/get/messages/${id}`,
            success: function(response) {
                displayMessages(response);
            }
        });
    }

    // Function to display messages
    function displayMessages(messages) {
        let messageContainer = $('#message-container');
        messageContainer.empty(); // Clear previous messages

        messages.forEach(function(item) {
            let messageDiv = $('<div></div>').addClass('flex items-center');
            let messageContent = `
                <div class="flex flex-col ${item.sender_id == auth ? 'float-end' : ''}">
                    <span class="font-bold name">
                        ${item.sender_id == auth ? 'You' : name}:
                    </span>
                    <span class="message">${item.message}</span>
                </div>
                <br>
            `;
            messageDiv.html(messageContent);
            messageContainer.append(messageDiv);
        });
    }
     // Submit form handler
     $('form').submit(function(event) {
        event.preventDefault();
        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: formData,
            success: function(response) {
                displayMessages(response); // Update messages on success
                form.find('input[type=text]').val(''); // Clear input field
            }
        });
    });


    function checkForUpdates() {
            $.ajax({
                url: `/get/count`,
                type: 'GET',
                success: function(count) {
                    if (count > lastCount) {
                        lastCount = count;
                        // Fetch the latest messages for the selected user
                        let receiverId = $('#receiver_id').val();
                        if (receiverId) {
                            fetchMessages(receiverId);
                        }
                    }
                }
            });
        }

    // Periodically check for updates every second




    setInterval(checkForUpdates, 4000);
    });
</script>

{{-- <script>
    $(document).ready(function() {
        $('#send-message').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Fetch form data
            var formData = $('#message-form').serialize();

            // Send AJAX request
            $.ajax({
                url: "{{ route('chat.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                  $('#message').val('');
                },
                error: function(xhr, status, error) {
                    // Handle error response (if any)
                    console.error('Error:', error);
                    // Optionally, you can show an error message to the user
                }
            });
        });
    });
</script> --}}


</html>
