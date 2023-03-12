<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

define("DEFAULT_PER_PAGE", 1);
define("DEFAULT_CURRENT_PAGE", 0);

final class Newsall
{
    public function __invoke(mixed $root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $perPage = $this->get_arg('first', $args, DEFAULT_PER_PAGE);
        $currentPage = $this->get_arg('page', $args, DEFAULT_CURRENT_PAGE);

        //TODO: PAGINATED RESPONSE
        $response = Http::get('https://3zatz1zi5g.execute-api.us-east-1.amazonaws.com/api/news');

        return new LengthAwarePaginator(array_slice($response->json(), $currentPage * $perPage, $perPage), count($response->json()), $perPage, $currentPage);
    }

    private function get_arg($arg_name, $args, $default_value)
    {
        if (array_key_exists($arg_name, $args)) {
            return $args[$arg_name];
        } else {
            return $default_value;
        }
    }
}
