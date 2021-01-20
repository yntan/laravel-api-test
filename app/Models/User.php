<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'age',
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    public function scopeListUsers($query, $options)
    {
        $email = trim($options->email);
        $phone = trim($options->phone);
        $sortField = $options->sort ?? '';
        $order = $options->order ?? 'asc';
        $count = 0;

        if (strlen($email) && strlen($phone)) {
            $query->where('email', $email)
                ->where('phone', $phone);

        } else {

            if (strlen($email)) {
                $query->where('email', $email);

            } else if (strlen($phone)) {
                $query->where('phone', $phone);
            }
        }

        if (strlen($sortField) && $order) {
            $query->orderBy($sortField, $order);
        }

        return $query;
    }
}
