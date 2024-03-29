<?php

namespace Everzel\ElasticsearchQueryBuilder\Aggregations;

use Everzel\ElasticsearchQueryBuilder\Sorts\SortInterface as Sort;

class TopHitsAggregation extends Aggregation
{
    /** @var int */
    protected $size;

    /** @var Sort|null */
    protected $sort = null;

    public static function create(string $name, int $size, ?Sort $sort = null): self
    {
        return new self($name, $size, $sort);
    }

    public function __construct(string $name, int $size, ?Sort $sort = null)
    {
        $this->name = $name;
        $this->size = $size;
        $this->sort = $sort;
    }

    public function payload(): array
    {
        $parameters = [
            'size' => $this->size,
        ];

        if ($this->sort) {
            $parameters['sort'] = [$this->sort->toArray()];
        }

        return [
            'top_hits' => $parameters,
        ];
    }
}
