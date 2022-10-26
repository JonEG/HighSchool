<?php 

declare(strict_types = 1);

namespace OvanGmbh\ClassYear\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;

use OvanGmbh\ClassYear\Domain\Repository\ClassroomRepository;
use OvanGmbh\ClassYear\Domain\Model\Classroom;

class JsonController extends ActionController {

    /**
     * @var JsonView
     */
    protected $view;

    /**
     * @var string
     */
    protected $defaultViewObjectName = JsonView::class;

    /**
     * @var ClassroomRepository
     */
    protected $classroomRepository;
  
    public function __construct(ClassroomRepository $classroomRepository)
	{
		$this->classroomRepository = $classroomRepository;
	}

    /**
     * Lists all classrooms
     */
    public function listClassroomsAction() {
        //? Customize json output
        $this->view->setConfiguration([
            'classrooms' => [
                '_descendAll' => [
                    '_exclude' => [
                        'pid',
                        'slug',
                    ],
                    '_descend' => [
                        'tutor' => [
                            '_only' => ['surname']
                        ],
                        'subjects' => [
                            '_descendAll' => [
                                '_only' => ['title'] 
                            ]
                        ]
                    ],
                ],
            ],
        ]);
        //? Set allowed vars
        $this->view->setVariablesToRender(['classrooms']);


        $classrooms = $this->classroomRepository->findAll();
        $this->view->assign('classrooms', $classrooms);
    }

    /**
     * Lists a classroom
     */
    public function showClassroomAction(int $classroomUid) {
        //? Customize json output
        $this->view->setConfiguration([
            'classroom' => [
                '_exclude' => [
                    'pid',
                    'slug',
                ],
                '_descend' => [
                    'tutor' => [
                        '_only' => ['surname']
                    ],
                    'subjects' => [
                        '_descendAll' => [
                            '_only' => ['title'] 
                        ]
                    ]
                ],
            ],
        ]);
        //? Set allowed vars
        $this->view->setVariablesToRender(['classroom']);

        $classroom = $this->classroomRepository->findByUid($classroomUid);
        $this->view->assign('classroom', $classroom);
    }
}