<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BaseService
{
    // Constructor to bind model to repo
    public function __construct(protected Model $model)
    {
    }

    // magic method for undefined methods to redirect for repo
    public function __call($method, $args)
    {
        return $this->model->$method(...$args);
    }

    protected $sortableFields = [
        'id',
    ];

    protected $defaultSortField = '-id';

    protected $relations = [

    ];

    public function applyCustomConditions()
    {

    }

    protected function getScopeFilters(): array
    {
        return [];
    }

    public function getQuery()
    {
        $allowed_filters = [];

        foreach ($this->getScopeFilters() as $sf)//scope filters
            $allowed_filters[] = AllowedFilter::scope($sf);

        $this->query = QueryBuilder::for (get_class($this->model))
            ->allowedFilters($allowed_filters)
            ->defaultSort($this->defaultSortField)
            ->allowedSorts($this->sortableFields);


        // apply custom conditions
        $this->applyCustomConditions();

        // load relations
        $this->query->with($this->relations);
        return $this->query;
    }
}

