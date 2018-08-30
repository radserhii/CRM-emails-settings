<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

class EmailTemplateRepository extends EntityRepository
{
//    /**
//     * Get all emails settings
//     * @return array
//     */
//    public function getAll()
//    {
//        $query = $this->createQueryBuilder('es');
//
//        return $query->getQuery()->getArrayResult();
//    }
//
//    /**
//     * Update all emails settings
//     * @param $settings
//     */
//    public function updateAll($settings)
//    {
//        foreach ($settings as $setting) {
//            $this->save($setting);
//        }
//    }
//
//    /**
//     * Save email setting
//     * @param $setting
//     */
//    public function save($setting)
//    {
//        $id = array_get($setting, 'id');
//        $value = array_get($setting, 'value');
//
//        $emailSetting = $this->find($id);
//        $emailSetting->setValue($value);
//
//        $this->_em->persist($emailSetting);
//        $this->_em->flush();
//    }
}