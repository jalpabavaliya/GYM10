<?php

namespace App\Http\Controllers;

use App\Models\AssignMeal;
use App\Models\Meal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
class AssignMealController extends Controller
{
    public function index() {
        return view('assignMeal.index');
    }

    public function getAssignMeal(Request $request)
    {
        if ($request->ajax()) {
            $data = Meal::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if(Auth::user()->can('assignMeal-create')){
                            $action = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="tooltip" class="editassignmeal" data-id="'.$row->id.'"><i class="fa fa-home p-2 rounded border"></i></a>';
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
                AssignMeal::create([
                    'meal_id' => $request->input('meal_id'),
                    'user_id' => $user,
                ]);
            }
            return redirect()->route('assignMeal.index')->with('success','Meal To User Assign Successfully');
        } else {
            return redirect()->route('assignMeal.index');
        }

    }

    public function edit($id) {
        $assignmeal = Meal::where('id', $id)->orderBy('id', 'DESC')->first();
        return response()->json($assignmeal);
    }
}
