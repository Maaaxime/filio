<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Children extends Model
{
    use HasFactory;

    protected $table = 'childs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'first_name',
        'last_name',
        'birthdate',
        'city_of_birth',
        'phone_no',
        'email',
        'medical_conditions',
        'medical_medications',
        'medical_allergies',
        'blood_type',
        'doctor_name',
        'doctor_address',
        'doctor_phone_no',
        'address',
        'address2',
        'city',
        'postCode',
        'no_dependant_childs',
        'no_childs_less_7yo',
        'legal_regime',
        'legal_regime_other',
        'legal_tutor1_name',
        'legal_tutor1_socialsecurity',
        'legal_tutor1_caf',
        'legal_tutor1_job_title',
        'legal_tutor1_address',
        'legal_tutor1_phone_no',
        'legal_tutor2_name',
        'legal_tutor2_socialsecurity',
        'legal_tutor2_caf',
        'legal_tutor2_job_title',
        'legal_tutor2_address',
        'legal_tutor2_phone_no',
        'authorized_persons',
        'contract_starting_date',
        'contract_ending_date',
        'annual_resources',
        'child_care_expenses',
        'alimony_paid',
        'applicable_rate'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected function firstName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => ucfirst($value),
        );
    }

    protected function lastName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => ucfirst($value),
        );
    }

    public function parents()
    {
        switch (true) {
            case (($this->legal_tutor1_name == '') && ($this->legal_tutor2_name == '')):
                return '';
                break;
            case (($this->legal_tutor1_name == '') && ($this->legal_tutor2_name != '')):
                return $this->legal_tutor2_name;
                break;
            case (($this->legal_tutor1_name != '') && ($this->legal_tutor2_name == '')):
                return $this->legal_tutor1_name;
                break;
            case (($this->legal_tutor1_name != '') && ($this->legal_tutor2_name != '')):
                return $this->legal_tutor1_name . ' | ' . $this->legal_tutor2_name;
                break;
        }
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function address()
    {
        $cityFormat = '';
        switch (true) {
            case (($this->postCode == '') && ($this->city == '')):
                $cityFormat = '';
                break;
            case (($this->postCode == '') && ($this->city != '')):
                $cityFormat = $this->city;
                break;
            case (($this->postCode != '') && ($this->city == '')):
                $cityFormat = $this->postCode;
                break;
            case (($this->postCode != '') && ($this->city != '')):
                $cityFormat = $this->postCode . ' ' . $this->city;
                break;
        }

        $addr = array($this->address, $this->address2, $cityFormat);
        $addr = array_filter($addr, function ($value) {
            return !is_null($value) && $value != '';
        });

        return $addr;
    }

    public function formatAsDate($value)
    {
        if (!empty((int)$value)) {
            $date = Carbon::parse($value);
            return $date->isoFormat('DD/MM/YY');
        }

        return '-';
    }

    public function formatAsDateTime($value)
    {
        if (!empty((int)$value)) {
            $date = Carbon::parse($value);
            return $date->isoFormat('DD/MM/YY hh:mm:ss');
        }

        return '-';
    }

    public function remainingDaysBeforeBirthday()
    {
        if (!$this->birthdate)
            return '';

        $today = Carbon::now();
        $today = $today->setTime(0, 0, 0, 0);

        $nextbirthday = Carbon::parse($this->birthdate)->copy()->year(Carbon::now()->year);
        $nextbirthday->setTime(0, 0, 0, 0);
        if ($nextbirthday->isPast()) {
            $nextbirthday = $nextbirthday->copy()->addYear();
        }

        return $today->diffInDays($nextbirthday);
    }

    public function age()
    {
        $today = Carbon::now()->setTime(0, 0, 0, 0);
        $birthday = Carbon::parse($this->birthdate)->copy()->setTime(0, 0, 0, 0);

        $noOfMonth = $today->diffInMonths($birthday, true);

        $diffForHumans = '';
        switch (true) {
            case ($noOfMonth < 1):
                break;
            case ($noOfMonth % 12 == 0):
            case ($noOfMonth < 12):
                $diffForHumans = $today->locale(App::currentLocale())->diffForHumans($birthday, true, false);
                break;
            case (($noOfMonth > 12) && ($noOfMonth < 24)):
                $diffForHumans = (12 + $today->diff($birthday->copy()->addYear())->format('%m')) . ' ' .  __('message.months');
                break;
            case ($noOfMonth > 36):
                $diffForHumans = $today->locale(App::currentLocale())->diffForHumans($birthday, true, false);
                break;
            default:
                $diffForHumans = $today->diff($birthday)->format('%y') . ' ' .  __('message.years') .  ' ' .  __('message.and') . ' ' . $today->diff($birthday)->format('%m') . ' ' .  __('message.months');
                break;
        }
        return  $diffForHumans;
    }

    public function scopeActive($query)
    {
        $query->where(function ($query) {
            $query->where('contract_ending_date', '>', new \DateTime());
        })->orWhereNull('contract_ending_date');
    }

    public function isActive()
    {
        return ((empty((int)$this->contract_ending_date)) || ((!empty((int)$this->contract_ending_date)) && ($this->contract_ending_date > (new \DateTime()))));
    }
}
