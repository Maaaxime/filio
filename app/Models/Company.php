<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
