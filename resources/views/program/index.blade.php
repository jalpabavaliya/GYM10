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
            <div class="col-lg-12 margin-tb">
                <div class="modal fade" id="programmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Programs</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {!! Form::open(['route' => 'programs.store', 'method' => 'POST']) !!}
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="program_id" id="program_id" value="">
                                    <div class="col-xs-6 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Program Name:</strong>
                                            <input type="text" id="name" name="name"
                                                class="form-group form-control" placeholder="Program Name" required />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Program Type:</strong>
                                            <select id="program_type" name="program_type" class="form-group form-control"
                                                required>
                                                <option value="1">Phased training program</option>
                                                <option value="2">On-demand Workout library</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Phases:</strong>
                                            <input type="text" id="phase" name="phase"
                                                class="form-group form-control" placeholder="Phase" required />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Weeks:</strong>
                                            <input type="text" id="week" name="week"
                                                class="form-group form-control" placeholder="Week" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Programs Management</h4>
                        <div>
                            {{-- @can('food-create') --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#programmodal">
                                Create New
                            </button>
                            {{-- @endcan --}}
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table data-table table-hover">
                            <thead style="background: #F5F7FF;">
                                <tr>
                                    <th>No</th>
                                    <th>Program Name</th>
                                    {{-- <th>Program Type</th> --}}
                                    <th>Phases</th>
                                    <th>Weeks</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('programs.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    // {
                    //     data: "program_type",
                    //     render: function(data, type, row, meta) {
                    //         if (type === 'display') {
                    //             if (data === '1') {
                    //                 data = '<p>On-demand Workout library</p>';
                    //             } else if (data === '2') {
                    //                 data = '<p>Phased training program</p>';
                    //             }
                    //             return data;
                    //         }
                    //     }
                    // },
                    {
                        data: 'phase',
                        name: 'phase'
                    },
                    {
                        data: 'week',
                        name: 'week'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


            $('body').on('click', '.editprogram', function() {
                var program_id = $(this).data('id');

                $.get("{{ url('programs') }}" + '/' + 'edit/' + program_id, function(
                    data) {
                    $('#programmodal').modal('show');
                    $('#program_id').val(data.id);
                    $('#name').val(data.name);
                    $('#program_type').val(data.program_type);
                    $('#phase').val(data.phase);
                    $('#week').val(data.week);
                })
            });
        });
    </script>
@endsection
