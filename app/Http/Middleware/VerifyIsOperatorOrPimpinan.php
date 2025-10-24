<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class VerifyIsOperatorOrPimpinan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = $request->user()->role_id;

        $operatorId = Role::where('role_name', 'operator')->first()->id ?? null;
        $pimpinanId = Role::where('role_name', 'pimpinan')->first()->id ?? null;

        if (!in_array($role_id, [$operatorId, $pimpinanId])) {
            Alert::error('Gagal', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->route('home');
        }

        return $next($request);
    }
}
