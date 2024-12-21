<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Bgian register
    public function register(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ],
        [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {     
            return redirect()->back()->with('failed', 'Email Already Exist!');
        }else {
            $proses = User::create([
                'email' => $request->email,
                'role' => 'guest',
                'password' => $request->password,
            ]);

            $credentials = $request->only('email', 'password');

            
                if (!$proses  || !Auth::attempt($credentials)) {
                    return redirect()->back()->with('failed', "Gagal membuat akun, Perhatikan Dalam pengisian email dan password");
                } else {
                    return redirect()->route('dashboard')->with('succes', "Berhasil Membuat Akun 👌");
                }
            
        }
    }

    // Bagian login
    public function auth(Request $request) 
    {
        // Validasi Inputan User Pd saat login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], 
        [ // Error yng akan dtampilkan per inputan jika validasi gagal
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);
        
        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials) && Auth::user()->role == 'guest') {
            return redirect()->route('dashboard')->with('succes', 'Berhasil Login 👌');
        }else if(Auth::attempt($credentials) && Auth::user()->role == 'staff') {
            return redirect()->route('staff.dashboard_staff')->with('succes', 'Berhasil Login 👌');
        } else if(Auth::attempt($credentials) && Auth::user()->role == 'head_staff') {
            return redirect()->route('head.dashboard_head')->with('succes', 'Berhasil Login 👌');
        } else {
            return redirect()->back()->with('failed', 'Login gagal, periksa kembali email dan password anda lalu coba lagi.');
        }
    }

    // LOgout
    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil Logout 👌');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('login.login');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
