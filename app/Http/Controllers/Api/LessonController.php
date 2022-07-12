<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLesson;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module)
    {
        $lessons = $this->lessonService->getLessonsByModule($module);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateLesson $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLesson $request, $module)
    {
        $lesson = $this->lessonService->createNewLesson($request->validated());
        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($module, $identify)
    {
        $lesson = $this->lessonService->getLessonByModule($module, $identify);
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLesson $request, $module, $identify)
    {
        $this->lessonService->updateLesson($identify, $request->validated());

        return response()->json(['message' => 'updated'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy($module, $identify)
    {
        $this->lessonService->deleteLesson($identify);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
