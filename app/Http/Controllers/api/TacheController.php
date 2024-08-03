<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use App\Models\Projet;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    private function assignTaskToProject(Request $request, int $project_id)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'date_echeance' => 'required|date|after:now',
        ]);

        $project = Projet::find($project_id);
        $task = Tache::create($request->all());
        $project->tasks()->attach($task);
    }

    private function assignTaskToUser(int $user_id, int $task_id)
    {
        $task = Tache::find($task_id);
        $user = User::find($user_id);
        if ($user) {
            $task->user->id_assigne = $user_id;
            $task->save();
            return response()->json($task, 201);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    private function decommissionTaskToUser(int $user_id, int $task_id)
    {
        $task = Tache::find($task_isd);
        if ($task->projet()->id_responsable == auth()->user()->id) {
            $task->user->id_assigné = null;
            $task->save();
            return response()->json($task, 201);
        } else {
            return response()->json(['message' => 'Permission denied'], 403);
        }
        
        
    }


    private function deleteTask(int $task_id)
    {
        $task = Tache::find($task_id);
        if ($task->projet()->id_responsable == auth()->user()->id) {
            $task->delete();
            return response()->json($task, 200);
        } else {
            return response()->json(['message' => 'Permission denied'], 403);
        }
    }

    public function changeStatus(Request $request, int $id)
    {
        $task = Tache::find($id);
        $request->validate([
            'etat' => 'required',
        ]);
        if ($task->projet()->id_responsable == auth()->user()->id || $task->id_assigne == auth()->user()->id) {
            $task->etat = $request->etat;
            $task->save();
            return response()->json($task, 200);
        } else {
            return response()->json(['message' => 'Permission denied'], 403);
        }
    }

    public function changePriority(Request $request, int $id)
    {
        $task = Tache::find($id);
        $request->validate([
            'priorite' => 'required',
        ]);
        if ($task->projet()->id_responsable == auth()->user()->id) {
            $task->priorite = $request->priorite;
            $task->save();
            return response()->json($task, 200);
        } else {
            return response()->json(['message' => 'Permission denied'], 403);
        }
    }

    public function addComment(Request $request, int $id)
    {
        $task = Tache::find($id);
        $request->validate([
            'texte' => 'required',
        ]);
        $commentaire = Commentaire::create([
            'texte' => $request->texte,
            'utilisateur_id' => auth()->user()->id,
        ]);
        $task->commentaires()->attach($commentaire);
        return response()->json($commentaire, 201);
    }

    public function getAllComments(int $id)
    {
        $task = Tache::find($id);
        return response()->json($task->commentaires, 200);
    }

    public function deleteComment(int $id, int $comment_id)
    {
        $commentaire = Commentaire::find($comment_id);
        if ($commentaire->utilisateur_id == auth()->user()->id) {
            $commentaire->delete();
            return response()->json($commentaire, 200);
        } else {
            return response()->json(['message' => 'Permission denied'], 403);
        }
    }
}
