@extends('layouts.header')
@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('home') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Messages</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Groups</span>
        </a>
    </li> --}}
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
                <li class="nav-item"> <a class="nav-link" href="{{ url('programs') }}">Programs</a></li>
                {{-- @can('workout-list')
                @endcan --}}
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
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('mealPlan') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Meal Plan</span>
        </a>
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
    <li class="nav-item">
        <a class="nav-link" href="{{ url('calendar') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Calendar</span>
        </a>
    </li>
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
                        <h4>Meal Plan</h4>
                        <div>
                            @can('meal-create')
                                <a class="btn btn-success" href="{{ route('mealPlan.create') }}"> Create New</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($mealplans as $mp)
                                {{ $mp->id }}
                                <a class="editmeal" href="{{ route('mealPlan.edit', ['id' => $mp->id]) }}"><i
                                        class="fa fa-pencil p-2 rounded border aria-hidden="
                                        style="margin-right: 10px;"></i></a>

                                {{-- <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 px-3">
                                    <div class="card ">
                                        <div><img src="{{ asset('image') }}/{{ $meal->image }}" width="362"
                                                height="200"></div>
                                        <div class="card-body border" style="padding: 11px !important;">
                                            <div class="d-flex justify-content-end gap-2">
                                                @can('meal-edit')
                                                    <a class="editmeal"
                                                        href="{{ route('meal.edit', ['id' => $meal->id]) }}"><i
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
                                </div> --}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection