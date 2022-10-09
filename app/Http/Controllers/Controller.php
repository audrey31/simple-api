<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function findById($id) {
        $user = DB::table('users')->where('id', $id)->first();

        return response()->json($user);
    }

    public function create(Request $request) {
        $users = new User();

        $users->username = $request->input('username');
        $users->password = $request->input('password');

        $users->save();
        return response()->json(["message" => "Pengguna telah ditambah", "data" => $users]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $users = User::find($id);

        $users->username = $request->input('username');
        $users->password = $request->input('password');

        $users->save();

        return response()->json(["message" => "Pengguna telah diperbarui", "data" => $users]);
    }

    public function destroy($id) {
        $users = User::find($id);
        $users->delete();
        return response()->json(["message" => "Pengguna telah dihapus", "data" => $users]);
    }
}
