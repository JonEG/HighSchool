<?php

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Validator;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

final class DateRangeValidator extends AbstractValidator
{
    public function isValid($value): void
    {
        $dateFormat = 'Y-m-d';
        $date = date_create_from_format($dateFormat, $value);
        //$value is a date
        if ($date != false) {
            // $value is a date older than today
            if($date < date_create_from_format($dateFormat, date($dateFormat))){
                $this->addError('The date must be older than today. ', time());
            }
        } else {
            $this->addError("The date must have Y-m-d format", time());
        }
    }
}