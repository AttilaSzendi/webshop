<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SnakeCaseRequest
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->replace($this->snakeCase($request->all()));

        return $next($request);
    }

    protected function snakeCase(array $array, string $delimiter = '_')
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->snakeCase($value, $delimiter);
            }
            $result[Str::snake($key, $delimiter)] = $value;
        }
        return $result;
    }
}
