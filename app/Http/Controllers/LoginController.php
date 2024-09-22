<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $cleanedEmail = Str::replace(['@', '.'], '', $validatedData['email']);
        $connection = DB::connection('mysql');
        $databaseExists = DB::table('INFORMATION_SCHEMA.SCHEMATA')
            ->where('SCHEMA_NAME', $cleanedEmail)
            ->exists();
        if (empty($databaseExists)) {
            \Log::info("Invalid User .$cleanedEmail");

            return redirect()->route('register')
                            ->withErrors(['email' => 'Email Not Register Please Register']);

        } else {
            $connection->statement("USE $cleanedEmail");

            if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {

                $userData = User::get();

                return view('user.dasboard', compact('userData', 'cleanedEmail'));
            }
            return redirect()->route('login')->withErrors(['email' => 'Invalid email or password']);
        }
    }
}
