<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BotProtection
{
    /**
     * Common scraping User-Agents and identifiers to block.
     * 
     * @var array
     */
    protected $blacklistedUserAgents = [
        'python-requests',
        'python-urllib',
        'curl',
        'headless',
        'scraper',
        'scrapy',
        'selenium',
        'puppeteer',
        'phantomjs',
        'go-http-client',
        'wget',
        'java/',
        'postman',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        // 1. Check if IP is already blocked in Cache
        if (Cache::has('blocked_bot_' . $ip)) {
            return abort(403, 'Sistem mendeteksi aktivitas mencurigakan dari IP Anda. Akses dibatasi sementara (24 Jam).');
        }

        // 2. Check for Honeypot Access (Trapped!)
        // This path should match the hidden link in the frontend
        if ($request->is('cdn-cgi/health-check')) {
            Cache::put('blocked_bot_' . $ip, true, now()->addHours(24));
            return abort(403, 'Bot Detected.');
        }

        // 3. User-Agent Filtering
        $userAgent = strtolower($request->header('User-Agent'));
        
        // If User-Agent is empty, it's highly suspicious
        if (empty($userAgent)) {
            return abort(403, 'Direct access without User-Agent is not allowed.');
        }

        foreach ($this->blacklistedUserAgents as $bot) {
            if (str_contains($userAgent, $bot)) {
                return abort(403, 'Akses otomatis dibatasi.');
            }
        }

        return $next($request);
    }
}
