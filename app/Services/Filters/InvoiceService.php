<?php

namespace App\Services\Filters;


class InvoiceService extends Filters {

    protected $queries = [
        "customerId"=> ['eq'],
        "amount"=> ['eq','gt','gte','lt','lte'],
        "status"=>["eq",'ne'],
        "billedDate"=> ['eq','lt','gt'],
        "paidTime"=> ['eq','lt','gt'],
    ];

    protected $map_queries = [
        'customerId'=> 'customer_id',
        'billedDate'=> 'billed_dated',
        'paidTime'=> 'paid_time',
    ];

    protected $operatorsMap = [
        'eq'=> '=',
        'gt'=> '>',
        'lt'=> '<',
        'lte'=> '<=',
        'gte'=> '>=',
        'ne'=> '!=',
    ];
}
