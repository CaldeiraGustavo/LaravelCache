<?php

namespace App\Services;

use App\Repositories\moduleRepository;
use App\Repositories\LessonRepository;

class LessonService 
{

    protected $repository;
    protected $moduleRepository;

    public function __construct(
        LessonRepository $LessonRepository,
        moduleRepository $moduleRepository
    ) {
        $this->repository = $LessonRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getLessonsByModule($module)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);
        return $this->repository->getLessonModule($module->id);
    }

    public function createNewLesson(array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->repository->createNewLesson($module->id, $data);
    }

    public function getLessonByModule($module, $identify)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);
        
        return $this->repository->getLessonByModule($module->id, $identify);
    }

    public function updateLesson($identify, $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->repository->updateLessonByUuid($module->id, $identify, $data);

    }

    public function deleteLesson($identify)
    {
        return $this->repository->deleteLessonByUuid($identify);
    } 
}