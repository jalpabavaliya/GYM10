<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Meal;
use App\CPU\ImageManager;
use App\Models\Food;
use App\Models\mealFood;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meals = Meal::orderBy('id', 'DESC')->paginate(50000000000000);
        return view('meal.index', compact('meals'))
            ->with('i', ($request->input('page', 1) - 1) * 50000000000000);
    }

    public function getMeal(Request $request)
    {
        if ($request->ajax()) {
            $data = Meal::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if (Auth::user()->can('user-edit')) {
                        // $action .= '<a href="'.route("meal.edit",$row->id).'"><i class="fa fa-pencil aria-hidden="true""></i></a>';
                        $action = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="tooltip" class="editmeal" data-id="' . $row->id . '"><i class="fa fa-pencil">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></a>';
                    }
                    if (Auth::user()->can('user-delete')) {
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="' . route("meal.destroy", $row->id) . '"><i class="fa fa-trash"></i></a>';
                    }
                    return $action;
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
        $foods = Food::get();
        return view('meal.create', compact('foods'));
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
            'meal_name' => 'required',
            'meal_categories_id' => 'required',
            'tag' => 'required',
            'contain' => 'required',
        ]);
        $data = $request->input();

        $ins = array(
            'meal_name' => $data['meal_name'] ? $data['meal_name'] : 'N/A',
            'prep_time' => $data['prep_time'] ? $data['prep_time'] : 'N/A',
            'cook_time' => $data['cook_time'] ? $data['cook_time'] : 'N/A',
            'meal_categories_id' => $data['meal_categories_id'] ? $data['meal_categories_id'] : '0',
            // 'tag' => $data['tag'] ? implode(",", $data['tag']) : '0',
            'tag' => isset($data['tag']) ? implode(",", $data['tag']) : '',
            'contain' => $data['contain'] ? implode(",", $data['contain']) : '0',
        );
        $ins['image'] = ImageManager::upload('modal/', 'png', $request->file('image'));
        $m = Meal::create($ins)->id;

        if (count($request->food_id) > 0 && count($request->calary) > 0 && count($request->serving_type)) {
            foreach ($request->food_id as $key => $food_id) {
                $ps = new mealFood;
                $ps->meal_id = $m;
                $ps->food_id = $food_id;
                $ps->calary = $request->calary[$key];
                $ps->serving_type = $request->serving_type[$key];
                $ps->save();
            }
        }


        // $prod = product::create($ins)->p_id;

        // if (count($request->link_name) > 0 && count($request->weight_percent) > 0) {
        //     foreach ($request->link_name as $key => $link_name) {
        //         $ps = new product_link;
        //         $ps->product_id = $prod;
        //         $ps->link_name = $link_name;
        //         $ps->weight_percent = $request->weight_percent[$key];
        //         $ps->save();
        //     }
        // }


        return redirect()->route('meal.index')
            ->with('success', 'Meal created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal = Meal::find($id);
        return view('meal.show', compact('meal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  public function edit($id)
    //  {
    //      $meal = Meal::where('id', $id)->orderBy('id', 'DESC')->first();
    //      return response()->json($meal);
    //  }

    public function edit($id)
    {
        $foods = Food::get();
        $meal = Meal::find($id);
        $meal->tag = explode(',', $meal->tag);
        $meal->contain = explode(',', $meal->contain);
        $mealfood = mealFood::where('meal_id', $id)->get();
        return view('meal.edit', compact('meal', 'foods', 'mealfood'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'meal_name' => 'required',
            'meal_categories_id' => 'required',
            'tag' => 'required',
            'contain' => 'required',
        ]);

        $meal = Meal::find($id);
        $meal->meal_name = $request->input('meal_name');
        $meal->prep_time = $request->input('prep_time');
        $meal->cook_time = $request->input('cook_time');
        $meal->meal_categories_id = $request->input('meal_categories_id');
        $meal->tag = isset($request->tag) ? implode(",", $request->tag) : '';
        $meal->contain = isset($request->contain) ? implode(",", $request->contain) : '';
        $meal->image =  $request->file('image') ? ImageManager::upload('modal/', 'png', $request->file('image')) : $meal->image;
        //  ImageManager::upload('modal/', 'png', $request->file('image'));
        $meal->save();


        // mealFood::where('meal_id', $id)->delete();

        // if (count($request->food_id) > 0 && count($request->calary) > 0 && count($request->serving_type)) {
        //     foreach ($request->food_id as $key => $food_id) {
        //         $ps = new mealFood;
        //         $ps->meal_id = $id;
        //         $ps->food_id = $food_id;
        //         $ps->calary = $request->calary[$key];
        //         $ps->serving_type = $request->serving_type[$key];
        //         $ps->save();
        //     }
        // }
        return redirect()->route('meal.index')
            ->with('success', 'Meal updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("meals")->where('id', $id)->delete();
        return redirect()->route('meal.index')
            ->with('success', 'Meal deleted successfully');
    }


    public function fetchallproduct()
    {
        $food = Food::get();
        return $food;
    }


    public function get_list(Request $request)
    {
        $data['food'] = Food::where('id', $request->food_id)->get(["calories", "serving_type"]);
        return response()->json($data);
        // return response()->json(['coloursize'=> $coloursize ,'getProduct' => $getProduct]);

    }
}
