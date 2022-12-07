<?php

declare (strict_types = 1);

namespace OvanGmbh\ClassYear\Widgets\Provider;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Dashboard\WidgetApi;
use TYPO3\CMS\Dashboard\Widgets\ChartDataProviderInterface;

class StudentsByLevelProvider implements ChartDataProviderInterface
{
    /**
     * @var ConnectionPool
     */
    protected $connectionPool;

    /**
     * @var array
     */
    protected $labels = [];

    /**
     * @var array
     */
    protected $data = [];

    public function injectConnectionPool(ConnectionPool $connectionPool)
    {
        $this->connectionPool = $connectionPool;
    }

    public function getChartData(): array
    {
        $data = $this->getInfo();
        $result = [];
        foreach ($data as $element) {
            if(empty($result[$element['name']])){
                $result[$element['name']] = 0;
            }
            $result[$element['name']]++;
        }
        $labels = array_keys($result);
        $data = array_values($result);
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'backgroundColor' => WidgetApi::getDefaultChartColors(),
                    'data' => $data,
                ],
            ],
        ];
    }

    protected function getInfo()
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('fe_users');
        return $queryBuilder
            ->select('classroom.name', 'user.uid')
            ->from('fe_users', 'user')
            ->join(
                'user',
                'tx_classyear_domain_model_classroom',
                'classroom',
                $queryBuilder->expr()->eq('classroom.uid', $queryBuilder->quoteIdentifier('user.tx_classyear_classroom'))
            )
            ->orderBy('classroom.name')
            ->execute()
            ->fetchAllAssociative();
    }
}
