<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::where('society_id', Auth::guard('api')->user()->Client->society_id)->get();
        return ProjectResource::collection($project);
    }
}
