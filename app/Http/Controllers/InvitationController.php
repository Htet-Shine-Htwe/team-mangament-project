<?php

namespace App\Http\Controllers;

use App\Enums\InvitationStatus;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class InvitationController extends Controller
{
    public function generateInvitation(int $senderId,int $workspaceId,string $email)
    {
        $invitationId = Uuid::uuid4()->toString();

        $sender = User::find($senderId);
        $workspace = Workspace::find($workspaceId); // Replace with the actual workspace ID

        $invitation = Invitation::create([
            'id' => $invitationId,
            'email' => $email, // Replace with the actual email
            'sender_id' => $sender->id,
            'workspace_id' => $workspace->id,
            'status' => InvitationStatus::PENDING,
        ]);
        // Return the invitation URL to the user
        return [
            'url' => url('/')."/invitations/{$invitationId}",
            'id' => $invitationId
        ];
    }

    public function acceptInvitation(Request $request, Invitation $invitation)
    {
        // Retrieve the workspace associated with the invitation
        $workspace = $invitation->workspace;

        // Check if the invitation is still valid
        if (!$invitation->isValid()) {
            return redirect()->route('home')->with('error', 'Invalid invitation');
        }

        // Perform any additional checks or validations here

        // Accept the invitation
        // ...

        // Redirect the user to the workspace or any other desired page
        return redirect()->route('workspace.show', ['workspace' => $workspace]);
    }
}
