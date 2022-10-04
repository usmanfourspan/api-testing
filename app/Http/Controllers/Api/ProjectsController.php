<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json([
           'projects' => $projects
        ]);
    }

    public function store(CreateProjectRequest $request)
    {
        $inputData = array_merge($request->validated(), ['uuid' => (string) Str::orderedUuid()]);
        Project::create($inputData);
        return response()->json(['message' => 'The project is created successfully.'], Response::HTTP_CREATED);
    }

}
