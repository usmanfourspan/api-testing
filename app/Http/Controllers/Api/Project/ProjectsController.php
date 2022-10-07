<?php

namespace App\Http\Controllers\Api\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Models\Project;
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
        Project::create($request->validated());
        return response()->json(['message' => __('messages.project-create')], Response::HTTP_CREATED);
    }

    public function show(Project $project)
    {
        return response()->json([
            'project' => $project
        ]);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json([
           'message' => __('messages.project-delete')
        ]);
    }


}
