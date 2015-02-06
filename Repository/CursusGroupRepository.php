<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Claroline\CursusBundle\Repository;

use Claroline\CoreBundle\Entity\Group;
use Claroline\CursusBundle\Entity\Cursus;
use Doctrine\ORM\EntityRepository;

class CursusGroupRepository extends EntityRepository
{
    public function findOneCursusGroupByCursusAndGroup(
        Cursus $cursus,
        Group $group,
        $executeQuery = true
    )
    {
        $dql = '
            SELECT cg
            FROM Claroline\CursusBundle\Entity\CursusGroup cg
            WHERE cg.cursus = :cursus
            AND cg.group = :group
        ';
        $query = $this->_em->createQuery($dql);
        $query->setParameter('cursus', $cursus);
        $query->setParameter('group', $group);

        return $executeQuery ? $query->getOneOrNullResult() : $query;
    }
}
