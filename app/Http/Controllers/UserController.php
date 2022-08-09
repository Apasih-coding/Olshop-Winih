<?php

namespace App\Http\Controllers;

use App\Message;
use App\Order;
use App\Role;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $order = Order::latest()->paginate(10);
        $subTotal = Order::select('total_price')->get();
        $collect = collect($subTotal);
        $total_belanja = $collect->sum('total_price');
        $getStatusID = $order[0]['status_id'];
        $status = Status::all();
        $status = Status::where('id', '=', $getStatusID)->get();
        $message = Message::all();
        // dd($status);
        return view('admin.dashboard')->with([
            'user' => $user,
            'order' => $order,
            'status' => $status,
            'message' => $message,
            'total_belanja' => $total_belanja
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $user = DB::table('users')->where('id', '=', $id)->get();
        } else {
            $user = User::all();
        }
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $attr = request()->all();
        if (request()->hasFile('profile')) {
            Storage::delete($user->profile);
            $file = request()->file('profile')->getClientOriginalName();
            // $fileUrl = request()->file('profile')->storeAs('profile', $user->id . '/' . $file, '');
            request()->file('profile')->storeAs('profile', $user->id . '/' . $file, '');
        } else {
            $file = $user->profile;
        }
        $attr['profile'] = $file;
        $user->update($attr);
        return redirect('/myaccount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (FacadesGate::denies('delete-user')) {
            return redirect('/admin/user');
        }
        $user->roles()->detach();
        $user->delete();
        return redirect('/admin/user');
    }
    // Manage User
    public function indexManageUser()
    {
        $user = User::all();
        return view('admin.user.index')->with([
            'user' => $user
        ]);
    }
    public function adminshow(User $user)
    {
        $roles = Role::all();
        return view('admin.user.detail')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }
    public function adminedit(User $user)
    {
        if (FacadesGate::denies('edit-user')) {
            return redirect('/admin');
        }
        $roles = Role::all();
        return view('admin.user.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }
    public function adminupdate(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect('/admin/user');
    }
    public function editpassword()
    {
        return view('user.reset');
    }
    public function updatepassword(Request $request, User $user)
    {
        $this->validate($request, [
            'oldPassword' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $userCurl = Auth::user()->password;
        if (Hash::check($request->oldPassword, $userCurl)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', "Password has been changed successfully");
        } else {
            return back()->with('error', "Failed to change the password");
        }
    }
}
