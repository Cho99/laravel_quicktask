<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Auth;
use Closure;

class Author
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $post = Post::findOrFail($request->post);
        if ($post->user_id !== Auth::id()) {
            abort(404);
        }

        return $next($request);
    }
}
