<?php

namespace App;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ContentNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_id', 'department_id', 'designation_id', 'first_name', 'last_name', 'father_name', 'mother_name', 'email', 'password', 'password_text', 'gender', 'dob', 'joining_date', 'ending_date', 'phone', 'emergency_phone', 'mother_tongue', 'marital_status', 'blood_group', 'nationality', 'national_id', 'passport_no', 'present_province', 'present_district', 'present_village', 'present_address', 'permanent_province', 'permanent_district', 'permanent_village', 'permanent_address', 'education_level', 'graduation_academy', 'year_of_graduation', 'graduation_field', 'experience', 'note', 'basic_salary', 'contract_type', 'work_shift', 'salary_type', 'bank_account_name', 'bank_account_no', 'bank_name', 'ifsc_code', 'bank_brach', 'tin_no', 'photo', 'signature', 'resume', 'joining_letter', 'is_admin', 'login', 'status', 'created_by', 'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    public function roles()
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles', 'model_id', 'role_id', 'id', 'id');
    }

    public function transactions()
    {
        return $this->morphMany('App\Models\Transaction', 'transactionable');
    }
}
