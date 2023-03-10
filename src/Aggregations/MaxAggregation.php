<?php

namespace Everzel\ElasticsearchQueryBuilder\Aggregations;

use Everzel\ElasticsearchQueryBuilder\Aggregations\Concerns\WithMissing;

class MaxAggregation extends Aggregation
{
    use WithMissing;

    /** @var string */
    protected $field;

    public static function create(string $name, string $field): self
    {
        return new self($name, $field);
    }

    public function __construct(string $name, string $field)
    {
        $this->name = $name;
        $this->field = $field;
    }

    public function payload(): array
    {
        $parameters = [
            'field' => $this->field,
        ];

        if ($this->missing) {
            $parameters['missing'] = $this->missing;
        }

        return [
            'max' => $parameters,
        ];
    }
}
