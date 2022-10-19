<?php
declare(strict_types = 1);

return [
    OvanGmbh\ClassYear\Domain\Model\Student::class => [
        'tableName' => 'fe_users',
        'properties' => [
            'surname' => [
                'fieldName' => 'last_name'
            ],
            'classroom' => [
                'fieldName' => 'tx_classyear_classroom'
            ],
        ],
    ],
];