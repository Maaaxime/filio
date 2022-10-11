<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\App;

/**
 * App\Models\Child
 *
 * @property int $id
 * @property string $image
 * @property string $first_name
 * @property string $last_name
 * @property int $gender
 * @property string|null $birthdate
 * @property string|null $city_of_birth
 * @property string|null $phone_no
 * @property string|null $email
 * @property string|null $medical_conditions
 * @property string|null $medical_medications
 * @property string|null $medical_allergies
 * @property string|null $blood_type
 * @property string|null $doctor_name
 * @property string|null $doctor_address
 * @property string|null $doctor_phone_no
 * @property string|null $address
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $postCode
 * @property int|null $no_dependant_children
 * @property int|null $no_children_less_7yo
 * @property string|null $legal_regime
 * @property string|null $legal_regime_other
 * @property string|null $legal_tutor1_name
 * @property string|null $legal_tutor1_socialsecurity
 * @property string|null $legal_tutor1_caf
 * @property string|null $legal_tutor1_job_title
 * @property string|null $legal_tutor1_address
 * @property string|null $legal_tutor1_phone_no
 * @property string|null $legal_tutor2_name
 * @property string|null $legal_tutor2_socialsecurity
 * @property string|null $legal_tutor2_caf
 * @property string|null $legal_tutor2_job_title
 * @property string|null $legal_tutor2_address
 * @property string|null $legal_tutor2_phone_no
 * @property string|null $authorized_persons
 * @property string|null $contract_starting_date
 * @property string|null $contract_ending_date
 * @property float|null $annual_resources
 * @property float|null $children_care_expenses
 * @property float|null $alimony_paid
 * @property float|null $applicable_rate
 * @property string|null $contract_edited_at
 * @property int $schedule_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $full_name
 * @property-read mixed $gender_color
 * @property-read mixed $gender_name
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static Builder|Child active()
 * @method static Builder|Child inactive()
 * @method static Builder|Child newModelQuery()
 * @method static Builder|Child newQuery()
 * @method static Builder|Child orderedByName()
 * @method static Builder|Child query()
 * @method static Builder|Child whereAddress($value)
 * @method static Builder|Child whereAddress2($value)
 * @method static Builder|Child whereAlimonyPaid($value)
 * @method static Builder|Child whereAnnualResources($value)
 * @method static Builder|Child whereApplicableRate($value)
 * @method static Builder|Child whereAuthorizedPersons($value)
 * @method static Builder|Child whereBirthdate($value)
 * @method static Builder|Child whereBloodType($value)
 * @method static Builder|Child whereChildrenCareExpenses($value)
 * @method static Builder|Child whereCity($value)
 * @method static Builder|Child whereCityOfBirth($value)
 * @method static Builder|Child whereContractEditedAt($value)
 * @method static Builder|Child whereContractEndingDate($value)
 * @method static Builder|Child whereContractStartingDate($value)
 * @method static Builder|Child whereCreatedAt($value)
 * @method static Builder|Child whereDoctorAddress($value)
 * @method static Builder|Child whereDoctorName($value)
 * @method static Builder|Child whereDoctorPhoneNo($value)
 * @method static Builder|Child whereEmail($value)
 * @method static Builder|Child whereFirstName($value)
 * @method static Builder|Child whereGender($value)
 * @method static Builder|Child whereId($value)
 * @method static Builder|Child whereImage($value)
 * @method static Builder|Child whereLastName($value)
 * @method static Builder|Child whereLegalRegime($value)
 * @method static Builder|Child whereLegalRegimeOther($value)
 * @method static Builder|Child whereLegalTutor1Address($value)
 * @method static Builder|Child whereLegalTutor1Caf($value)
 * @method static Builder|Child whereLegalTutor1JobTitle($value)
 * @method static Builder|Child whereLegalTutor1Name($value)
 * @method static Builder|Child whereLegalTutor1PhoneNo($value)
 * @method static Builder|Child whereLegalTutor1Socialsecurity($value)
 * @method static Builder|Child whereLegalTutor2Address($value)
 * @method static Builder|Child whereLegalTutor2Caf($value)
 * @method static Builder|Child whereLegalTutor2JobTitle($value)
 * @method static Builder|Child whereLegalTutor2Name($value)
 * @method static Builder|Child whereLegalTutor2PhoneNo($value)
 * @method static Builder|Child whereLegalTutor2Socialsecurity($value)
 * @method static Builder|Child whereMedicalAllergies($value)
 * @method static Builder|Child whereMedicalConditions($value)
 * @method static Builder|Child whereMedicalMedications($value)
 * @method static Builder|Child whereNoChildrenLess7yo($value)
 * @method static Builder|Child whereNoDependantChildren($value)
 * @method static Builder|Child wherePhoneNo($value)
 * @method static Builder|Child wherePostCode($value)
 * @method static Builder|Child whereScheduleId($value)
 * @method static Builder|Child whereUpdatedAt($value)
 * @mixin Eloquent
 */

class Child extends Model
{
    use HasFactory;

