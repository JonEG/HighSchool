<?php

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Repository\StudentRepository;
use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;
use OvanGmbh\ClassYear\Domain\Repository\SubjectRepository;
use OvanGmbh\ClassYear\Domain\Model\Classroom;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;

class MainController extends ActionController
{
    /**
     * @var StudentRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $studentRepository;

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
     * @var Context
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $context;

    public function initializeListAction()
    {
        //? get students
        $classroomUid = $this->request->getArguments()['classroomUid'];
        
        if(!empty($classroomUid) && ((int) $classroomUid) > 0) {
            //? students filtered by classroom
            $classroom = $this->classroomRepository->findByUid($classroomUid);

            $this->request->setArgument('classroom', $classroom);
        }
    }


    /**
     * List students
     * can be filtered with argument 'classroom'
     */
    public function listAction(?Classroom $classroom = null)
    {
        if(!empty($classroom)) {
            //? students filtered by classroom
            $students = $classroom->getStudents();
        } else {
            //? all students
            $students = $this->studentRepository->findAllStudents();
        }
        $this->view->assign('students', $students);

        //? get all classrooms
        $classrooms = $this->classroomRepository->findAll();
        $this->view->assign('classrooms', $classrooms);
    }

    /**
     * Display current user classmates
     */
    public function classmatesAction()
    {
        $userId = $this->context->getPropertyFromAspect('frontend.user', 'id');
        $user = $this->studentRepository->findByUid($userId);
        $this->view->assign('currentUser', $user);

        $classmates = $this->studentRepository->findByClassroom($user->getClassroom()->getUid());
        $this->view->assign('classmates', $classmates);
    }

    /**
     * Display current user subjects
     */
    public function subjectsAction()
    {
        $userId = $this->context->getPropertyFromAspect('frontend.user', 'id');
        $user = $this->studentRepository->findByUid($userId);
        $this->view->assign('userClassroom', $user->getClassroom());
    }
}