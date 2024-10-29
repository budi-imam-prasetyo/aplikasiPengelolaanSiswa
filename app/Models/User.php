<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Pastikan Anda menggunakan trait ini

class User extends Authenticatable
{
    use Notifiable, HasRoles; // Pastikan HasRoles di sini

    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Jika Anda ingin menambahkan metode untuk memeriksa role
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists(); // atau gunakan Spatie's method
    }

    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('name', (array) $roles)->exists();
    }

    // Pastikan Anda memiliki relasi roles, jika Anda menggunakan Spatie
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
 
}
