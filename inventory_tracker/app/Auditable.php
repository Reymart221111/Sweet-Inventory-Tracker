<?php

namespace App;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

trait Auditable
{  
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Log all attributes
            ->logOnlyDirty()       // Only log changed attributes
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "{$this->getTable()} has been {$eventName}")
            ->useLogName($this->getTable());
    }

    protected function getAttributesToLog(): array
    {
        return $this->fillable;
    }

    public function getAuditLogs()
    {
        return Activity::forSubject($this)->latest()->get();
    }

    public function getChanges()
    {
        return Activity::forSubject($this)
            ->where('event', '!=', 'created')
            ->latest()
            ->get()
            ->map(function ($activity) {
                return [
                    'changed_by' => $activity->causer?->name ?? 'System',
                    'event' => $activity->event,
                    'old_values' => $activity->properties['old'] ?? [],
                    'new_values' => $activity->properties['attributes'] ?? [],
                    'changed_at' => $activity->created_at
                ];
            });
    }
}
