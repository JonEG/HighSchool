<?php

declare (strict_types = 1);

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Model\Student;
use OvanGmbh\ClassYear\Domain\Repository\StudentRepository;
use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Validation\Validator\EmailAddressValidator;

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
     * @param ClassroomRepository $classroomRepository
     * @param FluidEmail $email
     * @param Mailer $mailer
     */
    public function __construct(StudentRepository $studentRepository, ClassroomRepository $classroomRepository, FluidEmail $email, Mailer $mailer)
    {
        $this->studentRepository = $studentRepository;
        $this->classroomRepository = $classroomRepository;
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
            $view->getModuleTemplate()->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/Classyear/highschool');
        }
    }

    public function listStudentsAction()
    {
        $students = $this->studentRepository->findAll();
        $this->view->assign('students', $students);
        
        $classrooms = $this->classroomRepository->findAll();
        $this->view->assign('classrooms', $classrooms);
    }

    /**
     * @param string $email
     * @Validate(param="email", validator="EmailAddressValidator")
     */
    public function writeEmailAction(string $email)
    {
        $this->view->assign('email', $email);
    }

    public function sendEmailAction(string $to, string $subject, string $body)
    {
        
        $introduction = '';
        $content = $body;
        
        //generate introduction from body
        $bodyArray = $array = preg_split("/\r\n|\n|\r/", $body);
        if(count($bodyArray) > 1){
            $introduction = $bodyArray[0];
            unset($bodyArray[0]);
            $content = implode("\n", $bodyArray);
        }

        $this->email
            ->to(new Address($to))
            ->subject($subject)
            ->assignMultiple([
                'headline'=> $subject,
                'introduction' => $introduction,
                'content' => $content
             ])
            ->format('both');
        $this->mailer->send($this->email);
        $this->redirect("listStudents");
    }
}
