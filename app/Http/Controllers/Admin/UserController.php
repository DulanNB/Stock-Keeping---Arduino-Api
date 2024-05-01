<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

use Auth;
class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-management|user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = [
            'category_name' => 'User Management',
            'page_name' => 'Users',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        $dataa = User::orderBy('id','DESC')->paginate(5);

        return view('admin.users.index',compact('dataa') )
            ->with('i', ($request->input('page', 1) - 1) * 5)->with($data);
    }

    public function create()
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'))->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];


        $this->validate($request, [
            'name' => 'required',
            'user_id' => Str::random(9),
            'emails' => 'required|emails|unique:users,emails',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);



        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('admin.user.index')
            ->with('success','User created successfully')->with($data);;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $user = User::find($id);
        return view('admin.users.show',compact('user'))->with($data);;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('admin.users.edit',compact('user','roles','userRole'))->with($data);;
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
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $this->validate($request, [
            'name' => 'required',
            'emails' => 'required|emails|unique:users,emails,'.$id,
            'roles' => 'required'
        ]);


        $input = $request->all();

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('admin.user.index')
            ->with('success','User updated successfully')->with($data);;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        User::find($id)->delete();
        return redirect()->route('admin.user.index')
            ->with('success','User deleted successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    /*public function edit(User $user)
    {
        //
        $roles = Role::all();

        return view('admin.users.edit')->with(['user' => $user,'roles' => $roles]);
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, User $user)
    {
        //
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.user.index');
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(User $user)
    {
        //
    }*/
}
