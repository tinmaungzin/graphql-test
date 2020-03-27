<?php

namespace App\GraphQL\Queries;

use App\Employee;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class EmployeesQuery extends Query
{
    protected $attributes = [
        'name' => 'Employees query'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('employee');
    }

    public function args(): array
    {
        return [

            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'limit' => ['name' => 'limit', 'type' => Type::int()],
            'page' => ['name' => 'page', 'type' => Type::int()],

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return Employee::where('id' , $args['id'])->get();
        }

        if (isset($args['email'])) {
            return Employee::where('email', $args['email'])->get();
        }
        if (isset($args['name'])) {
            return Employee::where('name', $args['name'])->get();
        }

        if(isset($args['limit'], $args['page'])){
            return Employee::paginate($args['limit'], ['*'], 'page', $args['page']);

        }

        return Employee::all();
    }
}
