<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $guarded =[];
    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('name', 'like', '%'.$term.'%');
        });
    }

    public static function getUserData($id){
        $user= User::select(
            'users.id', 
            'users.id_personal', 
            'users.name as nombre', 
            'users.rfc', 
            'users.celular', 
            'users.email', 
            'p_personal.dtto_loc as distrito_local',
            'p_personal.id_municipio',
            'c_municipio.clave as clave_municipio',
            'c_municipio.municipio',
            'p_personal.id_seccion',
            'c_seccion.seccion',
            DB::raw("(SELECT GROUP_CONCAT(roles.name) FROM `model_has_roles` join roles on roles.id=model_has_roles.role_id  WHERE model_id=users.id) as `roles`")
        )
        ->leftJoin('p_personal', 'p_personal.id', '=', 'users.id_personal')
        ->leftJoin('c_municipio', 'c_municipio.id', '=', 'p_personal.id_municipio')
        ->leftJoin('c_seccion', 'c_seccion.id', '=', 'p_personal.id_seccion')
        ->where('users.id', $id)
        ->orderBy('users.id', 'desc')
        ;

        $user= $user->first();
        return $user;
    }
}
