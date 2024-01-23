<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest();
        if (request('search')) {
            $users->where('name', 'like', '%' . request('search') . '%')->orWhere('email', 'like', '%' . request('search') . '%')->orWhere('username', 'like', '%' . request('search') . '%');
        }

        return view('users.index', [
            'title' => 'Pengguna',
            'icon' => 'bi-person-fill',
            'users' => $users->paginate(8)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $userId)
    {

        if ($request['password'] !== $request['verification']) {
            return redirect('/user/create')->with('error', 'Kata sandi tidak cocok');
        }
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'username' => 'required|unique:users|min:6|max:255',
            'password' => 'required|min:8|max:255',
            'role' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $filePath = $request->file('image')->store('profile-user');
        $data['url_picture'] = $filePath;
        $data['password'] = bcrypt($data['password']);

        unset($data['verification'], $data['image']);

        User::create($data);

        $name = $data['name'];
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-success'><b>Menambahkan</b></span> pengguna <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/users')->with('success', "Berhasil menambah pengguna $name");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, $userId)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'password' => 'nullable|min:8|max:255',
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if (isset($data['password'])) {
            if ($request['password'] !== $request['verification']) {
                $userUsername = $user['username'];
                return redirect("/user/update/$userUsername")->with('error', 'Kata sandi tidak cocok');
            }
        }

        $previousImagePath = $user['url_picture'];

        if (isset($data['image'])) {
            $filePath = $request->file('image')->store('profile-user');
            $data['url_picture'] = $filePath;

            Storage::delete($previousImagePath);
        }

        $data['password'] = bcrypt($data['password']);

        unset($data['verification'], $data['image']);

        $user->update($data);

        $name = $data['name'];
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-primary'><b>Mengupdate</b></span> pengguna <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/users')->with('success', "Berhasil menambah pengguna $name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $userId)
    {
        $name = $user['name'];
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-danger'><b>Menghapus</b></span> pengguna <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);
        User::destroy($user['id']);
        return redirect('/users')->with('success', "Berhasil menghapus pengguna $name");
    }

    public function createUser()
    {
        return view('user.create', [
            'title' => 'Tambah Pengguna',
            'icon' => 'bi-person-fill'
        ]);
    }

    public function getUser($id)
    {
        return response()->json(User::find($id));
    }

    public function updateUser(User $user)
    {
        $name = $user['name'];
        return view('user.update', [
            'title' => "Update Pengguna $name",
            'icon' => 'bi-person-fill',
            'user' => $user
        ]);
    }
}
