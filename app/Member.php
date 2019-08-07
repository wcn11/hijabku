<?php

namespace App;

use App\Notifications\Member\MemberResetPassword;
use App\Notifications\Member\MemberVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Member extends Authenticatable
{
    use Notifiable;

    // protected $table = 'member';
    protected $keyType = "string";
    protected $primaryKey = "id_member";
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_member', 'nama', 'email', 'password', 'telepon', 'profil'
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new MemberVerifyEmail);
    }
    
    public function member_ke_invoice(){
        return $this->hasMany("App\Invoice", "id_member");
    }

}
