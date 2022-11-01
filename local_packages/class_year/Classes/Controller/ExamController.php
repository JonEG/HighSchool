<?php

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Model\Exam;
use OvanGmbh\ClassYear\Domain\Model\ExamQuestion;
use OvanGmbh\ClassYear\Domain\Repository\ExamRepository;
use OvanGmbh\ClassYear\Domain\Repository\ExamQuestionRepository;
use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;
use OvanGmbh\ClassYear\Domain\Repository\SubjectRepository;


use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Extbase\Property\PropertyMapper;
use TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

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
     * @var PersistenceManager
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $persistenceManager;
    
    /**
     * @var ExamRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $examRepository;
    
    /**
     * @var ExamQuestionRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $examQuestionRepository;
    
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
    * Lists all exams
    */
    public function listAction(){
        $exams = $this->examRepository->findAll();
        $this->view->assign('exams', $exams);
    }


    /**
    * Create an exam
    */
    public function formAction() {
        $classrooms = $this->classroomRepository->findAll();
        $this->view->assign('classrooms', $classrooms);
        
        $subjects = $this->subjectRepository->findAll();
        $this->view->assign('subjects', $subjects);

        //check if exam to edit was received
        if($this->request->hasArgument('exam')){
            $examUid = $this->request->getArgument('exam');
            $exam = $this->examRepository->findByUid($examUid);
            $this->view->assign('examToEdit', $exam);
        }

        //check if notification error 
        if($this->request->hasArgument('failedExam')){
            $this->view->assign('failedExam', true);
        }
        //check if notification success
        if($this->request->hasArgument('succededExam')){
            $examTitle = $this->request->getArgument('succededExam');
            $this->view->assign('succededExam', $examTitle);
        }
    }

    /**
    * Edit an exam
    */
    public function initializeEditAction()
    {
        //map exam
        if($this->request->hasArgument('newExam')){
            $exam = $this->request->getArgument('newExam');
            $mappedExam = $this->propertyMapper->convert($exam, Exam::class);
            // $this->request->setArgument('newExam', $mappedExam);
        }
        //map exam questions
        if($this->request->hasArgument('questions')){
            $questions = $this->request->getArgument('questions');

            $mappedQuestions = [];
            foreach($questions as $question){
                $mappedQuestions[] = $this->propertyMapper->convert($question, ExamQuestion::class);
            }
            
            $this->request->setArgument('questions', $mappedQuestions);
        }
    }

    public function editAction(?Exam $newExam = null, array $questions = []){}

    /**
    * Create an exam
     */
    public function initializeCreateAction()
    {
        //map exam
        if($this->request->hasArgument('newExam')){
            $exam = $this->request->getArgument('newExam');
            $mappedExam = $this->propertyMapper->convert($exam, Exam::class);
            // $this->request->setArgument('newExam', $mappedExam);
        }
        //map exam questions
        if($this->request->hasArgument('questions')){
            $questions = $this->request->getArgument('questions');

            $mappedQuestions = [];
            foreach($questions as $question){
                $mappedQuestions[] = $this->propertyMapper->convert($question, ExamQuestion::class);
            }
            
            $this->request->setArgument('questions', $mappedQuestions);
        }
    }

    /**
    * Create an exam
    */
    public function createAction(?Exam $newExam = null, array $questions = []) {
        $redirectArguments = [];

        if($newExam){
            if(!empty($questions)){
                foreach ($questions as $key => $question) {
                    //persist questions
                    $this->examQuestionRepository->add($question);
                }
                $newExam->setQuestions($questions);
            }
            //persist exam
            $this->examRepository->add($newExam);
            $redirectArguments['succededExam'] = $newExam->getTitle();
        }
        
        $this->redirect('form',null, null, $redirectArguments);
    }

    public function errorAction(){
        $this->redirect('form',null, null, ['failedExam' => true]);
    }
}