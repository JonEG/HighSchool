<?php

declare (strict_types = 1);

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Subject {

    /**
     * @var string $title 
     */
    protected string $title;

    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var ObjectStorage classrooms
    */
    protected ObjectStorage $classrooms;

    /**
     * Get $title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set $title
     *
     * @param  string  $title  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get classrooms
     *
     * @return  ObjectStorage
     */ 
    public function getClassrooms()
    {
        return $this->classrooms;
    }

    /**
     * Set classrooms
     *
     * @param  ObjectStorage  $classrooms  classrooms
     *
     * @return  self
     */ 
    public function setClassrooms(ObjectStorage $classrooms)
    {
        $this->classrooms = $classrooms;

        return $this;
    }

    /**
     * Add classrooms
     *
     * @param Classroom  $classroom
     *
     * @return void
     */ 
    public function addClassroom(Classroom $classroom): void
    {
        $this->classrooms->attach($classroom);
    }

    /**
     * Remove classrooms
     *
     * @param Classroom  $classroom
     *
     * @return void
     */ 
    public function removeClassroom(Classroom $classroom): void
    {
        $this->classrooms->detach($classroom);
    }
}