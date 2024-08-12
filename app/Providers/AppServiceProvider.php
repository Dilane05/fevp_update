<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\Client\Evaluation\CheckoutWizardComponent;
use App\Livewire\Client\Evaluation\Steps\BilanResultatStep;
use App\Livewire\Client\Evaluation\Steps\BonusMalusStep;
use App\Livewire\Client\Evaluation\Steps\ComplianceCorporateCultureStep;
use App\Livewire\Client\Evaluation\Steps\ManagerialQualityStep;
use App\Livewire\Client\Evaluation\Steps\OtherStep;
use App\Livewire\Client\Evaluation\Steps\PersonalInformationStep;
use App\Livewire\Client\Evaluation\Steps\SanctionStep;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('approvalStatusText', function ($status_owner = '', $type = '') {
            $model = $this->getModel();
            if ($model instanceof Ticking || $model instanceof  Leave) {
                $match = match ($status_owner) {
                    'supervisor' => match ($model->supervisor_approval_status) {
                        $model::SUPERVISOR_APPROVAL_PENDING => __('Pending'),
                        $model::SUPERVISOR_APPROVAL_APPROVED => __('Approved'),
                        $model::SUPERVISOR_APPROVAL_REJECTED => __('Rejected'),
                        default => __('Pending'),
                    },
                    'manager' => match ($model->manager_approval_status) {
                        $model::MANAGER_APPROVAL_PENDING => __('Pending'),
                        $model::MANAGER_APPROVAL_APPROVED => __('Approved'),
                        $model::MANAGER_APPROVAL_REJECTED => __('Rejected'),
                        default => __('Pending'),
                    },
                };
            } else {

                if ($type === 'boolean') {
                    $match = match ($model->is_active) {
                        true => __('Active'),
                        false => __('Inactive'),
                        default => __('Inactive'),
                    };
                } else {
                    $match = match ($model->approval_status) {
                        $model::APPROVAL_STATUS_PENDING => __('Pending'),
                        $model::APPROVAL_STATUS_APPROVED => __('Approved'),
                        $model::APPROVAL_STATUS_REJECTED => __('Rejected'),
                        default => __('Pending'),
                    };
                }
            }
            return $match;
        });

        Builder::macro('approvalStatusStyle', function ($status_owner = '', $type = '') {
            $model = $this->getModel();
            if ($model instanceof Ticking || $model instanceof  Leave) {
                $match = match ($status_owner) {
                    'supervisor' => match ($model->supervisor_approval_status) {
                        $model::SUPERVISOR_APPROVAL_PENDING => 'warning',
                        $model::SUPERVISOR_APPROVAL_APPROVED => 'success',
                        $model::SUPERVISOR_APPROVAL_REJECTED => 'danger',
                        default => 'warning',
                    },
                    'manager' => match ($model->manager_approval_status) {
                        $model::MANAGER_APPROVAL_PENDING => 'warning',
                        $model::MANAGER_APPROVAL_APPROVED => 'success',
                        $model::MANAGER_APPROVAL_REJECTED => 'danger',
                        default => 'warning',
                    },
                };
            } else {

                if ($type === 'boolean') {
                    $match = match ($model->is_active) {
                        true => 'success',
                        false => 'danger',
                        default => 'danger',
                    };
                } else {
                    $match = match ($model->approval_status) {
                        $model::APPROVAL_STATUS_PENDING => 'warning',
                        $model::APPROVAL_STATUS_APPROVED => 'success',
                        $model::APPROVAL_STATUS_REJECTED => 'danger',
                        default => 'warning',
                    };
                }
            }
            return $match;
        });

        Livewire::component('checkout-evaluation-wizard', CheckoutWizardComponent::class);
        Livewire::component('create-evaluation-personal_info', PersonalInformationStep::class);
        Livewire::component('create-evaluation-bilan_resultat', BilanResultatStep::class);
        Livewire::component('create-evaluation-mangerial_quality', ManagerialQualityStep::class);
        Livewire::component('create-evaluation-compliance_corporate_culture', ComplianceCorporateCultureStep::class);
        Livewire::component('create-evaluation-bonus_malus', BonusMalusStep::class);
        Livewire::component('create-evaluation-sanctions', SanctionStep::class);
        Livewire::component('create-evaluation-others', OtherStep::class);

    }
}
