<?php

namespace App\Livewire\Portal\Evaluation\Response;

use Livewire\Component;
use App\Models\Evaluation;
use App\Models\ResponseEvaluation;
use App\Livewire\Traits\WithDataTable;
use Dompdf\Dompdf;
use Dompdf\Options;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithDataTable;

    public $evaluation;
    public $selectAlls = false; // État du checkbox maître
    public $selectedResponses = []; // Réponses sélectionnées par l'utilisateur
    public $recupResponses; // Toutes les réponses récupérées

    public function mount($code)
    {
        // Récupérer l'évaluation correspondante au code
        $this->evaluation = Evaluation::where('code', $code)->first();
        $this->recupResponses = ResponseEvaluation::where('evaluation_id', $this->evaluation->id)->get();
    }

    /**
     * Méthode pour gérer la sélection/désélection de toutes les réponses
     */
    public function toggleselectAlls()
    {
        if ($this->selectAlls) {
            // Si 'selectAlls' est vrai, sélectionner toutes les réponses
            $this->selectedResponses = $this->recupResponses->pluck('id')->toArray();
        } else {
            // Sinon, désélectionner toutes les réponses
            $this->selectedResponses = [];
        }
    }

    /**
     * Méthode pour exporter les réponses sélectionnées sous forme de fichiers PDF et les regrouper dans un fichier ZIP
     */
    public function exportMultiple()
    {
        // Récupérer toutes les réponses sélectionnées
        $responses = ResponseEvaluation::whereIn('id', $this->selectedResponses)->get();

        if ($responses->isEmpty()) {
            session()->flash('error', 'Aucune réponse trouvée pour l\'exportation');
            return;
        }

        // Créer un fichier ZIP pour regrouper les PDF
        $zip = new ZipArchive();
        $zipFileName = 'responses_' . $this->evaluation->code . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Configurer Dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);

            foreach ($responses as $response) {
                // Générer un fichier PDF pour chaque réponse
                $dompdf = new Dompdf($options);

                $evaluation = $this->evaluation;

                $rows = $response->bilan_resultat;

                // Charger la vue PDF avec les données de la réponse
                $html = view('livewire.portal.evaluation.response.pdf_response', compact('response','evaluation','rows'))->render();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                // Ajouter le fichier PDF au fichier ZIP
                $pdfOutput = $dompdf->output();
                $zip->addFromString('evaluation' . $response->user->name. $response->user->occupation . '.pdf', $pdfOutput);
            }

            // Fermer le fichier ZIP
            $zip->close();

            // Télécharger le fichier ZIP et supprimer après l'envoi
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            session()->flash('error', 'Impossible de créer le fichier ZIP');
        }
    }

    /**
     * Méthode pour rendre la vue avec les réponses récupérées et paginées
     */
    public function render()
    {
        // Récupérer et paginer les réponses de l'évaluation en fonction de la requête de recherche
        $responses = ResponseEvaluation::search($this->query)
            ->where('evaluation_id', $this->evaluation->id)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.portal.evaluation.response.index', compact('responses'))
            ->layout('components.layouts.dashboard');
    }
}
