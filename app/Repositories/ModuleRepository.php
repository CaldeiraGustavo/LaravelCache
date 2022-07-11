<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getAllModules()
    {
        return $this->entity->get();
    }

    public function createNewModule(int $courseId, array $data)
    {
        $data['course_id'] = $courseId;

        return $this->entity->create($data);
    }

    public function getModuleByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrFail();
    }

    public function deleteModuleByUuid(string $identify) 
    {
        $module = $this->getModuleByUuid($identify);

        return $module->delete();
    }

    public function updateModuleByUuid(int $courseId, string $identify, array $data)
    {
        $module = $this->getModuleByUuid($identify);

        $data['course_id'] = $courseId;

        return $module->update($data);
    }

    public function getModuleCurse(string $courseId)
    {
        return $this->entity->where('course_id', $courseId)->get();
    }

    public function getModuleByCourse(string $courseId, string $identify)
    {
        return $this->entity
                ->where('course_id', $courseId)
                ->where('uuid', $identify)
                ->firstOrFail();
    }
}