<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'dob',
        'gender',
        'address',
        'phone',
        'position',
        'delete',
        'remember_token',
        'image'
    ];

    protected $modelClass = User::class;
    protected $table = 'users';

    /**
     * Lấy tất cả dữ liệu
     * @return mixed: mảng
     */
    function getAll() {
        $model = $this->modelClass;
        return $model::where('position', 1)
            ->where('delete', false)
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }
}
