<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

class EmailActionRepository extends EntityRepository
{
    /**
     * Get all emails actions
     * @return array
     */
    public function getAll()
    {
        $query = $this->createQueryBuilder('ea');

        return $query->getQuery()->getArrayResult();
    }

    /**
     * Update all emails actions
     * @param $actions
     */
    public function updateAll($actions)
    {
        foreach ($actions as $action) {
            $this->save($action);
        }
    }

    /**
     * Save email action
     * @param $action
     */
    public function save($action)
    {
        $id = array_get($action, 'id');
        $sender = array_get($action, 'sender');
        $enabled = array_get($action, 'enabled');

        $emailAction = $this->find($id);
        $emailAction->setSender($sender);
        $emailAction->setEnabled($enabled);

        $this->_em->persist($emailAction);
        $this->_em->flush();
    }
}