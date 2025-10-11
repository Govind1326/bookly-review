<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        $userId = Auth::check() ? Auth::id() : null;
        $referer = $request->header('referer');
        $agent = new Agent();
        $device = $agent->device();
        $platform = $agent->platform();
        $browser = $agent->browser();
        $acceptLanguage = $request->header('Accept-Language');
        $method = $request->method();
        // Log the data
        ActivityLog::create([
            'ip' => $ipAddress,
            'user_id' => $userId,
            'referer' => $referer,
            'url' => $request->fullUrl(),
            'query_params' => json_encode($request->query()), // Store query params as JSON
            'user_agent' => $request->header('User-Agent'),
            'method' => $method,
            'session_id' => session()->getId(),
            'device' => $device,
            'platform' => $platform,
            'browser' => $browser,
            'accept_language' => $acceptLanguage,
        ]);

        return $next($request);
    }
}
