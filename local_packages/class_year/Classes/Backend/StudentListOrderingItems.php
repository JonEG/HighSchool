<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Backend;


class StudentListOrderingItems extends \TYPO3\CMS\Core\Type\Enumeration
{
    const __default = self::COURSE;

    //Model Student fields
    const COURSE = 'classroom.slug';
    const NAME = 'name';
    const EMAIL = 'email';

     /**
     * Modifies the select box of orderBy-options.
     *
     * @param array &$config configuration array
     */
    public function student_orderBy(array &$config)
    {
        $config['items'] = [
            // label, value
            ['course', self::COURSE],
            ['name', self::NAME],
            ['email', self::EMAIL],
        ];
    }
}