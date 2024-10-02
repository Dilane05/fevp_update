<?php

namespace App\Livewire\Portal\Evaluation\Create;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Evaluation;
use App\Models\ResponseEvaluation;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Traits\WithDataTable;

class Index extends Component
{

    use WithDataTable;

    public $code;
    public $title;
    public $image; // Pour la nouvelle image
    public $currentImage; // Image actuelle
    public $description;
    public $start_date;

    public $end_date;
    public $is_active;
    public $evaluation;
    public $actionType;
    public $responses = [];

    protected $rules = [
        'code' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'is_active' => 'required|boolean',
        'image' => 'image|max:5096', // Limite de 5MB pour l'image
    ];

    public function store()
    {
        $this->validate();

        $path = $this->image->store('evaluation', 'public');

        Evaluation::create([
            'code' => $this->code,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_active' => $this->is_active,
            'image' => $path,
            'user_id' => auth()->user()->id,
        ]);

        $this->resetFields();

        // Close the modal and display success message
        $this->closeModalAndFlashMessage(__('Évaluation créée avec succès!'), 'CreateEvaluationModal');
    }

    public function resetFields()
    {
        $this->code = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->is_active = '';
    }


    public function calculateRemainingTime($endDate)
    {
        $now = Carbon::now();
        $end = Carbon::parse($endDate);
        return $end->diffForHumans($now, [
            'syntax' => Carbon::DIFF_ABSOLUTE,
            'parts' => 3,
            'short' => true,
        ]);
    }

    public function initData($id)
    {
        $this->evaluation = Evaluation::findOrFail($id);

        if ($this->is_active == 1) {
            $this->actionType = 'désactiver';
        } else {
            $this->actionType = 'clôturer';
        }

        $this->code = $this->evaluation->code;
        $this->title = $this->evaluation->title;
        $this->description = $this->evaluation->description;
        $this->start_date = $this->evaluation->start_date ? \Carbon\Carbon::parse($this->evaluation->start_date)->format('Y-m-d') : null;
        $this->end_date = $this->evaluation->end_date ? \Carbon\Carbon::parse($this->evaluation->end_date)->format('Y-m-d') : null;
        $this->currentImage = $this->evaluation->image; // Charger l'image actuelle
        $this->is_active = $this->evaluation->is_active;

        // Récupérer les réponses associées à cette évaluation
        $this->responses = ResponseEvaluation::where('evaluation_id', $id)
            ->with('user')
            ->get();
    }

    public function update()
    {
        $this->validate();

        $this->evaluation->update([
            'code' => $this->code,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            // 'image' => $path,
            'end_date' => $this->end_date,
        ]);

        // Si une nouvelle image a été uploadée, on remplace l'ancienne
        if ($this->image) {
            $imageName = $this->image->store('evaluation', 'public'); // Enregistre la nouvelle image

            $this->evaluation->update([
                'image' => $imageName,
            ]);
        }

        $this->resetFields();

        // Close the modal and display success message
        $this->closeModalAndFlashMessage(__('Évaluation Mise à avec succès!'), 'EditEvaluationModal');
    }

    public function confirmAction()
    {
        if ($this->actionType === 'désactiver') {
            $this->evaluation->update(['is_active' => false]);
            session()->flash('message', 'Évaluation désactivée avec succès.');
        } elseif ($this->actionType === 'clôturer') {
            $this->evaluation->update(['is_active' => true]);
            session()->flash('message', 'Évaluation clôturée avec succès.');
        }

        $this->resetFields();
        // Close the modal and display success message
        $this->closeModalAndFlashMessage(__('Évaluation Mise à avec succès!'), 'CloseOrDeactivateModal');
    }

    public function delete()
    {
        // if (!Gate::allows('evaluation.create')) {
        //     return abort(401);
        // }

        if (!empty($this->evaluation)) {
            $this->evaluation->forceDelete();
        }

        $this->clearFields();
        $this->closeModalAndFlashMessage(__('Évaluation Suprimmée avec succès!'), 'DeleteModal');
    }


    public function render()
    {

        Carbon::setLocale('fr'); // Set Carbon locale to French

        $evaluations = Evaluation::all();

        $resultCount = 0;

        return view('livewire.portal.evaluation.create.index', compact('evaluations', 'resultCount'))
            ->layout('components.layouts.dashboard');
    }
}
