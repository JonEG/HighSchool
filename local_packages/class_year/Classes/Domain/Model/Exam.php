<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Exam extends AbstractEntity
{
    /**
     * @var string title
     */
    protected string $title = '';

    /**
     * @var ?string date epoch
     */
    protected ?string $date = null;

    /**
     * @var Classroom
     */
    protected $classroom;

    /**
     * @var Subject
     */
    protected $subject;

    /**
     * @var  ObjectStorage<ExamQuestion> $questions
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $questions;


}