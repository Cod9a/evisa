<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreateMail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role = null) {
        if(Role::whereName($role)->exists()) {
            $users = User::role($role)->orderBy('name')->orderBy('surname')->paginate(10);
        } else {
            $users = User::role(['admin', 'agent', 'frontal-agent', 'super-admin'])->orderBy('name')->orderBy('surname')->paginate(5);
        }
        
        return view('back.pages.users.index', compact('users', 'role'));
    }

    public function indexAdmin() {
        $admins = User::role('admin')->get();
        return view('back.pages.admins.index', compact('admins'));
    }

    public function indexAgent() {
        $agents = User::role('agent')->get();
        return view('back.pages.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($role) {
        if(Role::whereName($role)->exists()) {
            return view('back.pages.users.create', compact('role'));
        } else {
            Session::flash('error', "Ce rôle n'existe pas.");
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request, $role) {
        if(Role::whereName($role)->exists()) {
            $password = Str::random(12);
            $roleResult = Role::whereName($role)->first();
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'sex' => $request->sex,
                'country' => $request->country,
                'center_id' => $request->center_id,
                'password' => bcrypt($password)
            ]);
            $user->assignRole($roleResult->id);
            Mail::to($user->email)->send(new UserCreateMail($user, $password));
            Session::flash('success', "L'utilisateur a été bien ajouté.");
            return back();
        }
        Session::flash('error', "Ce rôle n'existe pas.");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
