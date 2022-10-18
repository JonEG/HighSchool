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
    * @var ?string Student name
    */
    protected ?string $name = null;

    /**
    * @var ?string Student surname
    */
    protected ?string $surname = null;

    /**
    * @var ?string Student email
    */
    protected ?string $email = null;

    /**
     * Get student name
     *
     * @return  ?string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set student name
     *
     * @param  ?string  $name  Student name
     *
     * @return  self
     */ 
    public function setName(?string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get student surname
     *
     * @return  ?string
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set student surname
     *
     * @param  ?string  $surname  Student surname
     *
     * @return  self
     */ 
    public function setSurname(?string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get student email
     *
     * @return  ?string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set student email
     *
     * @param  ?string  $email  Student email
     *
     * @return  self
     */ 
    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }
}