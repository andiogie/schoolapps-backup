<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Trait Blamable
 * 
 * This trait automatically fills the 'created_by' and 'updated_by' fields
 * of a model with the ID of the currently authenticated user.
 */
trait Blamable
{
    /**
     * The "booting" method of the trait.
     *
     * This method is called when a model using this trait is booted.
     * It registers model event listeners to populate the blamable fields.
     */
    protected static function bootBlamable()
    {
        // Before creating a new record, set the 'created_by' and 'updated_by' fields.
        static::creating(function ($model) {
            // Check if there is an authenticated user
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        // Before updating an existing record, set the 'updated_by' field.
        static::updating(function ($model) {
            // Check if there is an authenticated user
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }
}
