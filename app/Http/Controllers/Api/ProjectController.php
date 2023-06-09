<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // recupero tutti i projects
        $projects = Project::orderBy('end_date', 'DESC')

            // uso il 'with' per recuperare l'informazione del type e delle technologies da stampare
            ->with('type', 'technologies')
            ->paginate(9);
        // ->get();

        foreach ($projects as $project) {
            if ($project->image)
                $project->image = url('storage/' . $project->image);
            else
                $project->image = 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';
        }

        // ritorno un file json
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // query per recuperare il project da stampare tramite l'id
        $project = Project::where('id', $id)
            ->with('type', 'technologies')
            ->first();

        if ($project->image)
            $project->image = url('storage/' . $project->image);

        else
            $project->image = 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';

        // se l'id del post non esiste ritorna un'errore 404
        if (!$project) return response(null, 404);

        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
