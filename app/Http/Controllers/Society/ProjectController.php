<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Society;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    private $activePage;

    public function __construct()
    {
        $this->activePage = "projects";
    }

    public function index()
    {
        return view('society.projects.add_projects', array('activePage' => $this->activePage));
    }

    public function view()
    {
        $projects = Project::all();
        return view('society.projects.view_projects', array('activePage' => $this->activePage, 'projects' => $projects));
    }

    public function store(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $project = new Project();
        $project->society_id = Auth::user()->society->id;
        $project->name = $request->name;
        $project->type = $request->type;
        $project->start_date = $request->start_date;
        $project->area = $request->area;
        if ($request->file('image')) {
            $path = $request->file('image')->store('public/images/project');
            $project->image = asset($path);
        }
        $project->save();

        $fcm_server_key='AAAAtBeKKck:APA91bGl6DnMOG4ynoYMGYDX3s-a7UHVTE4f_IwylJALynRx13Sidtg3UlY8JrpDlUMJ79jT3utGDUOX6VxBxmcCJKe4TdRBzFlsHgy5Nqk41kaKtEQ4pPbYCA3_fQedCVOcp8CDcTKG';
        $notificationData = [
            'to' =>$user->notification_token,
            'collapse_key' => "type_a",
            'notification' => [
                'title' => $request->title,
                'body' => $request->body,
                'image' => $project->image,
            ],
            'data' => [
                'type' => 'Request',
                //'role' => $role,
            ]
        ];

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notificationData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization:key='.$fcm_server_key));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_exec($ch);
        curl_close($ch);

        return redirect('society/projects')->with('success', 'Project Create Successfully');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('society.projects.edit', array('activePage' => $this->activePage, 'project' => $project));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->society_id = Auth::user()->society->id;
        $project->name = $request->name;
        $project->type = $request->type;
        $project->start_date = $request->start_date;
        $project->area = $request->area;
        if ($request->file('image')) {
            $path = $request->file('image')->store('public/images/project');
            $project->image = asset($path);
        }
        $project->save();

        return redirect('society/projects')->with('success', 'Project Update Successfully');
    }
}

