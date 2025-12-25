<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
        ];
    }

    /**
     * Common action types
     */
    public const ACTIONS = [
        'created' => 'Created',
        'updated' => 'Updated',
        'deleted' => 'Deleted',
        'login' => 'Logged In',
        'logout' => 'Logged Out',
        'check_in' => 'Checked In',
        'check_out' => 'Checked Out',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'exported' => 'Exported',
    ];

    /**
     * Get the user who performed this action
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the related model (polymorphic)
     */
    public function subject()
    {
        if (!$this->model_type || !$this->model_id) {
            return null;
        }

        return $this->model_type::find($this->model_id);
    }

    /**
     * Scope a query to filter by action
     */
    public function scopeOfAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope a query to filter by model type
     */
    public function scopeForModel($query, $modelType)
    {
        return $query->where('model_type', $modelType);
    }

    /**
     * Scope a query to filter by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to get recent logs
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Get the action label
     */
    public function getActionLabelAttribute(): string
    {
        return self::ACTIONS[$this->action] ?? ucfirst($this->action);
    }

    /**
     * Get the model name (short version)
     */
    public function getModelNameAttribute(): ?string
    {
        if (!$this->model_type) {
            return null;
        }

        return class_basename($this->model_type);
    }

    /**
     * Get action color for UI
     */
    public function getActionColorAttribute(): string
    {
        return match ($this->action) {
            'created' => 'green',
            'updated' => 'blue',
            'deleted' => 'red',
            'login' => 'indigo',
            'logout' => 'gray',
            'check_in' => 'emerald',
            'check_out' => 'amber',
            'approved' => 'green',
            'rejected' => 'red',
            'exported' => 'purple',
            default => 'gray',
        };
    }

    /**
     * Log an activity
     */
    public static function log(
        string $action,
        ?Model $model = null,
        ?array $oldValues = null,
        ?array $newValues = null
    ): self {
        $user = auth()->user();

        return self::create([
            'user_id' => $user?->id,
            'action' => $action,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model?->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
