<?php

namespace App\Services\Filters;


class CustomerService extends Filters {

    protected $queries = [
        "name"=> ['eq'],
        "address"=> ['eq'],
        "type"=>["eq"],
        "city"=> ['eq'],
        "state"=> ['eq'],
        "postalCode"=> ['eq','gt','lt'],
    ];

    protected $map_queries = [
        'postalCode'=> 'postal_code',
    ];

    protected $operatorsMap = [
        'eq'=> '=',
        'gt'=> '>',
        'lt'=> '<',
    ];
}
