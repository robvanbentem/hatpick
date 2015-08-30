<?php


namespace Hatpick\Collection;


class RangeCollection implements BagInterface
{

    private $elements = [];

    /**
     * RangeCollection constructor.
     * @param $min
     * @param $max
     * @param int $step
     */
    public function __construct($min, $max, $step = 1)
    {
        $this->elements = range($min, $max, $step);
    }

    public function setup($config)
    {
        // Nothing to do
    }

    public function size()
    {
        return sizeof($this->elements);
    }

    public function get($index)
    {
        return $this->elements[$index];
    }

    public function set($index, $element)
    {
        $this->elements[$index] = $element;
    }

    public function value($index)
    {
        // The index is the value in this case
        return $index;
    }

    public function reset()
    {
        // Nothing to do
    }


}