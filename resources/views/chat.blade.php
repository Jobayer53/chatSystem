<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .hide {
            display: none;
        }
        .convo{
            border:1px solid #ddd;
        }
        .user{
            cursor: pointer;
        }
        .cross{
            cursor: pointer;
        }
        .female{
            background-color: #ffe9ed;
        }
        .female:hover{
            background-color: #f7c4d5 !important ;
        }
        #plist{
            border:1px solid #ddd;
        }
        .left-message{
            background-color: #ddd !important;
            color:black !important;
            border-radius: 15px 15px 15px 0px !important;
        }
        .chat-style{
            height: 71.8vh;
            overflow-y: auto;
        }

/* Customize scrollbar for webkit browsers (Chrome, Safari) */
.chat-style::-webkit-scrollbar {
    width: 2px !important; /* Adjust the width to make it slim */
}

.chat-style::-webkit-scrollbar-track {
    background: #f1f1f1; /* Background color of the track */
}

.chat-style::-webkit-scrollbar-thumb {
    background: #888; /* Color of the scrollbar handle */
    border-radius: 22px; /* Optional: round corners */
}

.chat-style::-webkit-scrollbar-thumb:hover {
    background: #555; /* Color when hovered */
}

/* Customize scrollbar for Firefox */
.chat-style {
    scrollbar-width: thin; /* Make the scrollbar slim */
    scrollbar-color: #ddd #fff; /* Handle color, track color */
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

    <title>Disting Disting</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <h5>Disting Disting</h5>
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
    {{-- <div class="card">
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
    </div> --}}

<div class="container">
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card chat-app" style="border:none; box-shadow:none;">
            <div id="plist" class="people-list">
                <div class="input-group">
                    Tap to chat
                    {{-- <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search..."> --}}
                </div>
                <div class="chat-style">


                    <ul class="list-unstyled chat-list mt-2 mb-0" >
                        @foreach ($users as  $data)
                        <li class="clearfix user {{ $data->gender == 'female' ? 'female' : '' }} " data-id="{{ $data->id }}" data-country="{{ $data->country }}" data-age="{{ $data->age }}" data-gender="{{ $data->gender }}" >
                            <div class="about d-flex align-items-baseline">
                                <div class="me-2"><i class="" style="height: 15px; width: 15px; display:inherit">
                                    @if($data->gender == 'male')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M289.8 46.8c3.7-9 12.5-14.8 22.2-14.8H424c13.3 0 24 10.7 24 24V168c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L321 204.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176S0 401.2 0 304s78.8-176 176-176c37 0 71.4 11.4 99.8 31l52.6-52.6L295 73c-6.9-6.9-8.9-17.2-5.2-26.2zM400 80l0 0h0v0zM176 416a112 112 0 1 0 0-224 112 112 0 1 0 0 224z"/></svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style=" fill: #f77d92;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M80 176a112 112 0 1 1 224 0A112 112 0 1 1 80 176zM224 349.1c81.9-15 144-86.8 144-173.1C368 78.8 289.2 0 192 0S16 78.8 16 176c0 86.3 62.1 158.1 144 173.1V384H128c-17.7 0-32 14.3-32 32s14.3 32 32 32h32v32c0 17.7 14.3 32 32 32s32-14.3 32-32V448h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H224V349.1z"/></svg>
                                    @endif
                                </i></div>
                                <div class="name">{{ $data->name }}</div>
                                {{-- <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div> --}}
                            </div>
                        </li>
                        @endforeach

                    {{-- <li class="clearfix user female" data-id="{{ $data->id }}" style="" >
                            <div class="about d-flex align-items-baseline">
                                <div class="me-2"><i class="" style="height: 15px; width: 15px; display:inherit">

                                </i></div>
                                <div class="name">{{ $data->name }}</div>

                            </div>
                        </li> --}}

                    </ul>
                </div>
            </div>
            <div class="chat ">
                <div class=" convo hide">
                    <div class="chat-header clearfix ">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex" style="padding-left: 10px;">

                                    <h5 class="m-b-0 username"> </h5>
                                    <span class="svg"></span>
                                </div>
                                <div class="chat-about">
                                    <span id="age"  style="font-size:13px;"></span>,
                                    <span id="country" style="font-size:13px;"></span>
                                    <small></small>
                                </div>
                            </div>
                            <div class="col-lg-6 hidden-sm text-right">
                                <span class="float-end cross">
                                    <i style="display: inherit;height: 20px; width: 20px;margin-top: 9px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="chat-history">
                        <ul class="m-b-0">
                            <li class="clearfix" >
                                <div class="message other-message float-right" style="max-width:60%;"> Hi Aiden, how are you? How is the project coming along? Hi Aiden, how are you? How is the project coming along? </div>
                            </li>

                            <li class="clearfix">

                                <div class="message my-message left-message" style="width:60%;">Project has been already finished and I have results to show you.</div>
                            </li>
                            <li class="clearfix">

                                <div class="message other-message float-right" style="max-width:60%;"> Hi Aiden, how are you?  </div>
                            </li>
                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <input type="text" class="form-control" placeholder="Enter text here...">
                            <button class="btn btn-primary" type="button"> Send</button>
                        </div>
                    </div> --}}
                    <div id="chat-interface" class="d-flex flex-column" style="height: 68vh;">
                        <div id="message-container" class="flex-1 overflow-y-auto"></div>
                        <div class="chat-message clearfix">
                            <div style="bottom: 0; position: absolute;width: 73%;">



                                <form id="message-form" action="{{ route('chat.store') }}" method="post" class="mt-4">
                                    @csrf
                                <div class="input-group mb-0">
                                        <input type="hidden" name="receiver_id" id="receiver_id">

                                        <input type="text" name="message" class="form-control" placeholder="Enter text here...">
                                        <button class="btn btn-primary" type="submit"> Send</button>
                                    </div>
                                </form>
                            </div>
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
    let femalesvg = '<i style="height: 13px; width: 13px; display:inherit; margin-left:5px;"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style=" fill: #f77d92;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M80 176a112 112 0 1 1 224 0A112 112 0 1 1 80 176zM224 349.1c81.9-15 144-86.8 144-173.1C368 78.8 289.2 0 192 0S16 78.8 16 176c0 86.3 62.1 158.1 144 173.1V384H128c-17.7 0-32 14.3-32 32s14.3 32 32 32h32v32c0 17.7 14.3 32 32 32s32-14.3 32-32V448h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H224V349.1z"/></svg></i>';
    let malesvg  = '<i style="height: 13px; width: 13px; display:inherit;margin-left:5px;"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M289.8 46.8c3.7-9 12.5-14.8 22.2-14.8H424c13.3 0 24 10.7 24 24V168c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L321 204.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176S0 401.2 0 304s78.8-176 176-176c37 0 71.4 11.4 99.8 31l52.6-52.6L295 73c-6.9-6.9-8.9-17.2-5.2-26.2zM400 80l0 0h0v0zM176 416a112 112 0 1 0 0-224 112 112 0 1 0 0 224z"/></svg></i>';
    $(document).ready(function() {
        $(document).on('click', '.user', function() {
            $('.convo').removeClass('hide');
             name = $(this).text().trim();
            let age = $(this).data('age');
            let country = $(this).data('country');
            let gender = $(this).data('gender');
            $('#age').text('Age ' + age);
            $('#country').text(country.toUpperCase());
            if(gender == 'male') {
                $('.svg').html(malesvg);
            } else {
                $('.svg').html(femalesvg);
            }
            let id = $(this).data('id');
            $('.username').text(name);
            $('#receiver_id').val(id);

            $.ajax({
                type: "GET",
                url: `/get/messages/${id}`,
                data:id,
                success: function(response) {
                   console.log(response);
                   displayMessages(response);
                   $('#age').val(response.age);

                }


            });
        });

        // function displayMessages(response) {
        //     let messageContainer = $('#message-container');
        //     messageContainer.empty(); // Clear previous messages

        //     response.forEach(function(item) {
        //         let messageDiv = $('<div></div>').addClass('flex items-center');
        //         let messageContent = `
        //             <div class="flex flex-col
        //              `+ (item.sender_id == auth ? 'float-end' : '')  +`">
        //              <span class="font-bold name

        //              ">
        //              `+
        //              (item.sender_id == auth ? 'You' : name)
        //              + `

        //              :
        //                     </span> <!-- Replace with actual user name if available -->
        //                 <span class="message

        //                 ">${item.message}</span>
        //             </div>
        //             <br>
        //         `;
        //         messageDiv.html(messageContent);
        //         messageContainer.append(messageDiv);
        //     });
        // }
        function displayMessages(response) {
    let messageContainer = $('#message-container');
    messageContainer.empty(); // Clear previous messages

    let chatHistory = $('<div></div>').addClass('chat-history');
    let chatList = $('<ul></ul>').addClass('m-b-0');

    response.forEach(function(item) {
        let chatItem = $('<li></li>').addClass('clearfix');
        let messageDiv = $('<div></div>').addClass('message');

        if (item.sender_id == auth) {
            messageDiv.addClass('other-message float-right').css('max-width', '60%').text(item.message);
        } else {
            messageDiv.addClass('my-message left-message').css('max-width', '60%').text(item.message);
        }

        chatItem.append(messageDiv);
        chatList.append(chatItem);
    });

    chatHistory.append(chatList);
    messageContainer.append(chatHistory);
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

    let chatHistory = $('<div></div>').addClass('chat-history');
    let chatList = $('<ul></ul>').addClass('m-b-0');

    messages.forEach(function(item) {
        let chatItem = $('<li></li>').addClass('clearfix');
        let messageDiv = $('<div></div>').addClass('message');

        if (item.sender_id == auth) {
            messageDiv.addClass('other-message float-right').css('max-width', '60%').text(item.message);
        } else {
            messageDiv.addClass('my-message left-message').css('max-width', '60%').text(item.message);
        }

        chatItem.append(messageDiv);
        chatList.append(chatItem);
    });

    chatHistory.append(chatList);
    messageContainer.append(chatHistory);

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
                    if(count == 0){
                        $('.count').text('');

                    }else{
                        $('.count').text(count);
                    }
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
        setInterval(function() {
            $('.chat-list').load(location.href+' .chat-list');
            // $("#tablerow").load(location.href+' #tablerow');
        },15000);
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
