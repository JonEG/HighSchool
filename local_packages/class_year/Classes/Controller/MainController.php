<?php

namespace OvanGmbh\ClassYear\Controller;

use OvanGmbh\ClassYear\Domain\Repository\StudentRepository;
use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;
use OvanGmbh\ClassYear\Domain\Repository\SubjectRepository;
use OvanGmbh\ClassYear\Domain\Repository\MyCategoryRepository;
use OvanGmbh\ClassYear\Domain\Model\Classroom;
use OvanGmbh\ClassYear\Backend\StudentListOrderingItems;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Core\Cache\CacheManager;



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
     * @var MyCategoryRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $categoryRepository;

     /**
     * @var Context
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $context;

    /** Cache testing */
    private function generateCache(){
        $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
        
        $cacheIdentifier = 'classyear';
        if($cacheManager->hasCache($cacheIdentifier)){
            /** @var \TYPO3\CMS\Core\Cache\Frontend\FrontendInterface $cache */
            $cache = $cacheManager->getCache($cacheIdentifier);

            $entryIdentifier = 'pepe';
            $cacheValue = $cache->get($entryIdentifier);
            if(!$cacheValue){
                $data = 'ranita verde';
                $tags = ['animal'];

                $cache->set($entryIdentifier, $data, $tags);
            }
        }
    }

    public function initializeListAction()
    {
        //? get students
        $classroomUid = $this->request->getArguments()['classroomUid'];
        
        if(!empty($classroomUid) && ((int) $classroomUid) > 0) {
            $this->request->setArgument('classroom', $classroomUid);
        }
    }

    /**
     * List students
     * can be filtered with argument 'classroom'
     */
    public function listAction(?int $classroom = null)
    {
        //ordering students
        if(!empty($this->settings['orderBy'])){
            switch ($this->settings['orderBy']) {
                case StudentListOrderingItems::NAME: 
                    $this->studentRepository->setDefaultOrderings(
                        [StudentListOrderingItems::NAME => QueryInterface::ORDER_ASCENDING]
                    );
                    break;
                case StudentListOrderingItems::EMAIL: 
                    $this->studentRepository->setDefaultOrderings(
                        [StudentListOrderingItems::EMAIL => QueryInterface::ORDER_ASCENDING]
                    );
                    break;
                case StudentListOrderingItems::COURSE: 
                    $this->studentRepository->setDefaultOrderings(
                        [StudentListOrderingItems::COURSE => QueryInterface::ORDER_ASCENDING]
                    );
                    break;
                default:
                    break;
            }
        }
        if(!empty($classroom)) {
            //? students filtered by classroom
            $students = $this->studentRepository->findByClassroom($classroom);
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

        $classmatesUids = [];
        foreach ($classmates as $classmate) {
            $classmatesUids[] = $classmate->getUid();
        }

        $categories = $this->categoryRepository->findStudentCategories($classmatesUids);
        $this->view->assign('categories', $categories);

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