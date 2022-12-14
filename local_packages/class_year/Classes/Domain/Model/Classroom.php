<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
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
    * @var string slug
    */
    protected $slug;

    /**
     * @var Student tutor
     */
    protected $tutor;

    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var ObjectStorage<Subject> subjects
    */
    protected $subjects;
    
    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var ObjectStorage<Student> subjects
    */
    protected $students;

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

    /**
     * Get subjects
     *
     * @return  ObjectStorage
     */ 
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * Set subjects
     *
     * @param  ObjectStorage  $subjects  subjects
     *
     * @return  self
     */ 
    public function setSubjects(ObjectStorage $subjects)
    {
        $this->subjects = $subjects;

        return $this;
    }

    /**
     * Add subjects
     *
     * @param Subject  $subject
     *
     * @return void
     */ 
    public function addSubject(Subject $subject): void
    {
        $this->subjects->attach($subject);
    }

    /**
     * Remove Subjects
     *
     * @param Subject  $subject
     *
     * @return void
     */ 
    public function removeSubject(Subject $subject): void
    {
        $this->subjects->detach($subject);
    }
    
    /**
     * Get students
     *
     * @return ObjectStorage<Student>
     */ 
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Set students
     *
     * @param  ObjectStorage<Student>  $students  students
     *
     * @return  self
     */ 
    public function setStudents(ObjectStorage $students)
    {
        $this->students = $students;

        return $this;
    }

    /**
     * Add students
     *
     * @param Student  $student
     *
     * @return void
     */ 
    public function addStudent(Student $student): void
    {
        $this->students->attach($student);
    }

    /**
     * Remove students
     *
     * @param Student  $student
     *
     * @return void
     */ 
    public function removeStudent(Student $student): void
    {
        $this->students->detach($student);
    }

    /**
     * Get slug
     *
     * @return  string
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param  string  $slug  slug
     *
     * @return  self
     */ 
    public function setSlug(string $slug)
    {
        $this->slug = $slug;

        return $this;
    }
}