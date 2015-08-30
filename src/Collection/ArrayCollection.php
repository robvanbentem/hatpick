<?php


namespace Hatpick\Collection;


class ArrayCollection implements BagInterface
{

    /**
     * @var array
     */
    private $elements;

    /**
     * @var array The provided array
     */
    private $original;

    function __construct($array)
    {
        $this->original = $array;

        /*
         * Create a integer based index mapping to the keys of the provided $array.
         * We cannot assume the $array keys are suitable so this index is necessary.
         */

        $n = 0;
        foreach ($array as $k => $v) {
            $this->elements[$n++] = $k;
        }
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
        return $this->original[$index];
    }

    public function reset()
    {
        // Nothing to do
    }

}