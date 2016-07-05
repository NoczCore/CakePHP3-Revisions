<?php

namespace Revisions\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Query;

class RevisionsBehavior extends Behavior
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->_table->hasMany('Revisions', [
            'className' => 'Revisions.Revisions',
            'foreignKey' => 'ref_id',
            'order' => 'Revisions.created DESC',
            'conditions' => ['ref' => $this->_table->alias()]
        ]);
    }

    public function revert($ref_id, $rev_id){
        $ref = $this->_table->findById($ref_id)->contain([
            'Revisions' => function(Query $q) use ($rev_id){
                return $q->where(['id' => $rev_id]);
            }
        ])->first();
        if($ref->revisions == null)
            return false;
        $rev = $ref->revisions[0]->data;
        unset($rev->revisions);
        $this->_table->patchEntity($ref, $rev);
        $this->_table->save($ref);
    }

    public function afterSaveCommit(Event $event, EntityInterface $entity, \ArrayObject $options){
        $rev = $this->_table->Revisions->newEntity();
        unset($entity->revisions);
        $rev->data = $entity->toArray();
        $rev->ref = $this->_table->alias();
        $rev->ref_id = $entity->id;
        $this->_table->Revisions->save($rev);
    }

}