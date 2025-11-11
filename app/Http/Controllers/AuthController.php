<?php 
 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
 
class AuthController extends Controller 
{ 
    public function showLogin() { 
        return view('login'); 
    } 
 
    public function login(Request $request) { 
        $username = $request->username; 
        $password = $request->password; 
 
        // Login sederhana tanpa database 
        if ($username == 'admin' && $password == '123') { 
            session(['user' => $username]); 
            return redirect()->route('dashboard'); 
        } 
 
        return back()->with('error', 'Username atau Password salah!'); 
    } 
 
    public function dashboard() { 
        if (!session('user')) { 
            return redirect()->route('login'); 
        } 
        return view('dashboard'); 
    } 
 
    public function logout() { 
        session()->flush(); 
        return redirect()->route('login'); 
    } 
}