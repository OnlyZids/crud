<?php 
 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller 
{ 
    // login form
   public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credentials)) {
            
            // 3. Kalo sukses, regenerasi session (biar aman)
            $request->session()->regenerate();

            // 4. Arahkan ke dashboard
            return redirect()->route('dashboard');
        }

        // 5. Kalo gagal
        return back()->with('error', 'Username atau Password salah!');
    }
    public function dashboard()
    {
        $user = Auth::user(); 
        
        return view('dashboard', [
            'nama_user' => $user->name // Kirim nama user ke view   
        ]);
    }


    //  * Logout 

    public function logout(Request $request)
    {
        // . Panggil fungsi logout
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //  Balik ke login
        return redirect()->route('login');
    }
}