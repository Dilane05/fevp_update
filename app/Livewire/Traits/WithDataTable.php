<?php 

namespace App\Livewire\Traits;

use App\Models\Schedule;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

trait WithDataTable {
    use WithPagination, WithFileUploads;

    //DataTable props
    #[Url]
    public $query = '';
    public ?string $resultCount;
    public string $orderBy = 'created_at';
    public string $orderAsc = 'desc';
    public int $perPage = 15;

    public $selectedItemsToDelete = [];
    public $model_name;

    public $selectAll;

    protected $paginationTheme = "bootstrap";

    public function closeModalAndFlashMessage($message, $modal)  
    {
        $this->dispatch('cancel', modalId: $modal);
        session()->flash('message', $message);
    }

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function initBulkDelete($model)
    {
        $this->model_name = $model;
    }

    public function bulkDelete()
    {
        match ($this->model_name){
            'schedules' => Schedule::wherekey($this->selectedItemsToDelete)->delete(),
            default => ''
        };

        $this->selectedItemsToDelete = [];
        $this->selectAll = '';
        $this->closeModalAndFlashMessage(__('Items successfully Deleted!'), 'DeleteBulkModal');
    }

   

    public function clearSelected()
    {
        $this->selectedItemsToDelete = [];
    }
 
}