<?php

namespace Bookshop\V1\Entity;

use Doctrine\Common\Collections\Collection;

class Entity
{
    /**
     * @param Collection $collection
     *
     * @return array
     */
    protected function serializeCollection(Collection $collection)
    {
        $entities = [];

        // We could add more information like the name, date or place where we
        // could find the resource or make it specific.
        // I generally use a serializer like JMS, which makes this much easier, but I wasn't able to make it work
        // with this framework, so I decided to use a generic solution.

        foreach ($collection->toArray() as $item) {
            $entities[] = [
                'id' => $item->getId(),
            ];
        }

        return $entities;
    }
}
