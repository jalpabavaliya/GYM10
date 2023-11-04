<?php

namespace App\Http\Controllers;

use App\Models\PostureImage;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
class PostureController extends Controller
{
    public function index() {
        return view('posture.index');
    }

    public function getPosture(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = '<label class="switch"><input type="checkbox" onclick="status_change_alert('.$row->id.','.$row->status.')"><span class="slider"></span></label>';
                    return $status ;
                })
                ->addColumn('action', function ($row) {
                    // Update Button
                    $action = "";
                    if(Auth::user()->can('postureimage-show')){
                            $action .= '<a href="'.route("postureimage.edit",$row->id).'"><i class="fa fa-home border border-2  p-2 rounded aria-hidden="true""></i></a>';
                    }
                    // if(Auth::user()->can('user-delete')){
                        // $action .= '&nbsp;&nbsp;&nbsp;<a href="'.route("users.delete",$row->id).'"><i class="fa fa-trash border border-2  p-2 rounded"></i></a>';
                    // }
                    return $action ;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
    }

    public function edit($id)
    {
        $postureimages = PostureImage::where('user_id' ,$id)->get();

        // $items = PostureImage::select(
        //     DB::raw("(COUNT(*)) as count"),
        //     DB::raw("MONTHNAME(date) as month_name")
        // )
        // ->whereYear('created_at', date('Y'))
        // ->groupBy('month_name')
        // ->get()
        // ->toArray();
        return view('posture.edit',compact('postureimages'));
    }
}
