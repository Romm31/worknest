<?php

namespace App\Policies;

use App\Models\LeaveRequest;
use App\Models\User;

class LeaveRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin can view all, employee can view their own
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin can view any request
        if ($user->isAdmin()) {
            return true;
        }

        // Employee can only view their own requests
        return $user->employee?->id === $leaveRequest->employee_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only employees can create leave requests
        return $user->isEmployee() && $user->employee !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LeaveRequest $leaveRequest): bool
    {
        // Only admin can update (approve/reject)
        if ($user->isAdmin()) {
            return true;
        }

        // Employee can only update their own pending requests
        if ($user->employee?->id === $leaveRequest->employee_id) {
            return $leaveRequest->isPending();
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin can delete any request
        if ($user->isAdmin()) {
            return true;
        }

        // Employee can only delete their own pending requests
        if ($user->employee?->id === $leaveRequest->employee_id) {
            return $leaveRequest->isPending();
        }

        return false;
    }

    /**
     * Determine whether the user can approve/reject the request.
     */
    public function approve(User $user, LeaveRequest $leaveRequest): bool
    {
        // Only admin can approve/reject, and only pending requests
        return $user->isAdmin() && $leaveRequest->isPending();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->isAdmin();
    }
}
