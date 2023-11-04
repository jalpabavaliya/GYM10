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
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Meal Plan</h3>
                    </div>
                    {!! Form::open(['route' => 'mealPlan.store', 'method' => 'POST']) !!}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <strong>Calories Per Day:</strong>
                                    <input type="text" id="calary" name="calary" class="form-control"
                                        placeholder="Add Value from 1400 - 4000 Cal" />
                                    <small class="text-danger">{{ $errors->first('calary') }}</small>

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <strong>Macro Split:</strong>
                                    <select id="macro_split" name="macro_split" class="form-group form-control" required>
                                        <option value="1">Balanced (30% Protein, 40% Carb, 30% Fat)</option>
                                        <option value="2">Low carb (30% Protein, 20% Carb, 50% Fat)</option>
                                        <option value="3">Low fat (50% Protein, 30% Carb, 20% Fat)</option>
                                        <option value="4">High Protein (40% Protein, 30% Carb, 30% Fat)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <strong>Meal Per Day:</strong>
                                    <select id="meal_perday" name="meal_perday" class="form-group form-control" required>
                                        <option value="1">3 meals</option>
                                        <option value="2">4 meals</option>
                                        <option value="3">5 meals</option>
                                        <option value="4">6 meals</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <strong>Number Of Sample Days:</strong>
                                    <select id="days" name="days" class="form-group form-control" required>
                                        <option value="1">3 days</option>
                                        <option value="2">6 days</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <?php $meals = App\Models\Meal::get(); ?>
                                    <strong>Dietary Preference:</strong>
                                    <select id="meal" name="meal" class="form-group form-control" required>
                                        @foreach ($meals as $meal)
                                            <option value="{{ $meal->id }}">{{ $meal->meal_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <strong>Exclude Food Sensitivities:</strong>
                                <div class="row">
                                    <div class="col-3"><label><input type="checkbox" name="sensitivity[]"
                                                value="1">
                                            Fish</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="sensitivity[]"
                                                value="2">
                                            Shellfish</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="sensitivity[]"
                                                value="3">
                                            Soy</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="sensitivity[]"
                                                value="4">
                                            Tree nuts</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="sensitivity[]"
                                                value="5">
                                            Eggs</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="sensitivity[]"
                                                value="6">
                                            Dairy</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="sensitivity[]"
                                                value="7">
                                            Gluten</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="sensitivity[]"
                                                value="8">
                                            Peanuts</label></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('mealPlan.index') }}"> Back</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
