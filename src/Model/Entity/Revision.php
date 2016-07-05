<?php

namespace Revisions\Model\Entity;

use Cake\ORM\Entity;

class Revision extends Entity
{

    protected function _setData($data){
        return base64_encode(serialize($data));
    }

    protected function _getData($data)
    {
        return unserialize(base64_decode($data));
    }

}