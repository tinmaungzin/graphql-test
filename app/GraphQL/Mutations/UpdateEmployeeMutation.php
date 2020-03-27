<?php

namespace App\GraphQL\Mutations;

use App\Employee;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class UpdateEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateEmployee'
    ];

    public function type(): Type
    {
        return GraphQL::type('employee');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $employee = Employee::find($args['id']);
        if(!$employee) {
            return null;
        }

//        $employee->update([$args['name'],$args['email']]);

        $employee->name = $args['name'];
        $employee->email = $args['email'];
        $employee->save();
        return $employee;
    }
}
