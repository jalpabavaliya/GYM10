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
        <li class="nav-item active">
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
                <div class="modal fade" id="subscriptionmodal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {!! Form::open(['route' => 'subscription.store', 'method' => 'POST']) !!}
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="subscription_id" id="subscription_id" value="">
                                    <div class="col-xs-6 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Start Date:</strong>
                                            <input type="date" id="start_date" name="start_date"
                                                class="form-group form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>End Date:</strong>
                                            <input type="date" id="end_date" name="end_date"
                                                class="form-group form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Subscription Type:</strong><br>
                                            <input type="radio" name="sub_type" value="0" checked> Monthly <br>
                                            <input type="radio" name="sub_type" value="1"> Yearly
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Status:</strong><br>
                                            <input type="radio" name="status" value="0" checked> Active <br>
                                            <input type="radio" name="status" value="1"> Expired
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Amount:</strong>
                                            <input type="number" id="amount" name="amount"
                                                class="form-group form-control" required />
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
                        <h4>Subscription</h4>
                        <div>
                            @can('subscription-create')
                                {{-- <a class="btn btn-success" href="{{ route('workouts.create') }}"> Create New</a> --}}
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#subscriptionmodal">
                                    Add New
                                </button>
                            @endcan
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
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Subscription</th>
                                    <th>Amount</th>
                                    <th>Status</th>
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
                ajax: "{{ route('subscription.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'sub_type',
                        name: 'sub_type',
                        mRender: function(data, type, full) {
                            if (data == 0) {
                                return '<span class="label label-default">Monthly</span>';
                            } else if (data == 1) {
                                return '<span class="label label-default">Yearly</span>';
                            }
                        }
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        mRender: function(data, type, full) {
                            if (data == 0) {
                                return '<span class="label label-default">Active</span>';
                            } else if (data == 1) {
                                return '<span class="label label-default">Expired</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


            $('body').on('click', '.editsubscription', function() {
                var subscription_id = $(this).data('id');

                $.get("{{ url('subscription') }}" + '/' + 'edit/' + subscription_id, function(
                    data) {
                    $('#subscriptionmodal').modal('show');
                    $('#subscription_id').val(data.id);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                    $('#amount').val(data.amount);
                    $('input[name^="sub_type"][value="' + data.sub_type + '"').prop('checked',
                        true);
                    $('input[name^="status"][value="' + data.status + '"').prop('checked', true);

                })
            });
        });
    </script>
    <style>
        @media (min-width: 1200px) {
            .modal-xl {
                max-width: 750px !important;
            }
        }
    </style>
@endsection
