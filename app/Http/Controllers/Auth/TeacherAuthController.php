<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Pastikan Controller diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::guard('teacher')->check()) {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']);
            }

            $user = Auth::guard('teacher')->user();
            if (!in_array($user->level, ['admin', 'guru'])) {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Access denied.']);
            }

            return $next($request);
        })->except(['showLoginForm', 'login', 'logout']);
    }

    public function showLoginForm()
    {
        return view('auth.teacher-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('teacher')->attempt(['nip' => $request->nip, 'password' => $request->password])) {
            $user = Auth::guard('teacher')->user();

            // Simpan semua data pengguna ke session
            session([
                'user_id' => $user->id,
                'user_nip' => $user->nip,
                'user_name' => $user->full_name,
                'user_level' => $user->level,
                'user_photo' => $user->photo,

            ]);

            if ($user->level === 'admin') {
                return redirect()->route('classrooms.index');
            } elseif ($user->level === 'guru') {
                return redirect()->route('classrooms.overview');
            }
        }

        return back()->withErrors(['nip' => 'Invalid NIP or password.']);
    }

    public function logout()
    {
        // Hapus semua session
        session()->flush();

        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login')->with('success', 'Logged out successfully.');
    }
}
