<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Model;

use \TYPO3\CMS\Extbase\Persistance\ObjectStorage;

use Student;

/**
 * 
 */
class Classroom 
{
    /**
    * @var string name
    */
    protected string $name;
  
    /**
     * Get name
     *
     * @return  string
     */ 
    public function getName(): string
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
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
   
}