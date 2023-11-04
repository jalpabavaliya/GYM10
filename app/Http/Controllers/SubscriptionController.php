<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.index');
    }

    public function getSubscription(Request $request)
    {
        if ($request->ajax()) {
            $data = Subscription::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = "";
                    if (Auth::user()->can('subscription-edit')) {
                        $action = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="tooltip" class="editsubscription" data-id="' . $row->id . '"><i class="fa fa-pencil p-2 rounded border"></i></a>';
                    }
                    if (Auth::user()->can('subscription-delete')) {
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="' . route("subscription.destroy", $row->id) . '"><i class="fa fa-trash p-2 rounded border"></i></a>';
                    }
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
            'sub_type' => 'required',
            'amount' => 'required',
            'status' => 'required',
        ]);
        $data = $request->input();
        $ins = array(
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'sub_type' => $data['sub_type'],
            'amount' => $data['amount'],
            'status' => $data['status'],
        );

        if (!empty($data['subscription_id'])) {
            Subscription::where('id', $data['subscription_id'])->update($ins);
            return redirect()->route('subscription.index')->with('success', 'Subscription Updated successfully');
        } else {
            Subscription::create($ins)->id;
            return redirect()->route('subscription.index')->with('success', 'Subscription created successfully');
        }
    }

    public function edit($id)
    {
        $subscription = Subscription::where('id', $id)->orderBy('id', 'DESC')->first();
        return response()->json($subscription);
    }

    public function destroy($id)
    {
        DB::table("subscriptions")->where('id', $id)->delete();
        return redirect()->route('subscription.index')
            ->with('success', 'Subscription deleted successfully');
    }
}
