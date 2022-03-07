<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'name',
        'address',
        'address2',
    ];

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
}
