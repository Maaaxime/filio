<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $postCode
 * @property string $phoneNo
 * @property string $phoneNo2
 * @property string $email
 * @property string $homePage
 * @property string $registrationNo
 * @property int $typeId
 * @property string $bankName
 * @property string $bankAccountNo
 * @property string $bankIBAN
 * @property string $bankSWIFTCode
 * @property string $cafEmail
 * @property string $cafCaseNo
 * @property string $cafSiasCaseNo
 * @property mixed $brandPicture
 * @property string $brandColorCode
 * @property int $systemIndicatorId
 * @property string $systemIndicatorCustomText
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 * @method static Builder|Company whereAddress($value)
 * @method static Builder|Company whereAddress2($value)
 * @method static Builder|Company whereBankAccountNo($value)
 * @method static Builder|Company whereBankIBAN($value)
 * @method static Builder|Company whereBankName($value)
 * @method static Builder|Company whereBankSWIFTCode($value)
 * @method static Builder|Company whereBrandColorCode($value)
 * @method static Builder|Company whereBrandPicture($value)
 * @method static Builder|Company whereCafCaseNo($value)
 * @method static Builder|Company whereCafEmail($value)
 * @method static Builder|Company whereCafSiasCaseNo($value)
 * @method static Builder|Company whereCity($value)
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereEmail($value)
 * @method static Builder|Company whereHomePage($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereName($value)
 * @method static Builder|Company wherePhoneNo($value)
 * @method static Builder|Company wherePhoneNo2($value)
 * @method static Builder|Company wherePostCode($value)
 * @method static Builder|Company whereRegistrationNo($value)
 * @method static Builder|Company whereSystemIndicatorCustomText($value)
 * @method static Builder|Company whereSystemIndicatorId($value)
 * @method static Builder|Company whereTypeId($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'address2',
        'city',
        'postCode',
        'country',
        'phoneNo',
        'phoneNo2',
        'email',
        'homePage',
        'registrationNo',
        'typeId',
        'bankName',
        'bankBranchNo',
        'bankAccountNo',
        'bankIBAN',
        'bankSWIFTCode',
        'cafEmail',
        'cafCaseNo',
        'cafSiasCaseNo',
        'brandPicture',
        'brandColorCode',
        'systemIndicatorId',
        'systemIndicatorCustomText',
    ];
}
