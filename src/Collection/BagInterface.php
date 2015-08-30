<?php


namespace Hatpick\Collection;


interface BagInterface
{
    /**
     * @param $config
     * return void
     */
    public function setup($config);

    /**
     * @return int
     */
    public function size();

    /**
     * @param int $index    The picked element
     * @return mixed
     */
    public function get($index);

    /**
     * @param int $index
     * @param mixed $element
     * @return void
     */
    public function set($index, $element);

    /**
     * @param mixed $index
     * @return mixed
     */
    public function value($index);

    /**
     * @return void
     */
    public function reset();


}