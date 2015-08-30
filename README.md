## Hatpick

**Warning!** Alpha software, not yet fully tested and implemented.


### Intro

**Description**: An efficient non-repeating random element picker based on the Fisher-Yates shuffle algorithm.

**Or in simpler terms**: Put *n* amount of *things* in a hat, and draw them out one by one until it's empty.

A Hatpick `Bag` will pick a random element from a provided `Collection` without picking the same element more than once. There
are several options to change the behaviour of the bag, for example looping (resetting) when the bag is empty. More 
options and collections are planned to be added.

### Usage

The Hatpick bag expects a `Collection` passed to it's constructor. The `Collection` type will determine the type of elements
that can be picked from. An optional config array can be provided as a second argument.

There are several Collections to use with a Hatpick bag.

- RangeCollection
- ArrayCollection

#### RangeCollection

In range mode you provide a range of numbers to pick from. Just like picking numbers out of a hat.

    $bag = new Bag(new RangeCollection(1, 10));
    
    $number = $bag->pick(); // returns a number between 1-10 (including 1 and 10).
    
    
#### ArrayCollection

With this collection we can provide our own array to pick from. In this example we use looping as well, this means the `Bag`
will reset itself in case all elements have been picked.

    $values = ['correct', 'battery', 'horse', 'staple'];
    $bag = new Bag(new ArrayCollection($values), ['loop' => true]);
    
    $word = $bag->pick(); // we can keep on picking forever without repeats within the provided set
    
    
### Custom Collections


Creating a Collection is easy; just implement the `BagInterface` interface and you are ready to go. The interface is very 
straightforward with only a few methods.

