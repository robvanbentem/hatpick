<?php

namespace Test\Collection;

use Hatpick\Bag;
use Hatpick\Collection\RangeCollection;
use Test\HatpickTest;

class RangeCollectionTest extends HatpickTest
{
    public function testLargeRange()
    {
        $max = pow(10, 4) - 1;
        $bag = new Bag(new RangeCollection(1, $max));

        $result = [];
        for ($n = 0; $n < $max; $n++) {
            $result[$bag->pick()] = null;
        }

        $this->assertEquals(sizeof($result), $max);
        $this->assertNotFalse(array_key_exists(1, $result));
        $this->assertNotFalse(array_key_exists($max, $result));
    }

    public function testRangeLooping()
    {
        $max = 3;
        $loop = pow(10, 4);
        $bag = new Bag(new RangeCollection(1, $max), ['loop' => true]);

        $result = [
            1 => 0,
            2 => 0,
            3 => 0,
        ];

        for ($n = 0; $n < $loop * $max; $n++) {
            $result[$bag->pick()]++;
        }

        $this->assertEquals(sizeof($result), $max);
        $this->assertEquals(array_sum($result), $max * $loop);
        $this->assertEquals($result[1], $result[3]);
        $this->assertEquals($result[3], $loop);
    }

    public function testSingleElement()
    {
        $bag = new Bag(new RangeCollection(1, 1));

        $this->assertEquals($bag->pick(), 1);
    }
}