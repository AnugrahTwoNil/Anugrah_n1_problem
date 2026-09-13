<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class QueryCounter
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $queryCount = 0;
        $queryDuration = 0.0;

        DB::listen(function (QueryExecuted $query) use (&$queryCount, &$queryDuration): void {
            $queryCount++;
            $queryDuration += $query->time;
        });

        $response = $next($request);
        $response->headers->set('X-Query-Count', (string) $queryCount);
        $response->headers->set('X-Query-Duration', number_format($queryDuration, 2, '.', ''));

        return $response;
    }
}
