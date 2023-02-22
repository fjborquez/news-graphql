<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Http;

final class Newsall
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $response = Http::get('https://3zatz1zi5g.execute-api.us-east-1.amazonaws.com/api/news');

        return $response->json();
    }
}
