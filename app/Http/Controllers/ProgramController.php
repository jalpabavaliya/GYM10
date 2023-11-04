<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramWorkout;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function index()
    {
        return view('program.index');
    }

    public function getProgram(Request $request)
    {
        if ($request->ajax()) {
            $data = Program::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    // if (Auth::user()->can('food-edit')) {
                        $action = '<a href="' . route("programs.workout", $row->id) . '"><i class="fa-solid fa-circle-plus p-2 rounded border"></i></a>';
                    // $action .= '<a href="javascript:void(0)" data-id="'.$row->id.'"><i class="editfood fa fa-pencil aria-hidden="true""></i></a>';
                    $action .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="tooltip" class="editprogram" data-id="' . $row->id . '"><i class="fa fa-pencil p-2 rounded border"></i></a>';
                    // }
                    // if (Auth::user()->can('food-delete')) {
                    $action .= '&nbsp;&nbsp;&nbsp;<a href="' . route("programs.destroy", $row->id) . '"><i class="fa fa-trash p-2 rounded border"></i></a>';
                    // }

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'program_type' => 'required',
            'phase' => 'required',
            'week' => 'required',
        ]);
        $data = $request->input();
        $ins = array(
            'name' => $data['name'] ? $data['name'] : null,
            'program_type' => $data['program_type'] ? $data['program_type'] : null,
            'phase' => $data['phase'] ? $data['phase'] : '0',
            'week' => $data['week'] ? $data['week'] : '0',
        );

        if (!empty($data['program_id'])) {
            Program::where('id', $data['program_id'])->update($ins);
            return redirect()->route('programs.index')->with('success', 'Program Updated successfully');
        } else {
            Program::create($ins)->id;
            return redirect()->route('programs.index')->with('success', 'Program created successfully');
        }
    }


    public function edit($id)
    {
        $program = Program::where('id', $id)->orderBy('id', 'DESC')->first();
        return response()->json($program);
    }

    public function destroy($id)
    {
        DB::table("programs")->where('id', $id)->delete();
        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully');
    }

    public function workout($id) {

        $proworkouts = ProgramWorkout::get();

        return view('program.workout', compact('id'));
    }

    public function add(Request $request) {

        $this->validate($request, [
            'workout_id' => 'required',
        ]);
        ProgramWorkout::create([
            'program_id' => $request->input('program_id'),
            'workout_id' => $request->input('workout_id')
        ]);
        return redirect()->back()
                        ->with('success','Workout Add successfully');

    }
}
