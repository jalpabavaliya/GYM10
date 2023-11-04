<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('users.index');
    }

    public function getUser(Request $request)
    {
        if ($request->ajax()) {
            // $data['roles']  = Role::where('name', '!=', 'users')->get();
            // $data = User::with('roles')->where('type', '=', 0)->get();

            $data = User::latest()->get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = '<label class="switch"><input type="checkbox" onclick="status_change_alert(' . $row->id . ',' . $row->status . ')"><span class="slider"></span></label>';
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    // Update Button
                    $action = "";
                    if (Auth::user()->can('user-edit')) {
                        $action .= '<a href="' . route("users.edit", $row->id) . '"><i class="fa fa-pencil border border-2  p-2 rounded aria-hidden="true""></i></a>';
                    }
                    // if (Auth::user()->can('user-edit')) {
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="' . route("users.show", $row->id) . '"><i class="fa fa-eye border border-2  p-2 rounded aria-hidden="true""></i></a>';
                    // }
                    if (Auth::user()->can('user-delete')) {
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="' . route("users.delete", $row->id) . '"><i class="fa fa-trash border border-2  p-2 rounded"></i></a>';
                    }
                    // if (Auth::user()->can('user-edit')) {
                        $action .= '&nbsp;&nbsp;&nbsp;<a href="' . route("users.chart", $row->id) . '"><i class="fa fa-heart border border-2  p-2 rounded aria-hidden="true""></i></a>';
                    // }
                    return $action;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function chart($id)
    {
        $user = User::find($id);
        return view('users.chart', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:c_password',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        // dd($request->input('roles'));

        if(Auth::id() != 1){
            $user->assignRole("users");
        }else{
            $user->assignRole($request->input('roles'));
        }
        // $mailData = [
        //     'title' => 'Mail from FitWip',
        //     'body' => 'This mail for password creation.',
        //     'id' => $user->id,
        // ];
        // Mail::to($request->email)->send(new SendMail($mailData));
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:c_password',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        if(Auth::id() != 1){
            $user->assignRole("users");
        }else{
            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function createPassword($id)
    {
        return view('auth.createPassword', compact('id'));
    }

    public function passwordstore(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|same:confirm-password',
        ]);

        $input = $request->all();
        $id = $input['id'];
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }
        $user = User::find($id);
        $user->update($input);

        return redirect()->route('login')
            ->with('success', 'Password Create successfully');
    }

    public function status(Request $request)
    {
        dd("helllo");
    }
}
