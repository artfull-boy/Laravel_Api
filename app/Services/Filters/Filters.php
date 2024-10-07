<?php

namespace App\Services\Filters;

use Illuminate\Http\Request;

class Filters {
    protected $queries = [
    ];

    protected $map_queries = [
    ];

    protected $operatorsMap = [
    ];

    public function transform(Request $request) {
        $eloQuery = [];
        foreach ($this->queries as $name => $op) {
            $query = $request->query($name);

            if (!isset($query)) {
                continue;
            }

            $column = $this->map_queries[$name] ?? $name;

            foreach ($op as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column,$this->operatorsMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }

}
