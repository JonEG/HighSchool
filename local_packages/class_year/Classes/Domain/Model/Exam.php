<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Exam extends AbstractEntity
{
    /**
     * @var string title
     */
    protected $title = '';

    /**
     * @var ?string date epoch
     * @\TYPO3\CMS\Extbase\Annotation\Validate("\OvanGmbh\ClassYear\Domain\Validator\DateRangeValidator")
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


    public function initializeObject(){
        $this->questions = new ObjectStorage();
    }

    /**
     * Get title
     *
     * @return  string
     */ 
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string  $title  title
     *
     * @return  self
     */ 
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get date epoch
     *
     * @return  ?string
     */ 
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * Set date epoch
     *
     * @param  ?string  $date  date epoch
     *
     * @return  self
     */ 
    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of classroom
     *
     * @return  Classroom
     */ 
    public function getClassroom(): Classroom
    {
        return $this->classroom;
    }

    /**
     * Set the value of classroom
     *
     * @param  Classroom  $classroom
     *
     * @return  self
     */ 
    public function setClassroom(Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * Get the value of subject
     *
     * @return  Subject
     */ 
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @param  Subject  $subject
     *
     * @return  self
     */ 
    public function setSubject(Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get $questions
     *
     * @return  ObjectStorage<ExamQuestion>
     */ 
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set $questions
     *
     * @param  ObjectStorage<ExamQuestion>  $questions  $questions
     *
     * @return  self
     */ 
    public function setQuestions($questions): self
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * Add questions
     *
     * @param ExamQuestion  $question
     *
     * @return void
     */ 
    public function addQuestion(ExamQuestion $question): void
    {
        $this->questions->attach($question);
    }

    /**
     * Remove questions
     *
     * @param ExamQuestion  $question
     *
     * @return void
     */ 
    public function removeQuestion(ExamQuestion $question): void
    {
        $this->questions->detach($question);
    }
}