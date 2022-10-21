<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * 
 */
class Classroom extends AbstractEntity
{
    const EXTBASE_TYPE = 'tx_classyear_domain_model_classroom';
    /**
    * @var string name
    */
    protected $name;

    /**
     * @var Student tutor
     */
    protected $tutor;

    /**
     * Get name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string  $name  name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get tutor
     *
     * @return  Student
     */ 
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * Set tutor
     *
     * @param  Student  $tutor  tutor
     *
     * @return  self
     */ 
    public function setTutor(Student $tutor)
    {
        $this->tutor = $tutor;

        return $this;
    }
}