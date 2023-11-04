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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Meal Form</h3>
                    </div>
                    {!! Form::model($meal, [
                        'method' => 'PATCH',
                        'route' => ['meal.update', $meal->id],
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    <div class="card-body">
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
                        <div class="row">
                            <input type="hidden" name="meal_id" id="meal_id" value="">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <strong>Meal Name:</strong>
                                    <input type="text" value="{{ $meal->meal_name }}" name="meal_name"
                                        class="form-group form-control" placeholder="Meal Name" required />
                                        <small class="text-danger">{{ $errors->first('meal_name') }}</small>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <strong>Meal Prep Time:</strong>
                                    <select name="prep_time" class="form-group form-control" required>
                                        <option value="1" {{ $meal->prep_time == 1 ? 'selected' : '' }}>5min</option>
                                        <option value="2" {{ $meal->prep_time == 2 ? 'selected' : '' }}>10min</option>
                                        <option value="3" {{ $meal->prep_time == 3 ? 'selected' : '' }}>15min</option>
                                        <option value="4" {{ $meal->prep_time == 4 ? 'selected' : '' }}>20min</option>
                                        <option value="5" {{ $meal->prep_time == 5 ? 'selected' : '' }}>25min</option>
                                        <option value="6" {{ $meal->prep_time == 6 ? 'selected' : '' }}>30min</option>
                                        <option value="7" {{ $meal->prep_time == 7 ? 'selected' : '' }}>35min</option>
                                        <option value="8" {{ $meal->prep_time == 8 ? 'selected' : '' }}>40min</option>
                                        <option value="9" {{ $meal->prep_time == 9 ? 'selected' : '' }}>45min</option>
                                        <option value="10" {{ $meal->prep_time == 10 ? 'selected' : '' }}>50min
                                        </option>
                                        <option value="11" {{ $meal->prep_time == 11 ? 'selected' : '' }}>55min
                                        </option>
                                        <option value="12" {{ $meal->prep_time == 12 ? 'selected' : '' }}>60min
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <strong>Meal Cook Time:</strong>
                                    <select name="cook_time" class="form-group form-control" required>
                                        <option value="1" {{ $meal->cook_time == 1 ? 'selected' : '' }}>5min</option>
                                        <option value="2" {{ $meal->cook_time == 2 ? 'selected' : '' }}>10min
                                        </option>
                                        <option value="3" {{ $meal->cook_time == 3 ? 'selected' : '' }}>15min
                                        </option>
                                        <option value="4" {{ $meal->cook_time == 4 ? 'selected' : '' }}>20min
                                        </option>
                                        <option value="5" {{ $meal->cook_time == 5 ? 'selected' : '' }}>25min
                                        </option>
                                        <option value="6" {{ $meal->cook_time == 6 ? 'selected' : '' }}>30min
                                        </option>
                                        <option value="7" {{ $meal->cook_time == 7 ? 'selected' : '' }}>35min
                                        </option>
                                        <option value="8" {{ $meal->cook_time == 8 ? 'selected' : '' }}>40min
                                        </option>
                                        <option value="9" {{ $meal->cook_time == 9 ? 'selected' : '' }}>45min
                                        </option>
                                        <option value="10" {{ $meal->cook_time == 10 ? 'selected' : '' }}>50min
                                        </option>
                                        <option value="11" {{ $meal->cook_time == 11 ? 'selected' : '' }}>55min
                                        </option>
                                        <option value="12" {{ $meal->cook_time == 12 ? 'selected' : '' }}>60min
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <strong>Suitable For:</strong>
                                <div class="row">

                                    <?php $category = App\Models\MealCategories::get(); ?>
                                    <select name="meal_categories_id" class="form-group form-control" required>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $meal->meal_categories_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
                                        @endforeach
                                    </select>



                                    {{-- <div class="col-3">
                                            {{-- {{ $cat->id }}
                                            <label><input type="checkbox" name="meal_categories_id[]"
                                                    {{ in_array($cat->id, $meal->meal_categories_id) ? 'checked' : '' }}
                                                    value="{{ $cat->id }}">{{ $cat->name }}</label>
                                        </div> --}}
                                </div>
                            </div>

                            <div class="col-12">
                                <strong>Tags:</strong>
                                <div class="row">
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('1', $meal->tag) ? 'checked' : '' }} value="1">
                                            Paleo</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('2', $meal->tag) ? 'checked' : '' }} value="2">
                                            High fiber</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('3', $meal->tag) ? 'checked' : '' }} value="3">
                                            One pot</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('4', $meal->tag) ? 'checked' : '' }} value="4">
                                            Instant pot</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('5', $meal->tag) ? 'checked' : '' }} value="5">
                                            Slow cooker</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('6', $meal->tag) ? 'checked' : '' }} value="6">
                                            Salad</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('7', $meal->tag) ? 'checked' : '' }} value="7">
                                            Soup</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('8', $meal->tag) ? 'checked' : '' }} value="8">
                                            Smoothie</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('9', $meal->tag) ? 'checked' : '' }} value="9">
                                            Simple meals</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                {{ in_array('10', $meal->tag) ? 'checked' : '' }} value="10">
                                            No cooking</label></div>
                                </div>
                            </div>

                            <div class="col-12">
                                <strong>Contains:</strong>
                                <div class="row">
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('1', $meal->contain) ? 'checked' : '' }} value="1">
                                            Meat</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('2', $meal->contain) ? 'checked' : '' }} value="2">
                                            Fish</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('3', $meal->contain) ? 'checked' : '' }} value="3">
                                            Shellfish</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('4', $meal->contain) ? 'checked' : '' }} value="4">
                                            Soy</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('5', $meal->contain) ? 'checked' : '' }} value="5">
                                            Tree nuts</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('6', $meal->contain) ? 'checked' : '' }} value="6">
                                            Eggs</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('7', $meal->contain) ? 'checked' : '' }} value="7">
                                            Dairy</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('8', $meal->contain) ? 'checked' : '' }} value="8">
                                            Gluten</label></div>
                                    <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                {{ in_array('9', $meal->contain) ? 'checked' : '' }} value="9">
                                            Peanuts</label></div>
                                </div>
                            </div>

                            <div class="col-12">
                                {{-- <label for="image">Image </label> --}}
                                <strong>Image:</strong>

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
                                {{-- <input type="button" name="btn" id="add_Row" value="Add New"
                                    class="btn btn-primary" style="margin-left: 93%" /> --}}
                                <table class="table data-table table-striped dataTable no-footer" id="DataTables_Table_0"
                                    role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr>
                                            <th>Food Name</th>
                                            <th>Serving Type</th>
                                            <th>Calary</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mealfood as $key => $mfood)
                                            <tr class="default_row">
                                                {{-- <input type="text" value="{{ $key }}" class="key"> --}}
                                                <td>
                                                    <select id="fooddropdown-{{ ++$key }}" name="food_id[]"
                                                        class="form-control food select2" required disabled>
                                                        @foreach ($foods as $food)
                                                            <option value="{{ $food->id }}"
                                                                {{ $mfood->food_id == $food->id ? 'selected' : '' }}>
                                                                {{ $food->food_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="serving_type-{{ ++$key }}" name="serving_type[]"
                                                        style="margin: inherit;"
                                                        class="form-group form-control serving_type" required disabled>
                                                        <option value="1"
                                                            {{ $mfood->serving_type == '1' ? 'selected' : '' }}>g</option>
                                                        <option value="2"
                                                            {{ $mfood->serving_type == '2' ? 'selected' : '' }}>oz</option>
                                                        <option value="3"
                                                            {{ $mfood->serving_type == '3' ? 'selected' : '' }}>lbs
                                                        </option>
                                                        <option value="4"
                                                            {{ $mfood->serving_type == '4' ? 'selected' : '' }}>ml</option>
                                                        <option value="5"
                                                            {{ $mfood->serving_type == '5' ? 'selected' : '' }}>cup
                                                        </option>
                                                        <option value="6"
                                                            {{ $mfood->serving_type == '6' ? 'selected' : '' }}>fl oz
                                                        </option>
                                                        <option value="7"
                                                            {{ $mfood->serving_type == '7' ? 'selected' : '' }}>tsp
                                                        </option>
                                                        <option value="8"
                                                            {{ $mfood->serving_type == '8' ? 'selected' : '' }}>tbsp
                                                        </option>
                                                        <option value="9"
                                                            {{ $mfood->serving_type == '9' ? 'selected' : '' }}>custom
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="calary[]" class="calories form-control"
                                                        id="calary-{{ ++$key }}"
                                                        placeholder="{{ 'Calary' }}" value="{{ $mfood->calary }}"
                                                        required disabled>
                                                </td>
                                                {{-- <td><button type="button"
                                                        class="btnDelete fa fa-close btn-close mt-1"></button></td> --}}
                                            </tr>
                                        @endforeach

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
                    <input type="hidden" id="hidden_val" value="{{ $key++ }}" />
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">


    <script>
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

                console.log(hidden);
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
        });
    </script>

    <script>
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
    </script>
@endsection
