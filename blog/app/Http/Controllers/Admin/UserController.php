<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $users = DB::table('users')->select('id','name', 'email')->find(2);
        // $users = DB::table('users')->count();
        // $users = User::findOrFail(20);

        // $users = DB::table('users')
        //     ->join('blogs', 'users.id', '=', 'blogs.user_id')
        //     ->select('users.*', 'blogs.title', 'blogs.description')
        //     ->get();

        // dd($users);


        $this->data['users'] = User::select('id', 'name', 'email', 'role')->orderByDesc('id')->paginate(10);
        return view('dashboard.user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $userData = $request->only(['name', 'email', 'password']);

        $response =  User::create($userData);

        if($response->id) {
            return redirect()->route('admin.user.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if($user->update($request->only(['name', 'email', 'role']))) {
            return redirect()->to(route('admin.user.index'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->delete()) {
            return redirect()->to(route('admin.user.index'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * User Avatar Change
     *
     * @param User $user
     * @return void
     */
    public function avatarChange(Request $request, User $user)
    {

        $pathInfo = pathinfo($user->image);
        $filename = $pathInfo['basename'];

        if($request->hasFile('image')) {
            $file =  $request->file('image');
            $extension =  $file->extension();
            $name =  $file->getClientOriginalName();
            $path =  Str::slug($name).'_'.time().'.'.$extension;

            Storage::disk('public')->put($path, file_get_contents($file));

            $user->image = $path;

            if($user->save()) {
                Storage::disk('public')->delete($filename);
                return response()->json(['error' => false, 'message' => 'Save successfully']);
            } else {
                return response()->json(['error' => true, 'message' => 'Something went wrong!']);
            }
        }

        return response()->json(['error' => true, 'message' => 'Image not found!']);

    }
}
