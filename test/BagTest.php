<?php


namespace Test;

use Hatpick\Bag;
use Hatpick\Collection\BagInterface;
use Hatpick\Exception\HatpickException;

class BagTest extends HatpickTest
{

    public function testThrowExceptionOnEmptyCollection()
    {
        $this->setExpectedException(HatpickException::class, HATPICK_NO_ELEMENT_EXCEPTION_MESSAGE);

        $collection = $this->getMock(BagInterface::class);
        $collection->method('size')->will($this->returnValue(0));

        new Bag($collection);
    }

    public function testThrowExceptionOnOverpick()
    {
        $this->setExpectedException(HatpickException::class, HATPICK_OVERPICK_EXCEPTION_MESSAGE);

        $collection = $this->getMock(BagInterface::class);
        $collection->method('size')->will($this->returnValue(1));


        $bag = new Bag($collection);
        $bag->pick();
        $bag->pick();
    }

    public function testReset()
    {
        $collection = $this->getMock(BagInterface::class);
        $collection->method('size')->will($this->returnValue(1));
        $collection->method('get')->will($this->returnValue(1));
        $collection->method('value')->will($this->returnArgument(0));
        $collection->expects($this->once())
            ->method('reset');

        $bag = new Bag($collection);
        $this->assertEquals($bag->pick(), 1);
        $bag->reset();
        $this->assertEquals($bag->pick(), 1);
    }


    public function testConfigLoop()
    {
        $collection = $this->getMock(BagInterface::class);

        $collection->expects($this->exactly(3))
            ->method('reset');

        $collection->method('size')
            ->will($this->returnValue(1));

        $bag = new Bag($collection, ['loop' => true]);
        $bag->pick();
        $bag->pick();
        $bag->pick();
        $bag->pick();
    }


}