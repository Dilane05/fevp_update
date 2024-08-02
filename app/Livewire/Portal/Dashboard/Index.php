<?php

namespace App\Livewire\Portal\Dashboard;

use App\Models\User;
use Livewire\Component;
use App\Models\AuditLog;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;
    public $role;

    public $categories;
    public $doshaOptions;
    public $dosha;
    public $selections = []; 

    public function mount()
    {
        $this->role = auth()->user()->getRoleNames()->first();

        $this->doshaOptions = [
            'vata' => 'Vata',
            'pitta' => 'Pitta',
            'kapha' => 'Kapha',
        ];

        $this->categories = [
            'Appearance and Functions' => [],
            'Body' => [],
            'Hair' => [],
            'Skin' => [],
            'Eyes' => [],
            'Teeth' => [],
            'Lips' => [],
            'Chin' => [],
            'Neck' => [],
            'Fingers' => [],
            'Stamina' => [],
            'Appetite' => [],
            'Thirst' => [],
            'Body Odor' => [],
            'Speech' => [],
            'Sleep' => [],
            'Weight' => [],
            'Taste Choice' => [],
            'Activities' => [],
            'Weather Preference' => [],
            'Sexual Activities' => [],
            'Sensitivities' => [],
            'Elimination' => [],
            'Mind' => [],
            'Temperament' => [],
            'Memory' => [],
        ];

        // You can pre-populate sample selections here (optional)
        // This example populates "Vata" selections
        if (isset($_GET['dosha']) && $_GET['dosha'] === 'vata') {
            $this->dosha = 'vata';
            $this->selections = [
                // Replace with your sample selections for Vata
                'appearance_and_functions' => 'Light, airy, quick',
                'body' => 'Lean, thin frame',
                // ... and so on for other categories
            ];
        }
    }

    public function render()
    {
        $doshaData = [
            'Vata' => [
                'body_type' => 'Thin and unusually tall or short',
                'body_weight' => 'Low',
                'bone_structure' => 'Light, Small bones with prominent joints',
                'hair' => 'Dry, coarse, curly, brittle',
                'skin' => 'Dry, rough, cool',
                'eyes' => 'Small',
                'teeth' => 'Irregular, crooked and protruded, thin gums',
                'lips' => 'Thin, small and dry',
                'chin' => 'Thin and angular',
                'neck' => 'Thin and tall',
                'fingers' => 'Thin, long and tapering',
                'stamina' => 'Fair',
                'appetite' => 'Changes, light',
                'thirst' => 'Flexible',
                'body_odor' => 'Low, scanty, no smell',
                'speech' => 'Talkative',
                'sleep' => 'Light sleeper',
                'weight' => 'Hard to gain, easy to lose',
                'taste_choice' => 'Sweet, sour and salty',
                'activities' => 'Fast and very active',
                'weather_preference' => 'Warm',
                'mind' => 'Restless, always active',
                'temperament' => 'Nervous, Variable',
                'memory' => 'Easily noticing things but easily forgetting as well',
            ],
            'Pitta' => [
                'body_type' => 'Medium body',
                'body_weight' => 'Moderate',
                'bone_structure' => 'Medium',
                'hair' => 'Soft, fine, often straight, oily, early grey, baldness',
                'skin' => 'Soft, oily, warm',
                'eyes' => 'Medium, sharp',
                'teeth' => 'Moderate, yellowish teeth, soft gums',
                'lips' => 'Medium, soft',
                'chin' => 'Tapering',
                'neck' => 'Medium',
                'fingers' => 'Medium',
                'stamina' => 'Good',
                'appetite' => 'Good, excessive',
                'thirst' => 'Excessive',
                'body_odor' => 'Profuse, hot, strong smell',
                'speech' => 'Purposeful',
                'sleep' => 'Moderate, 6-8 hrs.',
                'weight' => 'Easy to gain and easy to lose',
                'taste_choice' => 'Sweet, bitter and astringent',
                'activities' => 'Medium',
                'weather_preference' => 'Cool',
                'mind' => 'Aggressive, intelligent',
                'temperament' => 'Motivated, ambitious',
                'memory' => 'Sharp',
            ],
            'Kapha' => [
                'body_type' => 'Stout, stocky, or large/broad body',
                'body_weight' => 'Can be overweight',
                'bone_structure' => 'Heavy or dense',
                'hair' => 'Thick, oily, lustrous, wavy, glistening',
                'skin' => 'Thick, oily, cool, pale, glistening',
                'eyes' => 'Big, calm and thick eyelashes',
                'teeth' => 'Regular, strong, white teeth, healthy',
                'lips' => 'Thick, large and smooth',
                'chin' => 'Round and may be double',
                'neck' => 'Big and thick',
                'fingers' => 'Thick, broad and short',
                'stamina' => 'High',
                'appetite' => 'Steady',
                'thirst' => 'Less',
                'body_odor' => 'Moderate, cool, pleasant smell',
                'speech' => 'Less cautiously',
                'sleep' => 'More than 8 hrs',
                'weight' => 'Easy to gain, hard to lose',
                'taste_choice' => 'Pungent, bitter and astringent',
                'activities' => 'Slow and Steady',
                'weather_preference' => 'Enjoys change of weather and seasons',
                'mind' => 'Calm',
                'temperament' => 'Calm, conservative',
                'memory' => 'Slow to take notice but never forget',
            ],
        ];

        $selectedData = [];
        if (isset($this->dosha) && array_key_exists($this->dosha, $doshaData)) {
            $selectedData = $doshaData[$this->dosha];
        }

        $logs = match ($this->role) {
            "supervisor" => AuditLog::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->take(10),
            "manager" => AuditLog::manager()->orderBy('created_at', 'desc')->take(10),
            "admin" => AuditLog::orderBy('created_at', 'desc')->take(10),
            default => AuditLog::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->take(10),
        };

        return view('livewire.portal.dashboard.index', [
            'logs' => $logs,
            'selectedData' => $selectedData,
        ])->layout('components.layouts.dashboard');
    }
}
