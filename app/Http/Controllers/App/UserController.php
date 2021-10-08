<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showUserEdit()
    {
        $user = auth()->user();

        return view('app.userEdit', ['user' => $user]);
    }


    public function userEdit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'room' => ['max:255'],
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->room = $request->room;
        $user->save();

        return redirect('user');
    }
}
