<?php
namespace App\Http\Controllers\api\v1\auth\dao;

use App\Http\BaseRepositories\BaseRepository;
use App\Http\Controllers\api\v1\auth\dao\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
