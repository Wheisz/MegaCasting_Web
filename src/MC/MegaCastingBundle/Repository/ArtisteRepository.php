<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MC\MegaCastingBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArtisteRepository extends EntityRepository
{
    public function myFindByDomaine($libelle_domaine)
    {
        $qb = $this
                ->createQueryBuilder('a')
                ->innerJoin('a.idmetier', 'm')
                ->innerJoin('m.iddomaine', 'd')
                ->where('d.libelle = :libelle')
                ->setParameter('libelle', $libelle_domaine);

        return $results = $qb->getQuery()->getResult();
    }
}
