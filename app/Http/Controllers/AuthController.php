<?php 
 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; // <-- WAJIB TAMBAH INI
use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller 
{ 
   public function showLogin()
    {
        return view('login');
    }

    /**
     * Ini fungsi yang kita rombak total.
     */
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
        $user = Auth::user(); // $user->name, $user->username, dll.
        
        return view('dashboard', [
            'nama_user' => $user->name // Kirim nama user ke view   
        ]);
    }


    //  * Logout 

    public function logout(Request $request)
    {
        // 1. Panggil fungsi logout
        Auth::logout();

        // 2. Hancurkan session
        $request->session()->invalidate();

        // 3. Bikin token session baru (biar aman)
        $request->session()->regenerateToken();

        // 4. Balik ke login
        return redirect()->route('login');
    }
}