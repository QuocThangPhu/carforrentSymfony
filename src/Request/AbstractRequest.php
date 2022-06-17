<?php

namespace App\Request;

abstract class AbstractRequest
{
    const LIMIT_DEFAULT = 10;
    const VALUE_DEFAULT = null;
    const STRING_DEFAULT = null;
    const INT_DEFAULT = null;
    const SEATS_LIST = [4, 7 , 16];
    const ORDER_BY_LIST = ['createdAt', 'price'];
    const ORDER_BY_DEFAULT = 'createdAt';
    const ORDER_TYPE_LIST = ['desc', 'asc'];
    const ORDER_TYPE_DEFAULT = 'asc';

    public function fromArray(array $query)
    {
        foreach ($query as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (!method_exists($this, $setter) || $value == self::VALUE_DEFAULT) {
                continue;
            }
            $this->{$setter}($value);
        }
    }
}
