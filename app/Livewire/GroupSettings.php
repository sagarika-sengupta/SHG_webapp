<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GroupSettings as GroupSettingsModel; // Alias model name because of the conflict below in class name
use Illuminate\Support\Facades\Log;


class GroupSettings extends Component
{
    public $max_members;
    public $monthly_contribution;
    public $group_id;


    public function updateMaxMembers()
    {
        $group_id=session('group_id');
                    Log::info('Updating max_members', [
                        'group_id' => $group_id,
                        'max_members' => $this->max_members
                    ]);
        try {
            GroupSettingsModel::where('group_id', $group_id)
                ->update([
                    'max_members' => $this->max_members,
                ]);
            Log::info('max_members updated successfully');
            session()->flash('message', 'Maximum members successfully changed!');
        } catch (\Exception $e) {
            Log::error('Error updating max_members: ' . $e->getMessage());
        }
    }
    public function updateMonthlyContributionAmount()
    {
        $group_id=session('group_id');
                Log::info('Updating monthly_contribution', [
                    'group_id' => $group_id,
                    'monthly_contribution' => $this->monthly_contribution
                ]);
        try {
            GroupSettingsModel::where('group_id', $group_id)
                ->update([
                    'monthly_contribution' => $this->monthly_contribution,
                ]);
            Log::info('monthly_contribution updated successfully');
            session()->flash('message', 'Monthly contribution amount successfully changed!');
        } catch (\Exception $e) {
            Log::error('Error updating monthly_contribution: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.group-settings')->layout('components.layouts.app', ['theme' => 'theme-group']);
    }
}
