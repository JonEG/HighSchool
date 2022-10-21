<?php

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Repository\StudentRepository;
use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

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
}