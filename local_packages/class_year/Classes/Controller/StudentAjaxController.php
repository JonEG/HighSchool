<?php

declare(strict_types=1);

namespace OvanGmbh\ClassYear\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

use OvanGmbh\ClassYear\Domain\Repository\StudentRepository;


/**
 * Handle FormEngine flex field ajax calls
 */
class StudentAjaxController
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function doSomething(ServerRequestInterface $request): ResponseInterface
    {
        $queryParameters = $request->getQueryParams();
        
        $userId = (int) $queryParameters['userId'] ?? null;
        if ($userId === null) {
            throw new \InvalidArgumentException('User id is missing', time());
        }
        $classroomId = (int) $queryParameters['classroomId'] ?? null;
        if ($classroomId === null) {
            throw new \InvalidArgumentException('Classroom id is missing', time());
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $query = $queryBuilder->update('fe_users');
        $query->where(
            $queryBuilder->expr()->eq('uid', $userId),
        );
        $query->set('tx_classyear_classroom',$classroomId);
        $response = $query->execute();
  
        return new JsonResponse($students);
    }
}
