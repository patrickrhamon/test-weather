<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function findById(int $user_id, ?bool $throw_exception = true): ?User
    {
        $user = $this->model->find($user_id);
        throw_if($throw_exception && is_null($user),
        new Exception("User Not Found.", 404));
        return $user;
    }

    public function findAll(): ?Collection
    {
        return $this->model->all();
    }

    public function create(array $data): User
    {
        try {
            return $this->model->create($data);
        } catch (Exception $ex) {
            return response()->json([
                "message" => "Error: {$ex->getMessage()}"
            ], 400);
        }
    }

    public function update(int $user_id, array $data): User
    {
        try {
            $user = $this->findById($user_id);
            $user->update($data);
            return $user;
        } catch (Exception $ex) {
            return response()->json([
                "message" => "Error: {$ex->getMessage()}"
            ], 400);
        }
    }
}
