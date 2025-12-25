<?php

namespace App\Livewire\Employee\Profile;

use Livewire\Component;

class EmployeeProfile extends Component
{
    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
    {
        $employee = auth()->user()->employee;

        return view('livewire.employee.profile.employee-profile', [
            'employee' => $employee,
        ])->layout('layouts.app', [
                    'sidebar' => view('components.employee-sidebar'),
                    'header' => 'My Profile',
                ]);
    }
}
