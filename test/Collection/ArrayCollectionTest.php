<?php


namespace Test\Collection;


use Hatpick\Bag;
use Hatpick\Collection\ArrayCollection;
use Test\HatpickTest;

class ArrayCollectionTest extends HatpickTest
{
    public function testArray()
    {
        $max = pow(10, 4);
        $values = range(1, $max - 1);
        $values['n'] = 'horse';

        $bag = new Bag(new ArrayCollection($values));

        $result = [];
        for ($n = 0; $n < $max; $n++) {
            $result[$bag->pick()] = 0;
        }

        $this->assertNotFalse(array_key_exists('horse', $result));
        $this->assertEquals(sizeof($result), $max);
    }

    public function testLooping()
    {
        $values = [
            'a' => 'correct',
            'b' => 'battery',
            'c' => 'horse',
            'd' => 'staple',
        ];

        $bag = new Bag(new ArrayCollection($values), ['loop' => true]);

        $result = [
            'correct' => 0,
            'battery' => 0,
            'horse' => 0,
            'staple' => 0,
        ];

        $picks = 4 * pow(10, 4);
        for ($n = 0; $n < $picks; $n++) {
            $result[$bag->pick()]++;
        }

        $this->assertEquals($result['correct'], $result['battery']);
        $this->assertEquals($result['correct'], $result['horse']);
        $this->assertEquals(array_sum($result), $picks);
    }
}