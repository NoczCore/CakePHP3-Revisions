<?php

namespace Revisions\Model\Table;

use Cake\ORM\Table;
use Revisions\Model\Entity\Revision;

class RevisionsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
    }

}