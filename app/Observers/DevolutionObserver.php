<?php

namespace App\Observers;

use App\Models\Devolution;
use Illuminate\Support\Facades\Auth;

class DevolutionObserver
{
    /**
     * Handle the Devolution "created" event.
     */
    public function created(Devolution $devolution): void
    {
        //
    }

    /**
     * Handle the Devolution "updated" event.
     */
    public function updated(Devolution $devolution): void
    {
        //
    }

    /**
     * Handle the Devolution "deleted" event.
     */
    public function deleted(Devolution $devolution): void
    {
                $devolution->anulated_by = Auth::id();

    }

    /**
     * Handle the Devolution "restored" event.
     */
    public function restored(Devolution $devolution): void
    {
        //
    }

    /**
     * Handle the Devolution "force deleted" event.
     */
    public function forceDeleted(Devolution $devolution): void
    {
        //
    }
}
