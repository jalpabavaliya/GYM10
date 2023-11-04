<?php

namespace App\Http\Controllers;

use App\Models\AssignWorkout;
use App\Models\WorkOut;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class AssignWorkoutController extends Controller
{
    public function index() {
        return view('assignWorkout.index');
    }

    public function getAssignWorkout(Request $request)
    {
        if ($request->ajax()) {
            $data = WorkOut::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if(Auth::user()->can('assignWorkout-create')){
                            $action = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="tooltip" class="editassignworkout" data-id="'.$row->id.'"><i class="fa fa-home p-2 rounded border"></i></a>';
                    }
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        if($request->user_id){
            $users = $request->user_id;

            foreach($users as $user) {
                AssignWorkout::create([
                    'workout_id' => $request->input('workout_id'),
                    'user_id' => $user,
                ]);
            }
            return redirect()->route('assignWorkout.index')->with('success','Workout To User Assign Successfully');
        } else {
            return redirect()->route('assignWorkout.index');
        }

    }

    public function edit($id) {
        $assignworkout = WorkOut::where('id', $id)->orderBy('id', 'DESC')->first();
        return response()->json($assignworkout);
    }
}
