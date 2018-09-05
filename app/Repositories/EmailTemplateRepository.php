<?php

namespace App\Repositories;

use App\Entities\EmailTemplate;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Entities\EmailAction;
use Doctrine\ORM\Query;

class EmailTemplateRepository extends EntityRepository
{
    /**
     * Get all emails templates
     *
     */
    public function getAll()
    {
        $query = $this->createQueryBuilder('et')
            ->select('et.id', 'et.name', 'et.headerImage', 'et.headerTitle', 'et.content', 'et.footer', 'ea.id as actionId')
            ->leftJoin(EmailAction::class, 'ea', Query\Expr\Join::WITH, 'ea = et.action');
        return $query->getQuery()->getArrayResult();
    }

    /**
     * @param $id
     * @return EmailTemplate
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    public function save(EmailTemplate $template)
    {
        $this->_em->persist($template);
        $this->_em->flush();
    }
}