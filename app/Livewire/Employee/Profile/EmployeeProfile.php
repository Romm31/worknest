<?php

namespace App\Livewire\Employee\Profile;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class EmployeeProfile extends Component
{
    public function render(): View
    {
        $employee = auth()->user()->employee;

        return view('livewire.employee.profile.employee-profile', [
            'employee' => $employee,
            'sidebar' => view('components.employee-sidebar')->render(),
            'header' => 'My Profile',
        ]);
    }
}
