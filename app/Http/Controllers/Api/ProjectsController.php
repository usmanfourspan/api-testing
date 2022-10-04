<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
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
        Project::create($request->validated());
        return response()->json(['message' => 'The project is created successfully.'], Response::HTTP_CREATED);
    }

}
