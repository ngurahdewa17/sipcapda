<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsPimpinan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = $request->user()->role_id;
        $superPimpinanId = Role::where('role_name', 'pimpinan')->first()->id;

        if($role_id != $superPimpinanId){
            Alert::error('Gagal', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
