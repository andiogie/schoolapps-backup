<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class EnsureNoOtherKepalaSekolah implements ValidationRule
{
    /**
     * The ID of the guru being currently edited.
     *
     * @var int|null
     */
    protected $currentGuruId;

    /**
     * Create a new rule instance.
     *
     * @param int|null $guruId The ID of the guru to exclude from the check.
     * @return void
     */
    public function __construct($guruId = null)
    {
        $this->currentGuruId = $guruId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // This rule only runs if the checkbox is checked (value is '1' or true).
        if (! $value) {
            return; // If not checked, no validation is needed.
        }

        $query = DB::table('gurus')->where('is_kepala_sekolah', true);

        // If we are editing a guru, exclude them from the query.
        if ($this->currentGuruId) {
            $query->where('id', '!=', $this->currentGuruId);
        }

        // If another kepala sekolah already exists, fail the validation.
        if ($query->exists()) {
            $fail('Hanya boleh ada satu Kepala Sekolah. Jabatan ini sudah diisi oleh guru lain.');
        }
    }
}
