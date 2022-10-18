<?php

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Repository\StudentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class StudentController extends ActionController
{
    private $studentRepository;

    /**
     * Inject the student repository
     *
     * @param StudentRepository $productRepository
     */
    public function injectProductRepository(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function listAction()
    {
        $students = $this->studentRepository->findAll();
        $this->view->assign('students', $students);
    }
}