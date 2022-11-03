<?php

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Symfony\Component\Mime\Address;

use OvanGmbh\ClassYear\Domain\Repository\StudentRepository;
use OvanGmbh\ClassYear\Domain\Model\Student;


class BackendHighschoolController extends ActionController
{
    /**
     * Backend Template Container
     *
     * @var string
     */
    protected $defaultViewObjectName = BackendTemplateView::class;

    /**
     * @param StudentRepository $studentRepository
     */
    public function __construct(StudentRepository $studentRepository, FluidEmail $email, Mailer $mailer)
    {
        $this->studentRepository = $studentRepository;
        $this->email = $email;
        $this->mailer = $mailer;
    }

    /**
     * Assign default variables to view
     * @param ViewInterface $view
     */
    public function initializeView(ViewInterface $view)
    {
        if ($view instanceof BackendTemplateView) {
            $view->getModuleTemplate()->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/Core/Ajax/AjaxRequest');
        }
    }

    public function listStudentsAction ()
    {
        $students = $this->studentRepository->findAll();
        $this->view->assign('students', $students);
    }

    public function initializeRecoveryEmailAction()
    {
        $studentUid = $this->request->getArguments()['student'];
        if(!empty($studentUid)){
            $student = $this->studentRepository->findByUid($studentUid);
            $this->request->setArgument('student', $student);
        }

    }

    public function recoveryEmailAction (?Student $student = null)
    {
        $this->email
            ->to(new Address($student->getEmail(), $student->getName()))
            ->subject('Recover your password')
            ->format('both'); // send HTML and plaintext mail
        $this->mailer->send($this->email);
        $this->redirect("listStudents");
    }
}