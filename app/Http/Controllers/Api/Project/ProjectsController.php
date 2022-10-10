<?php

namespace App\Http\Controllers\Api\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $projects = $request->user()->projects;
        return response()->json([
           'projects' => $projects
        ]);
    }

    public function store(CreateProjectRequest $request)
    {
        Project::create($request->validated());
        return response()->json(['message' => __('messages.project-create')], Response::HTTP_CREATED);
    }

    public function show(Project $project, Request $request)
    {
        if ($request->user()->id !== $project->user_id) {
            return response()->json([
               'message' => 'UnAuthorized Action'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'project' => $project
        ]);
    }

    public function destroy(Project $project, Request $request)
    {
        if ($request->user()->id !== $project->user_id) {
            return response()->json([
                'message' => 'UnAuthorized Action'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $project->delete();
        return response()->json([
           'message' => __('messages.project-delete')
        ]);
    }


}
