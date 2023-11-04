<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkOut;

class WorkOutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $workouts = WorkOut::orderBy('id','DESC')->paginate(5);
                return view('workouts.index',compact('workouts'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function getWorkouts(Request $request)
    {
        if ($request->ajax()) {
            $data = WorkOut::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if(Auth::user()->can('workout-edit')){
                            $action .= '<a href="'.route("workouts.edit",$row->id).'"><i class="fa fa-pencil p-2 rounded border aria-hidden="true""></i></a>';
                    }
                    if(Auth::user()->can('workout-delete')){
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="'.route("workouts.destroy",$row->id).'"><i class="p-2 rounded border fa fa-trash"></i></a>';
                    }
                    return $action ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = WorkOut::get();
        return view('workouts.create',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'workout_type' => 'required',
            'estimate_time' => 'required',
        ]);
        WorkOut::create(
            [
                'name' => $request->input('name'),
                'workout_type' => $request->input('workout_type'),
                'total_exercise' => isset($request->exercise) ? implode(",",$request->exercise) : '',
                'est_time' => $request->input('estimate_time'),
            ]
        );
        return redirect()->route('workouts.index')
                        ->with('success','Workouts created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workouts = WorkOut::find($id);
        return view('workouts.show',compact('workouts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workouts = WorkOut::find($id);
        $workouts->total_exercise = explode(',',$workouts->total_exercise);
        $exercise = Exercise::get();
        return view('workouts.edit',compact('workouts','exercise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'workout_type' => 'required',
            'estimate_time' => 'required',
        ]);

        $workouts = WorkOut::find($id);
        $workouts->name = $request->input('name');
        $workouts->workout_type = $request->input('workout_type');
        $workouts->total_exercise = isset($request->exercise) ? implode(",",$request->exercise) : '';
        $workouts->est_time = $request->input('estimate_time');
        $workouts->save();
        return redirect()->route('workouts.index')
                        ->with('success','Workouts updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("work_outs")->where('id',$id)->delete();
        return redirect()->route('workouts.index')
                        ->with('success','Workouts deleted successfully');
    }
}
