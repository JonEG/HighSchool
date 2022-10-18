<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * 
 */
class Student extends AbstractEntity
{
    /**
    * @var string Student name
    */
    protected $name;

    /**
    * @var string Student surname
    */
    protected $surname;

    /**
    * @var string Student email
    */
    protected $email;

    /**
    * @var ClassRoom 
    */
    protected $classroom;

    /**
     * Get student name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set student name
     *
     * @param  string  $name  Student name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get student surname
     *
     * @return  string
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set student surname
     *
     * @param  string  $surname  Student surname
     *
     * @return  self
     */ 
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get student email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set student email
     *
     * @param  string  $email  Student email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of classroom
     *
     * @return  ClassRoom
     */ 
    public function getClassroom()
    {
        return $this->classroom;
    }

    /**
     * Set the value of classroom
     *
     * @param  ClassRoom  $classroom
     *
     * @return  self
     */ 
    public function setClassroom(ClassRoom $classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }
}