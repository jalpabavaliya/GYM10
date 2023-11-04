@extends('layouts.header')
@section('sidebar')
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
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Workouts</h4>
                        <div>
                            {{-- @can('meal-create')
                                <a class="btn btn-success" href="{{ route('meal.create') }}">Create New</a>
                            @endcan --}}


                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pworkoutmodal">
                                Create New
                            </button>

                            <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <div class="modal fade" id="pworkoutmodal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Program Workouts</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                {!! Form::open(['route' => 'programs.add', 'method' => 'POST']) !!}
                                                <div class="modal-body">
                                                    {{-- <input type="hidden" name="program_id" id="program_id"
                                                            value=""> --}}
                                                    <input type="hidden" name="program_id" value="{{ $id }}">
                                                    {{-- <div class="row">
                                                        <?php $workouts = App\Models\Workout::get(); ?>
                                                        @foreach ($workouts as $workout)
                                                            <div class="col-4">
                                                                <label><input class="text-break" type="checkbox"
                                                                        name="workout[]" value="{{ $workout->id }}">
                                                                    {{ $workout->name }}</label><br>
                                                            </div>
                                                        @endforeach
                                                    </div> --}}

                                                    <div class="row">
                                                        <?php $workouts = App\Models\Workout::get(); ?>
                                                        <select id="workout_id" name="workout_id"
                                                            class="form-group form-control select2" style="width: 100%;"
                                                            required>
                                                            @foreach ($workouts as $workout)
                                                                <option value="{{ $workout->id }}">{{ $workout->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- @foreach ($meals as $key => $meal)
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 px-3">
                                <div class="card ">
                                    <div><img src="{{ asset('image') }}/{{ $meal->image }}" width="362"
                                            height="200"></div>
                                    <div class="card-body border" style="padding: 11px !important;">
                                        <div class="d-flex justify-content-end gap-2">
                                            @can('meal-edit')
                                                <a class="editmeal" href="{{ route('meal.edit', ['id' => $meal->id]) }}"><i
                                                        class="fa fa-pencil p-2 rounded border aria-hidden="
                                                        style="margin-right: 10px;"></i></a>
                                            @endcan
                                            @can('meal-delete')
                                                <a href="{{ route('meal.destroy', ['id' => $meal->id]) }}"><i
                                                        class="fa fa-trash p-2 rounded border"></i></a>
                                            @endcan

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("select").select2({
                dropdownParent: $("#pworkoutmodal")
            });
            $('[data-toggle=offcanvas]').click(function() {
                $('.row-offcanvas').toggleClass('active');
            });
        });
    </script>
@endsection
