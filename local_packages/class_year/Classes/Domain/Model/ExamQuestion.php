<?php 

declare(strict_type =1);

namespace OvanGmbh\ClassYear\Domain\Model;

class ExamQuestion 
{
    /**
     * @var string title
     */
    protected string $title = '';

    /**
     * @var ?bool correctAnswer;
     */
    protected ?bool $correctAnswer = null;

    /**
     * Get title
     *
     * @return string
     */ 
    public function getTitle() : string
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
    public function setTitle(string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get correctAnswer;
     *
     * @return  ?bool
     */ 
    public function getCorrectAnswer() : ?bool
    {
        return $this->correctAnswer;
    }

    /**
     * Set correctAnswer;
     *
     * @param  ?bool  $correctAnswer  correctAnswer;
     *
     * @return  self
     */ 
    public function setCorrectAnswer(?bool $correctAnswer) : self
    {
        $this->correctAnswer = $correctAnswer;

        return $this;
    }
}