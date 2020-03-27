<?php

namespace App\GraphQL\Mutations;

use App\Employee;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class CreateEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'employee name',
        'email' => 'employee email',
    ];

    public function type(): Type
    {
        return GraphQL::type('employee');
    }

    public function args(): array
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $employee = Employee::create([
            'name' => $args['name'],
            'email' => $args['email'],

        ]);

        return $employee;
    }
}
