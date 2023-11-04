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
        <li class="nav-item active">
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
    <li class="nav-item">
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
                        <h3>User Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>First Name:</strong>
                                    <input type="text" class="form-group form-control" value="{{ $user->name }}"
                                        placeholder="First Name" readonly />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Last Name:</strong>
                                    <input type="text" class="form-group form-control" value="{{ $user->last_name }}"
                                        placeholder="Last Name" readonly />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Mobile Number:</strong>
                                    <input type="text" class="form-group form-control" value="{{ $user->mobile_no }}"
                                        placeholder="Mobile Number" readonly />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="text" class="form-group form-control" value="{{ $user->email }}"
                                        placeholder="Email" readonly />
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <strong>Gender :</strong>
                                    @if ($user->gender == null)
                                        <input type="text" class="form-group form-control" value="Null" readonly>
                                    @elseif ($user->gender == 0)
                                        <input type="text" class="form-group form-control" value="Male" readonly>
                                    @elseif ($user->gender == 1)
                                        <input type="text" class="form-group form-control" value="Female" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Date of Birth :</strong>
                                    <input type="text" class="form-group form-control"
                                        value="{{ $user->date_of_birth }}" placeholder="Date of Birth" readonly />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Heart Rate :</strong>
                                    <input type="text" class="form-group form-control"
                                        value="{{ $user->heart_rate }}" placeholder="Heart Rate" readonly />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Weight :</strong>
                                    <input type="text" class="form-group form-control" value="{{ $user->weight }}"
                                        placeholder="Weight" readonly />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Height :</strong>
                                    <input type="text" class="form-group form-control" value="{{ $user->height }}"
                                        placeholder="Height" readonly />
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <strong>Goal :</strong>
                                    <input type="text" class="form-group form-control" value="Null" readonly>
                                    {{-- @if ($user->gender == null)
                                    @elseif ($user->gender == 0)
                                        <input type="text" class="form-group form-control" value="Male" readonly>
                                    @elseif ($user->gender == 1)
                                        <input type="text" class="form-group form-control" value="Female" readonly>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
