<?php


namespace Hatpick;


use Hatpick\Collection\BagInterface;
use Hatpick\Exception\HatpickException;

class Bag
{
    /**
     * @var BagInterface
     */
    private $collection;

    /**
     * @var string[]
     */
    private $config;

    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $ceiling;

    /**
     * @param BagInterface $collection
     * @param array $config
     */
    function __construct(BagInterface $collection, $config = [])
    {
        $this->collection = $collection;
        $this->setup($config);
    }

    /**
     * @param $config
     * @throws HatpickException
     */
    protected function setup($config)
    {
        $this->config = $config;
        $this->collection->setup($config);

        $this->size = $this->collection->size();
        $this->ceiling = $this->size - 1;

        if ($this->size === 0) {
            throw new HatpickException(HATPICK_NO_ELEMENT_EXCEPTION_MESSAGE);
        }

        if (isset($config['seed'])) {
            mt_srand($config['seed']);
        }
    }

    /**
     * @param $index
     * @return null
     */
    protected function cfg($index)
    {
        if (isset($this->config[$index]) === false) {
            return null;
        }

        return $this->config[$index];
    }

    /**
     * @return mixed
     * @throws HatpickException
     */
    public function pick()
    {
        if ($this->ceiling === -1) {
            if ($this->cfg('loop') === true) {
                $this->reset();
            } else {
                throw new HatpickException(HATPICK_OVERPICK_EXCEPTION_MESSAGE);
            }
        }

        $index = mt_rand(0, $this->ceiling);

        $pickedElement = $this->collection->get($index);
        $ceilingElement = $this->collection->get($this->ceiling);

        $this->collection->set($index, $ceilingElement);
        $this->collection->set($this->ceiling, $pickedElement);

        $this->ceiling--;

        return $this->collection->value($pickedElement);
    }

    /**
     *
     */
    public function reset()
    {
        $this->collection->reset();

        $this->size = $this->collection->size();
        $this->ceiling = $this->size - 1;
    }
}