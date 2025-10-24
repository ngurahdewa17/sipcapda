<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsOperator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = $request->user()->role_id;
        $superOperatorId = Role::where('role_name', 'operator')->first()->id;

        if($role_id != $superOperatorId){
            Alert::error('Gagal', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
