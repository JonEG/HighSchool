<?php

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Model\Exam;
use OvanGmbh\ClassYear\Domain\Repository\ExamRepository;
use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;
use OvanGmbh\ClassYear\Domain\Repository\SubjectRepository;


use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Extbase\Property\PropertyMapper;

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
        // $exam = $this->request->getArguments()['exam'];
        // if(!empty($exam)){
        //     $this->propertyMapper->convert($exam, Exam::class);
        // }
    }

    /**
    * Create an exam
     */
    public function createAction(?Exam $exam = null) {
        $examExample = $this->examRepository->findAll()->getFirst();

        $this->view->assign('examExample', $examExample);
        
        $classrooms = $this->classroomRepository->findAll();
        $this->view->assign('classrooms', $classrooms);
        
        $subjects = $this->subjectRepository->findAll();
        $this->view->assign('subjects', $subjects);
    }
}