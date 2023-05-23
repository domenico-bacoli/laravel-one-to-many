<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $formData = $request->all();

        $newProject = new Project();
        
        $newProject->title = $formData['title'];
        $newProject->thumb = $formData['thumb'];
        $newProject->link = $formData['link'];
        $newProject->languages = $formData['languages'];
        $newProject->description = $formData['description'];
        $newProject->slug = Str::slug($formData['title'], '-');

        $newProject->save();

        return redirect()->route('admin.projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {   
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validation($request);
        $formData = $request->all();

        $project->slug = Str::slug($formData['title'], '-');
        $project->update($formData);

        $project->save();

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validation($request) {
        $formData = $request->all();

        $validator = Validator::make($formData, [
            'title' => 'required|max:200',
            'thumb' => 'required|',
            'link' => 'required|max:30',
            'languages' => 'required|max:20',
            'description' => 'required',

        ], [
            'title.required' => 'inserisci un titolo',
            'title.max' => 'massimo 200 caratteri',
            'thumb.required' => "inserisci una url per l'anteprima",
            'description.required' => 'inserisci una descizione',
        ])->validate();

        return $validator;
    }
}
