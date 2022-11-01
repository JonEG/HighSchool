<?php

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Validator;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

use \DateTime;

final class DateRangeValidator extends AbstractValidator
{
    public function isValid($value): void
    {
        $dateFormat = 'Y-m-d';
        $today = date($dateFormat);
        $todayDateTime = DateTime::createFromFormat($dateFormat, $today);
        $paramDateTime = DateTime::createFromFormat($dateFormat, $value);
        //$value is a date
        if ($paramDateTime != false) {
            // $value is a date older than today
            if($paramDateTime <= $todayDateTime){
                $this->addError('The date must be older than today. ', time());
            }
        } else {
            $this->addError("The date must have Y-m-d format", time());
        }
    }
}