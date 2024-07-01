<?php

namespace App\Http\Middleware;

use App\Models\Semester;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActiveSemester
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $activeSemester = Semester::where('status', 'Aktif')->first();

        if ($user && $activeSemester && $user->id_semester == $activeSemester->id_semester) {
            return $next($request);
        }

        return redirect()->route('login')->with(['msg' => 'Semester tidak aktif atau tidak sesuai.', 'type' => 'error']);
    }
}
