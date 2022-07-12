<?php

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Support\Facades\Cache;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getAllLessons()
    {
        return $this->entity->get();
    }

    public function createNewLesson(int $moduleId, array $data)
    {
        $data['module_id'] = $moduleId;

        return $this->entity->create($data);
    }

    public function getLessonByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrFail();
    }

    public function deleteLessonByUuid(string $identify) 
    {
        $lesson = $this->getLessonByUuid($identify);
        Cache::forget('course');

        return $lesson->delete();
    }

    public function updateLessonByUuid(int $moduleId, string $identify, array $data)
    {
        $lesson = $this->getLessonByUuid($identify);

        $data['module_id'] = $moduleId;
        Cache::forget('course');

        return $lesson->update($data);
    }

    public function getLessonModule(string $moduleId)
    {
        return $this->entity->where('module_id', $moduleId)->get();
    }

    public function getLessonByModule(string $moduleId, string $identify)
    {
        return $this->entity
                ->where('module_id', $moduleId)
                ->where('uuid', $identify)
                ->firstOrFail();
    }
}