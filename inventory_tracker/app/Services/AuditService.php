<?php

namespace App\Services;

use Spatie\Activitylog\Models\Activity;

class AuditService
{
    public function getAllActivities()
    {
        // Return a query builder instead of a collection
        return Activity::with('causer', 'subject')->latest();
    }

    public function getActivitiesByUser($userId)
    {
        // Return a query builder instead of a collection
        return Activity::causedBy($userId)->with('subject')->latest();
    }

    public function getActivitiesByModel($modelType)
    {
        // Return a query builder instead of a collection
        return Activity::where('subject_type', $modelType)
            ->with('causer', 'subject')
            ->latest();
    }

    public function getActivitiesBetweenDates($startDate, $endDate)
    {
        // Return a query builder instead of a collection
        return Activity::whereBetween('created_at', [$startDate, $endDate])
            ->with('causer', 'subject')
            ->latest();
    }

    public function getActivitiesByAction($action)
    {
        return Activity::where('description', $action) // Assuming 'description' stores the action
            ->with('causer', 'subject')
            ->latest();
    }
}
