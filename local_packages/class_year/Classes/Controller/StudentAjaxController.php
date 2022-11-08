<?php

declare (strict_types = 1);

namespace OvanGmbh\ClassYear\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
            return new JsonResponse(["error" => true, "message" => "User id is missing"], 400);
        }
        $classroomId = (int) $queryParameters['classroomId'] ?? null;
        if ($classroomId === null) {
            return new JsonResponse(["error" => true, "message" => "Classroom id is missing"], 400);
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $query = $queryBuilder->update('fe_users');
        $query->where(
            $queryBuilder->expr()->eq('uid', $userId),
        );
        $query->set('tx_classyear_classroom', $classroomId);
        $response = $query->execute();

        switch ($response) {
            case 0:
                return new JsonResponse(["error" => true, "message" => "query failed"], 500);
            case 1:
                return new JsonResponse(["success" => true, "message" => "user updated"], 200);
            default:
                return new JsonResponse(["error" => true, "message" => "query failed"], 500);
        }
    }
}
