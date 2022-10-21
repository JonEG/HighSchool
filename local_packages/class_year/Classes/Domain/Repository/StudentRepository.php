<?php

namespace OvanGmbh\ClassYear\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

use TYPO3\CMS\Core\Database\Query\QueryBuilder;

use \OvanGmbh\ClassYear\Domain\Model\Student;

class StudentRepository extends Repository
{

    public function findByClassroom($identifier)
    {
        $query = $this->createQuery();

        return $query
                ->matching(
                    $query->logicalAnd(
                        $query->equals('classroom', $identifier),
                        $query->equals('tx_extbase_type', Student::EXTBASE_TYPE)
                    )
                )
                ->execute();
    }

    public function findAllStudents()
    {
        $query = $this->createQuery();

        return $query
                ->matching($query->equals('tx_extbase_type', Student::EXTBASE_TYPE))
                ->execute();
    }

}