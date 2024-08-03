<?php

namespace App\Http\Controllers\api;

use App\Events\UserInvited;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Projet;
use App\Models\Tache;
use App\Models\User;
use App\Notifications\UserInvitedNotification;
use Illuminate\Http\Request;


class ProjetController extends Controller
{
    public function inviteUser(Request $request, int $id)
    {
        $user = User::where('email', $request->input('email'))->firstOrFail();
        $project = Projet::find($id);
        $invitation = Invitation::create([
            'user_id' => $user->id,
            'status' => 'en attente',
        ]);
        $project->invitations()->create($invitation);
        $user->notify(new UserInvitedNotification($project, $invitation));
        event(new UserInvited($user, $project, $invitation));
        return response()->json($project, 201);
    }

    public function acceptInvitation(int $id)
    {
        $invitation = Invitation::find($id);
        $invitation->update(['status' => 'accepter']);
        return response()->json(['message' => 'Invitation accepted'], 200);
    }

    public function declineInvitation(int $id)
    {
        $invitation = Invitation::find($id);
        $invitation->update(['status' => 'refuser']);

        return response()->json(['message' => 'Invitation declined']);
    }

    public function index()
    {
        $myAllProjet = Projet::where('id_responsable', auth()->user()->id)->get();
        return response()->json($myAllProjet);
    }

    public function show(Projet $projet)
    {
        return response()->json($projet);
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        $projet = auth()->user()->projets()->create($data);
        return response()->json($projet);
    }

    public function update(Request $request, int $id)
    {
        $projet = Projet::find($id);
        $request->validate([

            'nom' => 'required',
            'description' => 'required',
            'date_debut' => 'required|date|after:now',
            'date_fin' => 'required|date|after:date_debut',
        ]);
        $projet->update($request->all());
        return response()->json($projet, 200);
    }

    public function destroy(Projet $projet)
    {
        $projet->delete();
        return response()->json($projet);
    }

    public function setStatus(Request $request, int $id)
    {
        $projet = Projet::find($id);
        $request->validate([
            'etat' => 'required',
        ]);
        if ($projet->id_responsable == auth()->user()->id) {
            $projet->etat = $request->etat;
            $projet->save();
            return response()->json($projet, 200);
        } else {
            return response()->json(['message' => 'Permission denied'], 403);
        }
    }
}
