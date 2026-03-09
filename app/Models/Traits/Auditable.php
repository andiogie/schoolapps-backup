<?php

namespace App\Models\Traits;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


trait Auditable
{
    protected static function bootAuditable()
    {
        static::created(function (Model $model) {
            static::logActivity($model, 'created');
        });

        static::updated(function (Model $model) {
            static::logActivity($model, 'updated');
        });

        static::deleted(function (Model $model) {
            static::logActivity($model, 'deleted');
        });
    }

    protected static function logActivity(Model $model, string $action)
    {
        // DIPERBAIKI: Logika untuk mendapatkan user/admin yang sedang aktif
        $causer = static::getCauser();

        $oldValues = null;
        $newValues = null;

        if ($action === 'updated') {
            $oldValues = $model->getOriginal();
            $newValues = $model->getAttributes();
        } elseif ($action === 'created') {
            $newValues = $model->getAttributes();
        } elseif ($action === 'deleted') {
            $oldValues = $model->getAttributes();
        }

        ActivityLog::create([
            // DIPERBAIKI: Menggunakan causer polimorfik
            'causer_id' => $causer ? $causer->id : null,
            'causer_type' => $causer ? get_class($causer) : null,
            'auditable_id' => $model->id,
            'auditable_type' => get_class($model),
            'action' => $action,
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }

    /**
     * Dapatkan model yang menyebabkan aktivitas (bisa Admin atau User).
     */
    protected static function getCauser()
    {
        // Cek guard 'admin' terlebih dahulu
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user();
        }

        // Jika tidak, cek guard default ('web')
        if (Auth::check()) {
            return Auth::user();
        }

        // Jika tidak ada yang login
        return null;
    }
}
