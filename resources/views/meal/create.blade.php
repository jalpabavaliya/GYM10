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
    {{-- <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Create New Category</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('meal-category.index') }}"> Back</a>
                </div>
            </div>
        </div>
        <br>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {!! Form::open(['route' => 'meal-category.store', 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <strong>meal_categories_id:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div> --}}


    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Meals</h3>
                    </div>
                    {!! Form::open(['route' => 'meal.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="meal_id" id="meal_id" value="">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <strong>Meal Name:</strong>
                                    <input type="text" id="meal_name" name="meal_name" class="form-control"
                                        placeholder="Meal Name" />
                                        <small class="text-danger">{{ $errors->first('meal_name') }}</small>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <strong>Meal Prep Time:</strong>
                                    <select id="prep_time" name="prep_time" class="form-group form-control" required>
                                        <option value="1">5min</option>
                                        <option value="2">10min</option>
                                        <option value="3">15min</option>
                                        <option value="4">20min</option>
                                        <option value="5">25min</option>
                                        <option value="6">30min</option>
                                        <option value="7">35min</option>
                                        <option value="8">40min</option>
                                        <option value="9">45min</option>
                                        <option value="10">50min</option>
                                        <option value="11">55min</option>
                                        <option value="12">60min</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <strong>Meal Cook Time:</strong>
                                    <select id="cook_time" name="cook_time" class="form-group form-control" required>
                                        <option value="1">5min</option>
                                        <option value="2">10min</option>
                                        <option value="3">15min</option>
                                        <option value="4">20min</option>
                                        <option value="5">25min</option>
                                        <option value="6">30min</option>
                                        <option value="7">35min</option>
                                        <option value="8">40min</option>
                                        <option value="9">45min</option>
                                        <option value="10">50min</option>
                                        <option value="11">55min</option>
                                        <option value="12">60min</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <strong>Suitable For:</strong>
                                {{-- <div class="col-3">
                                    <label><input type="checkbox" name="meal_categories_id[]"
                                            name="meal_categories_id[]" value="{{ $cat->id }}">
                                        {{ $cat->name }}</label>
                                </div> --}}
                                <div class="row">
                                    <?php $category = App\Models\MealCategories::get(); ?>
                                    <select id="meal_categories_id" name="meal_categories_id"
                                        class="form-group form-control" required>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <strong>Tags:</strong>
                                <div class="row">
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="1">
                                            Paleo</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="2">
                                            High fiber</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="3">
                                            One pot</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="4">
                                            Instant pot</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="5">
                                            Slow cooker</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="6">
                                            Salad</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="7">
                                            Soup</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="8">
                                            Smoothie</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="9">
                                            Simple meals</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]" value="10">
                                            No cooking</label></div>
                                </div>
                            </div>

                            <div class="col-12">
                                <strong>Contains:</strong>
                                <div class="row">
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="1">
                                            Meat</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="2">
                                            Fish</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="3">
                                            Shellfish</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="4">
                                            Soy</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="5">
                                            Tree nuts</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="6">
                                            Eggs</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="7">
                                            Dairy</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="8">
                                            Gluten</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]" value="9">
                                            Peanuts</label></div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="image">Image </label>
                                <div class="row">
                                    <div class="col-md-8">

                                        <input type="file" name="image" id="customFileEg1"
                                            class="custom-file-input form-group form-control">

                                        <label class="custom-file-label" for="customFileEg1">{{ 'choose' }}
                                            {{ 'file' }}</label>

                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom:0%;">
                                    <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer"
                                            @if (isset($meal)) src="{{ asset('image') }}/{{ $meal['image'] }}"
                                                 @else
                                                src="{{ asset('images/picture.jpg') }}" @endif
                                            alt="image" />
                                    </center>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input type="button" name="btn" id="add_Row" value="Add New"
                                    class="btn btn-primary" style="margin-left: 93%" />
                                <table class="table data-table table-striped dataTable no-footer" id="DataTables_Table_0"
                                    role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr>
                                            <th>Food Name</th>
                                            <th>Serving Type</th>
                                            <th>Calary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="default_row">
                                            <td>
                                                <select id="fooddropdown-1" name="food_id[]"
                                                    class="form-control food select2" required>
                                                    @foreach ($foods as $food)
                                                        <option value="{{ $food->id }}">
                                                            {{ $food->food_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select id="serving_type-1" name="serving_type[]"
                                                    style="margin: inherit;" class="form-group form-control serving_type"
                                                    required>
                                                    <option value="1">g</option>
                                                    <option value="2">oz</option>
                                                    <option value="3">lbs</option>
                                                    <option value="4">ml</option>
                                                    <option value="5">cup</option>
                                                    <option value="6">fl oz</option>
                                                    <option value="7">tsp</option>
                                                    <option value="8">tbsp</option>
                                                    <option value="9">custom</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="calary[]" class="calories form-control"
                                                    id="calary-1" placeholder="{{ 'Calary' }}" value=""
                                                    required>
                                            </td>
                                            <td><button type="button"
                                                    class="btnDelete fa fa-close btn-close mt-1"></button></td>
                                        </tr>
                                    </tbody>
                                </table><br>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('meal.index') }}"> Back</a>
                    </div>
                    <input type="hidden" id="hidden_product_id" />
                    <input type="hidden" id="hidden_val" value="1" />
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>


    <script>
        $(".select2").select2();
        $(document).ready(function() {
            $('#add_Row').on('click', function() {
                hidden_val = $('#hidden_val').val();
                hidden_val = parseFloat(hidden_val) + 1;
                $('#hidden_val').val(hidden_val);
                $.ajax({
                    url: "{{ url('meal/fetch') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        drop = '';
                        $.each(res, function(key, value) {
                            drop = drop + '<option value="' + value.id + '">' + value
                                .food_name + '</option>';
                        });
                        $("tbody").append(
                            '<tr class="default_row"><td><select id="fooddropdown-' +
                            hidden_val +
                            '" name="food_id[]" class="form-control food select2" required>@foreach ($foods as $food)<option value="{{ $food->id }}">{{ $food->food_name }}</option>@endforeach</select></td><td><select id="serving_type-' +
                            hidden_val +
                            '" name="serving_type[]" style="margin: inherit;" class="form-group form-control serving_type" required><option value="1">g</option><option value="2">oz</option><option value="3">lbs</option><option value="4">ml</option><option value="5">cup</option><option value="6">fl oz</option><option value="7">tsp</option><option value="8">tbsp</option><option value="9">custom</option></select></td><td><input type="text" name="calary[]" class="calories form-control" id="calary-' +
                            hidden_val +
                            '" placeholder="{{ 'Calary' }}" value="" required></td><td><button type="button" class="btnDelete fa fa-close btn-close mt-1"></button></td></tr>'
                        );
                    }
                });
            });

            $(document).on('click', '.btnDelete', function() {
                $(this).parents('tr').remove();
            });

            $('body').on('change', 'select[name^="food_id"]', function() {

                var hidden = $('#hidden_val').val();
                food_id = $(this).val();
                $.ajax({
                    url: "{{ url('meal/getlist') }}",
                    type: "GET",
                    data: {
                        food_id: food_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.food) {
                            $.each(res.food, function(key, value) {
                                if (value.serving_type) {
                                    inputValue = value.serving_type;
                                    $('#serving_type-' + hidden).val(value
                                        .serving_type);
                                }
                                if (value.calories) {
                                    $('#calary-' + hidden).val(value.calories);
                                }
                            });
                        }
                    }
                });
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#viewer').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#customFileEg1").change(function() {
                readURL(this);
            });
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('#add_size_row_btn').addEventListener('click', function() {
                    add_size_row();
                });
            });
        });
    </script>
@endsection
