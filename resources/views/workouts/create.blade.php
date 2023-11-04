@extends('layouts.header')
@section('sidebar')
    <style>
        /* Style for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-70%, -70%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        /* Style for the overlay background */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        .scrollable-div {
            width: 885px;
            height: 500px;
            /* Adjust the height as needed */
            margin-left: 115px;
            overflow: auto;
            /* This will add scrollbars when content overflows */
            border: 1px solid #ccc;
            /* Optional: Add a border for styling */
        }
    </style>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('home') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    @can('role-list')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('roles') }}">
                <i class="fa-solid fa-users-gear menu-icon"></i>
                <span class="menu-title">Role Management</span>
            </a>
        </li>
    @endcan
    @can('user-list')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('users') }}">
                <i class="icon-head  menu-icon"></i>
                <span class="menu-title">User Management</span>
            </a>
        </li>
    @endcan
    <li class="nav-item">
        <a class="nav-link" href="{{ url('chatify') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Chat</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Master Libraries</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic1">
            <ul class="nav flex-column sub-menu"><b>FITNESS</b>
                @can('exercise-list')
                    <li class="nav-item"> <a class="nav-link" href="{{ url('exercises') }}">Exercises</a></li>
                @endcan
                @can('workout-list')
                    <li class="nav-item"> <a class="nav-link" href="{{ url('workouts') }}">Workouts</a></li>
                @endcan
            </ul>
            <ul class="nav flex-column sub-menu"><b>NUTRITION</b>
                @can('meal-category-list')
                    <li class="nav-item"> <a class="nav-link" href="{{ url('meal-category') }}">Meals Categories</a></li>
                @endcan
                @can('meal-list')
                    <li class="nav-item"> <a class="nav-link" href="{{ url('meal') }}">Meals</a></li>
                @endcan
                @can('food-list')
                    <li class="nav-item"> <a class="nav-link" href="{{ url('food') }}">Foods</a></li>
                @endcan
            </ul>
        </div>
    </li>
    @can('assignWorkout-list')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('assignWorkout') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Assign Workouts</span>
            </a>
        </li>
    @endcan
    @can('assignMeal-list')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('assignMeal') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Assign Meal</span>
            </a>
        </li>
    @endcan
    @can('postureimage-list')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('postureimage') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Posture Image</span>
            </a>
        </li>
    @endcan
    @can('subscription-list')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('subscription') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Subscription</span>
            </a>
        </li>
    @endcan
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Workouts Form</h3>
                    </div>
                    {!! Form::open(['route' => 'workouts.store', 'method' => 'POST']) !!}
                    <div class="card-body">
                        <div id="Workouts-form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <strong>WorkOut Name:</strong>
                                        {!! Form::text('name', null, ['placeholder' => 'WorkOut Name', 'class' => 'form-control']) !!}
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <strong>Workout Type:</strong>
                                        <select name="workout_type" class="form-control" required>
                                            <option value="">Please Select Workout Type</option>
                                            <option value="1">Regular</option>
                                            <option value="2">Circuit</option>
                                            <option value="3">Interval</option>
                                            <option value="4">Video</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Exercie Tags:</strong>
                                        <input type="button" onclick="openPopup()" name="Open" value="Exercise"
                                            class="form-group form-control">
                                    </div>
                                </div>
                                <div class="popup scrollable-div" id="popup">
                                    <h2><b>Manage Exercise Tags</b></h2><br>
                                    <div class="row">
                                        <?php $exercises = App\Models\Exercise::get(); ?>
                                        @foreach ($exercises as $exercise)
                                            <div class="col-4">
                                                <label><input class="text-break" type="checkbox" name="exercise[]"
                                                        value="{{ $exercise->id }}"> {{ $exercise->title }}</label><br>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div style=" position: absolute; bottom: 9px; right: 15px;">
                                        <input type="button" class="btn btn-secondary" onclick="closePopup()"
                                            name="Close" value="Close">
                                    </div>
                                </div>
                                <div class="overlay" id="overlay"></div>

                                <div class="col-xs-6 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Estimate Time:</strong>
                                        <input type="date" name="estimate_time" class="form-control">
                                        <small class="text-danger">{{ $errors->first('estimate_time') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{-- <div class="col-md-12" style="padding-top: 20px"> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('workouts.index') }}"> Back</a>
                        {{-- </div> --}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to open the popup
        function openPopup() {
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>

    <script>
        function embedVideo() {
            const youtubeUrl = document.getElementById("youtube-url").value;
            const videoContainer = document.getElementById("video-container");

            if (isValidYouTubeUrl(youtubeUrl)) {
                const videoId = extractVideoId(youtubeUrl);
                const embedCode =
                    `<iframe width="350" height="250" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                videoContainer.innerHTML = embedCode;
            }
        }

        function isValidYouTubeUrl(url) {
            // Regular expression to match YouTube video URLs
            const regex = /^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/;
            return regex.test(url);
        }

        function extractVideoId(url) {
            const match = url.match(/[?&]v=([^&]+)/);
            return match ? match[1] : null;
        }
    </script>
@endsection
