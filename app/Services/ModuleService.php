<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

class ModuleService 
{

    protected $repository;
    protected $courseRepository;

    public function __construct(
        ModuleRepository $moduleRepository,
        CourseRepository $courseRepository
    ) {
        $this->repository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getModulesByCourse($course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);
        return $this->repository->getModuleCourse($course->id);
    }

    public function createNewModule(array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        return $this->repository->createNewModule($course->id, $data);
    }

    public function getModuleByCourse($course, $identify)
    {
        $course = $this->courseRepository->getCourseByUuid($course);
        
        return $this->repository->getModuleByCourse($course->id, $identify);
    }

    public function updateModule($identify, $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        return $this->repository->updateModuleByUuid($course->id, $identify, $data);

    }

    public function deleteModule($identify)
    {
        return $this->repository->deleteModuleByUuid($identify);
    } 
}