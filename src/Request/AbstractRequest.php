<?php

namespace App\Request;

abstract class AbstractRequest
{
    public function fromArray(array $query)
    {
        foreach ($query as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if(!method_exists($this, $setter)) {
                return;
            }
            $this->{$setter}($value);
        }
    }
}
