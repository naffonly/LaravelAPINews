<?php

namespace App\Http\Middleware;

use App\Models\Comments;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserComment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $curretUser = Auth::user()->id;
        $comment = Comments::findOrFail($request->id);

        if ($comment->user_id != $curretUser) { 
            return response()->json(['message' => 'data not found'],404);
        }
        return $next($request);
    }
}