    protected $table = 'children';

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
        'gender',
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
        'no_dependant_children',
        'no_children_less_7yo',
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
        'children_care_expenses',
        'alimony_paid',
        'applicable_rate',
        'schedule_id',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('user', function (Builder $builder) {

            $builder = $builder->orderBy('first_name');

            if (Auth::hasUser()) {
                if (Auth::User()->hasPermissionTo('child.list-all')) {
                    return;
                };

                if (Auth::User()->hasPermissionTo('child.list-my')) {
                    $childIds = Auth::User()->children()->allRelatedIds()->toArray();
                    $builder = $builder->whereIn('children.id', $childIds);
                };
            }
        });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    public function getLastNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    public function parents(): string
    {
        return match (true) {
            ($this->legal_tutor1_name == '') && ($this->legal_tutor2_name != '') => $this->legal_tutor2_name,
            ($this->legal_tutor1_name != '') && ($this->legal_tutor2_name == '') => $this->legal_tutor1_name,
            ($this->legal_tutor1_name != '') && ($this->legal_tutor2_name != '') => $this->legal_tutor1_name . ' | ' . $this->legal_tutor2_name,
            default => '',
        };
    }

    public function getGenderNameAttribute(): string
    {
        return match ($this->gender) {
            0 => __('girl'),
            1 => __('boy'),
            default => '',
        };
    }
    public function getGenderColorAttribute(): string
    {
        return match ($this->gender) {
            0 => '#ecacc5',
            1 => '#439cfb',
            default => '',
        };
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function address(): array
    {
        $cityFormat = '';
        switch (true) {
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

    public function formatAsDate($value): string
    {
        if (!empty((int)$value)) {
            $date = Carbon::parse($value);
            return $date->isoFormat('DD/MM/YY');
        }

        return '-';
    }

    public function formatAsDateTime($value): string
    {
        if (!empty((int)$value)) {
            $date = Carbon::parse($value);
            return $date->isoFormat('DD/MM/YY hh:mm:ss');
        }

        return '-';
    }

    public function remainingDaysBeforeBirthday(): int|string
    {
        if (!$this->birthdate)
            return '';

        $today = Carbon::now();
        $today = $today->setTime(0, 0, 0, 0);

        $nextBirthday = Carbon::parse($this->birthdate)->copy()->year(Carbon::now()->year);
        $nextBirthday->setTime(0, 0, 0, 0);
        if ($nextBirthday->isPast()) {
            $nextBirthday = $nextBirthday->copy()->addYear();
        }

        $noOfDays = $today->diffInDays($nextBirthday);

        if ($noOfDays <= 30)
            return $today->diffInDays($nextBirthday);

        return 0;
    }

    public function age(): string
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
            case ($noOfMonth > 36):
                $diffForHumans = $today->locale(App::currentLocale())->diffForHumans($birthday, true, false);
                break;
            case (($noOfMonth > 12) && ($noOfMonth < 24)):
                $diffForHumans = (12 + $today->diff($birthday->copy()->addYear())->format('%m')) . ' ' .  __('message.months');
                break;
            default:
                $diffForHumans = $today->diff($birthday)->format('%y') . ' ' .  __('message.years') .  ' ' .  __('message.and') . ' ' . $today->diff($birthday)->format('%m') . ' ' .  __('message.months');
                break;
        }
        return  $diffForHumans;
    }

    public function scopeActive($query, $dateFilters = null)
    {
        if (isset($dateFilters)) {
            $query->where(function ($query) use ($dateFilters) {
                $query->where('contract_starting_date', '<=', $dateFilters["firstDay"]->toDateString())->orWhereNull('contract_starting_date');
            })->where(function ($query) use ($dateFilters) {
                $query->where('contract_ending_date', '>=', $dateFilters["lastDay"]->toDateString())->orWhereNull('contract_ending_date');
            });
        } else {
            $query->where(function ($query) {
                $query->where('contract_starting_date', '<=', new DateTime())->orWhereNull('contract_starting_date');
            })->where(function ($query) {
                $query->where('contract_ending_date', '>=', new DateTime())->orWhereNull('contract_ending_date');
            });
        }
    }

    public function scopeInactive($query)
    {
        $query->where(function ($query) {
            $query->where('contract_starting_date', '>', new DateTime());
        })->orWhere(function ($query) {
            $query->where('contract_ending_date', '<', new DateTime());
        });
    }

    public function scopeOrderedByName($query)
    {
        $query->where(function ($query) {
            $query->orderBy('first_name', 'asc');
        });
    }

    public function isActive(): bool
    {
        return ((empty((int)$this->contract_ending_date)) || ((!empty((int)$this->contract_ending_date)) && ($this->contract_ending_date > (new DateTime()))));
    }

    public function showCurrentAttendanceEntry()
    {
        $timeEntry = AttendanceEntry::whereChildId($this->id)
            ->whereNull('time_end')
            ->first();

        if ($timeEntry != null)
            return 'Check-Out';

        return 'Check-In';
    }

    public function hasOpenAttendanceEntry(): bool
    {
        return AttendanceEntry::whereChildId($this->id)
            ->whereBetween('time_start', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])
            ->whereNull('time_end')->count() > 0;
    }

    public function todaysAttendanceEntries(): array|Collection|\Illuminate\Support\Collection
    {
        return AttendanceEntry::whereChildId($this->id)
            ->whereBetween('time_start', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->get();
    }
}
