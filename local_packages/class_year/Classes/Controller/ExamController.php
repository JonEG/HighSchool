<?php

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Model\Exam;
use OvanGmbh\ClassYear\Domain\Model\ExamQuestion;
use OvanGmbh\ClassYear\Domain\Repository\ExamRepository;
use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;
use OvanGmbh\ClassYear\Domain\Repository\SubjectRepository;
use OvanGmbh\ClassYear\TypeConverter\ClassroomConverter;


use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Extbase\Property\PropertyMapper;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationBuilder;
use TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter;

class ExamController extends ActionController
{
     /**
     * @var Context
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $context;

    /**
     * @var PropertyMapper
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $propertyMapper;
    
    /**
     * @var PropertyMappingConfigurationBuilder
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $propertyMappingConfigurationBuilder;
    
    /**
     * @var ClassroomConverter
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $classroomConverter;
    
    /**
     * @var ExamRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $examRepository;
    
    /**
     * @var ClassroomRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $classroomRepository;
    
    /**
     * @var SubjectRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $subjectRepository;

    /**
    * Create an exam
     */
    public function initializeCreateAction()
    {
        if($this->request->hasArgument('newExam')){
            $exam = $this->request->getArgument('newExam');

            $mappedType = $this->propertyMapper->convert($exam, Exam::class, $propertyMappingConfiguration);
            // var_dump($mappedType);
        }
    }

    /**
    * Create an exam
     */
    public function createAction(?Exam $newExam = null) {
        $classrooms = $this->classroomRepository->findAll();
        $this->view->assign('classrooms', $classrooms);
        
        $subjects = $this->subjectRepository->findAll();
        $this->view->assign('subjects', $subjects);
    }

    public function errorAction(){
        var_dump('errorAction');
    }
}