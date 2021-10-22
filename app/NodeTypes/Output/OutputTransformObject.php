<?php


namespace App\NodeTypes\Output;


use App\Abstracts\AbstractTransformObject;

class OutputTransformObject extends AbstractTransformObject
{
    protected string $limit;
    protected int $offset;

    /**
     * OutputTransformObject constructor.
     * @param string $limit
     * @param int $offset
     */
    public function __construct(string $limit, int $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * @return string
     */
    public function getLimit(): string
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }
}