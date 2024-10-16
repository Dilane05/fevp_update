<?php

namespace App\Services;

use App\Models\ResponseEvaluation;
use Illuminate\Support\Facades\Auth;

class EvaluationAuthorizationService
{
    /**
     * Retourne les permissions pour les actions sur une évaluation donnée.
     *
     * @param ResponseEvaluation $response
     * @return array
     */
    public function getPermissions(ResponseEvaluation $response): array
    {
        $user = Auth::user();
        $permissions = [
            'can_do_evaluate1' => null,
            'can_do_n1' => null,
            'can_do_n2' => null,
            'can_do_evaluate2' => null
        ];

        // Si l'utilisateur est l'évalué et que l'évaluation est envoyée
        if ($user->id === $response->user_id && $response->is_send) {
            $permissions['can_do_evaluate1'] = 'disabled';
        }

        // Si l'utilisateur est N+1 et que l'évaluation est dans la phase N+1
        elseif ($user->id === $response->responsable_n1 && $response->in_n1) {
            $permissions['can_do_n1'] = 'disabled';
        }

        // Si l'utilisateur est N+2 et que l'évaluation est dans la phase N+2
        elseif ($response->is_n2) {
            $permissions['can_do_n2'] = 'disabled';
        }

        // Si l'utilisateur est l'évalué et qu'il a déjà fait son commentaire final
        elseif ($user->id === $response->user_id && $response->my_comment) {
            $permissions['can_do_evaluate2'] = 'disabled';
        }

        return $permissions;
    }
}
