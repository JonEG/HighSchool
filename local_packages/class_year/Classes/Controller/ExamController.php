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
use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationBuilder;
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
     * @var PropertyMappingConfigurationBuilder
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $propertyMappingConfigurationBuilder;
    
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
    * Create an exam form
    */
    public function formAction() {
        $classrooms = $this->classroomRepository->findAll();
        $this->view->assign('classrooms', $classrooms);
        
        $subjects = $this->subjectRepository->findAll();
        $this->view->assign('subjects', $subjects);

        //check if exam to edit was received
        if($this->request->hasArgument('editExam')){
            $examUid = $this->request->getArgument('editExam');
            $exam = $this->examRepository->findByUid($examUid);
            $this->view->assign('examToEdit', $exam);
        }

        //check if exam to delete was received
        if($this->request->hasArgument('removeExam')){
            $examUid = $this->request->getArgument('removeExam');
            $exam = $this->examRepository->findByUid($examUid);
            $this->examRepository->remove($exam);
            $this->redirect('list');
        }

        //check if notification error 
        if($this->request->hasArgument('failed')){
            $this->view->assign('failed', true);
        }
        //check if notification success
        if($this->request->hasArgument('succeded')){
            $examTitle = $this->request->getArgument('succeded');
            $this->view->assign('succeded', $examTitle);
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
            // remove desired stored questions
            //! WE MUST REMOVE IDENTITIES FROM ELEMENTS TO BE DELETED, 
            //! TO AVOID MAPPING FROM ASSUMING IT SHOULD ADD THEM BACK
            foreach ($exam['questions'] as $key => $value) {
                if(count($value) == 1 && !empty($value['__identity'])){
                    unset($exam['questions'][$key]);
                    //! WE UPDATE THE ARGUMENT SO THAT QUESTIONS DO NOT CONTAIN IDS FOR THE MAPPING.
                    $this->request->setArgument('newExam', $exam); 
                }
            }

            $propertyMappingConfiguration = $this->propertyMappingConfigurationBuilder->build();
            $propertyMappingConfiguration->forProperty('questions.*')->setTypeConverterOption(PersistentObjectConverter::class, PersistentObjectConverter::CONFIGURATION_MODIFICATION_ALLOWED, true);
            $propertyMappingConfiguration->forProperty('questions.*')->allowAllProperties();

            $mappedExam = $this->propertyMapper->convert($exam, Exam::class, $propertyMappingConfiguration);

        }
        //map new exam questions
        $questions = $this->request->getArguments()['questions'];
        if(!empty($questions)){
            $mappedQuestions = [];
            foreach($questions as $question){
                $mappedQuestions[] = $this->propertyMapper->convert($question, ExamQuestion::class);
            }
            
            $this->request->setArgument('questions', $mappedQuestions);
        }
    }

    public function editAction(?Exam $newExam = null, array $questions = [])
    {
        $redirectArguments = [];

        if($newExam){
            if(!empty($questions)){
                foreach ($questions as $key => $question) {
                    //persist questions
                    $this->examQuestionRepository->add($question);
                    //add to exam
                    $newExam->addQuestion($question);
                }
            }
            //persist exam
            $this->examRepository->update($newExam);
            $redirectArguments['succeded'] = $newExam->getTitle();
        }
        
        $this->redirect('list',null, null, $redirectArguments);
    }

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
        $questions = $this->request->getArguments()['questions'];
        if(!empty($questions)) {

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
                //add to exam
                $newExam->setQuestions($questions);
            }
            //persist exam
            $this->examRepository->add($newExam);
            $redirectArguments['succeded'] = $newExam->getTitle();
        }
        
        $this->redirect('list',null, null, $redirectArguments);
    }

    public function errorAction(){
        $this->redirect('form',null, null, ['failed' => true]);
    }
}