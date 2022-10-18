<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * 
 */
class Classroom extends AbstractEntity
{
    /**
    * @var string name
    */
    protected $name;

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
}