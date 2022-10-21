<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * 
 */
class Student extends FrontendUser
{
    const EXTBASE_TYPE = 'tx_classyear_domain_model_student';

    /**
    * @var string Student surname
    */
    protected $surname;

    /**
    * @var ClassRoom 
    */
    protected $classroom;

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