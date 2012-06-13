<?php
namespace Repositories;

class TitleRepository extends \Repositories\Repository
{
    /**
     * Retrun all title
     * @return array
     */
    public function getList()
    {
        return $this->_em->createQueryBuilder()
            ->select('t')
            ->from('Entities\Title', 't')
            ->orderBy('t.id')
            ->getQuery()
            ->getResult();
    }
}
