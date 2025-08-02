<?php

namespace App\Observers;

use App\Models\Dischargue;

class DischargueObserver
{
    /**
     * Handle the Dischargue "created" event.
     */
    public function created(Dischargue $dischargue): void
    {
        //
    }

    /**
     * Handle the Dischargue "updated" event.
     */
    public function updated(Dischargue $dischargue): void
    {
        //
    }

    /**
     * Handle the Dischargue "deleted" event.
     */
    public function deleted(Dischargue $dischargue): void
    {
        //
    }

    /**
     * Handle the Dischargue "restored" event.
     */
    public function restored(Dischargue $dischargue): void
    {
        //
    }

    /**
     * Handle the Dischargue "force deleted" event.
     */
    public function forceDeleted(Dischargue $dischargue): void
    {
        //
    }
}
