<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActiveAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            // Hanya update jika lebih dari 1 menit sejak update terakhir
            if (auth()->user()->last_active_at < now()->subMinute()) {
                auth()->user()->update([
                    'last_active_at' => now(),
                ]);

                // Debug hanya di development
                if (app()->environment('local')) {
                    Log::debug('User activity updated', [
                        'user_id' => auth()->id(),
                        'last_active_at' => now()
                    ]);
                }
            }
        }

        return $next($request);

        // Ver 2
        // if (auth()->check()) {
        //     Log::debug('Middleware triggered for user: ' . auth()->user()->id, [
        //         'before' => auth()->user()->last_active_at,
        //         'time' => now()
        //     ]);

        //     auth()->user()->update([
        //         // 'last_active_at' => now(),
        //         'last_active_at' => Carbon::now()->toDateTimeString(), // Format eksplisit
        //         'is_active' => true
        //     ]);

        //     Log::debug('After update:', [
        //         'after' => auth()->user()->fresh()->last_active_at
        //     ]);
        // }
        // return $next($request);

        // Ver 1
        // if (auth()->check()) {
        //     Log::info('Updating last_active_at for user: ' . auth()->user()->id);
        //     auth()->user()->update([
        //         'last_active_at' => now(),
        //         'is_active' => true
        //     ]);
        // }
        // return $next($request);
    }
}
