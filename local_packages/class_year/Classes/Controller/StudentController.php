<?php

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Repository\StudentRepository;
use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;

class StudentController extends ActionController
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
     * @var Context
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $context;

    

    /**
     * @param int $classroomUid filter students by this class
     */
    public function listAction(int $classroomUid = 0)
    {
        //? get students
        if(!empty($this->request->getArguments()['classroomUid'])
         && ((int)$this->request->getArguments()['classroomUid']) > 0
        ) {
            //? students filtered by classroom
            $students = $this->studentRepository->findByClassroom($classroomUid);
        } else {
            //? all students
            $students = $this->studentRepository->findAllStudents();
        }
        $this->view->assign('students', $students);

        //? get all classrooms
        $classrooms = $this->classroomRepository->findAll();
        $this->view->assign('classrooms', $classrooms);
    }

    public function classmatesAction()
    {

        $userId = $this->context->getPropertyFromAspect('frontend.user', 'id');
        $user = $this->studentRepository->findByUid($userId);
        $this->view->assign('currentUser', $user);

        $classmates = $this->studentRepository->findByClassroom($user->getClassroom()->getUid());
        $this->view->assign('classmates', $classmates);
    }
}