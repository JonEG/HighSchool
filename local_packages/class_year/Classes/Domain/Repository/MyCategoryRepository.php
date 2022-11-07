<?php

namespace OvanGmbh\ClassYear\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;

class MyCategoryRepository extends CategoryRepository
{

 public function findStudentCategories(Array $studentId)
 {
  $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
  $query = $queryBuilder->select('sys_category.uid', 'sys_category.title', 'mm.uid_foreign')->from('sys_category');
  $query->join(
   'sys_category',
   'sys_category_record_mm',
   'mm',
   $queryBuilder->expr()->andX(
    $queryBuilder->expr()->eq('mm.uid_local', $queryBuilder->quoteIdentifier('sys_category.uid')),
    $queryBuilder->expr()->in('mm.uid_foreign', $queryBuilder->createNamedParameter($studentId, Connection::PARAM_INT_ARRAY)),
    $queryBuilder->expr()->eq('mm.tablenames', $queryBuilder->quote('fe_users')),
    $queryBuilder->expr()->eq('mm.fieldname', $queryBuilder->quote('categories'))
   )
  );

  $result = $query->execute()->fetchAll();
  
  return $result;
 }

}
