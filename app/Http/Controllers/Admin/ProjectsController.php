<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectsRequest;
use App\Http\Requests\Admin\UpdateProjectsRequest;

class ProjectsController extends Controller
{
    const IMAGE_RESIZE_NAME = 'projectPreview';

    /**
     * Display a listing of Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('project_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('project_delete')) {
                return abort(401);
            }
            $projects = Project::onlyTrashed()->get();
        } else {
            $projects = Project::all();
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating new Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('project_create')) {
            return abort(401);
        }

        $cities = \App\City::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.projects.create', compact('cities'));
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param  \App\Http\Requests\StoreProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectsRequest $request)
    {
        if (! Gate::allows('project_create')) {
            return abort(401);
        }
        $project = Project::create($this->getFormattedData($request->all()));

        if ($request->hasFile('preview_image')) {
            $project->saveImage([
                'image_name' => 'preview_image',
                'file' => $request->file('preview_image'),
                'resize_setting' => static::IMAGE_RESIZE_NAME
            ]);
        }


        return redirect()->route('admin.projects.index');
    }


    /**
     * Show the form for editing Project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('project_edit')) {
            return abort(401);
        }

        $cities = \App\City::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $project = $this->findOrFailWithTranslation($id);

        return view('admin.projects.edit', compact('project', 'cities'));
    }

    /**
     * Update Project in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectsRequest $request, $id)
    {
        if (! Gate::allows('project_edit')) {
            return abort(401);
        }

        $project = Project::findOrFail($id);
        $project->update($this->getFormattedData($request->all()));

        if ($request->hasFile('preview_image')) {
            $project->saveOrUpdateByName([
                'file' => $request->file('preview_image'),
                'old_image_path' => $project->preview_image_path,
                'image_name' => 'preview_image',
                'resize_setting' => static::IMAGE_RESIZE_NAME,
            ]);
        }


        return redirect()->route('admin.projects.index');
    }


    /**
     * Display Project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('project_view')) {
            return abort(401);
        }
        $project = $this->findOrFailWithTranslation($id);

        return view('admin.projects.show', compact('project'));
    }


    /**
     * Remove Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Delete all selected Project at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Project::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Permanently delete Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->route('admin.projects.index');
    }

    protected function getFormattedData($request)
    {
        $data = $request;
        $languages = [config('custom.language_ru'), config('custom.language_en')];

        foreach ($languages as $lang) {
            $data[$lang] = [
                'title' => $request['title_' . $lang] ?? '',
                'additional' => $request['additional_' . $lang] ?? '',
                'additional_multi' => $request['additional_multi_' . $lang] ?? '[]',
            ];
        }

        return $data;
    }

    protected function findOrFailWithTranslation($id)
    {
        $project = Project::findOrFail($id);
        $languages = [config('custom.language_ru'), config('custom.language_en')];

        foreach ($languages as $lang) {
            $project_temp = $project->translate($lang);
            $project->{'title_' . $lang} = $project_temp->title;
            $project->{'additional_' . $lang} = $project_temp->additional;
            $project->{'additional_multi_' . $lang} = $project_temp->additional_multi;
        }

        return $project;
    }
}
