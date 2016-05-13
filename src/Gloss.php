<?php namespace Ilkermutlu\Gloss;

use Illuminate\Support\Collection;

class Gloss {

    protected $array;
    protected $collection;
    protected $name = 'name';

    public function createFrom(Array $array = null, Collection $collection = null)
    {
        if ($array) {
            $collection = new Collection($array);
            $this->collection = $collection;
        }

        if ($collection) {
            $this->collection = $collection->sort();
        }
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function make()
    {
        return $this->reduce();
    }

    public function reduce()
    {
        $reduced = $this->collection->reject(function ($rec) {
            return isset($record->{$this->name});
        })->reduce(function($groupedByFirstLetter, $record) {
            $firstCharacter = mb_substr($record->{$this->name}, 0, 1);
            if (!isset($groupedByFirstLetter[$firstCharacter])) {
                $groupedByFirstLetter[$firstCharacter] = [];
            }
            $groupedByFirstLetter[$firstCharacter][] = $record;
            return $groupedByFirstLetter;
        }, []);
        ksort($reduced);
        return $reduced;
    }
}
