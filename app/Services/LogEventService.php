<?php

namespace App\Services;

use App\Models\LogEvent;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class LogEventService
{
    private $model;

    public function __construct()
    {
        $this->model = new LogEvent();
    }

    public function findById(int $user_id, ?bool $throw_exception = true): ?LogEvent
    {
        $user = $this->model->find($user_id);
        throw_if($throw_exception && is_null($user),
        new Exception("LogEvent Not Found.", 404));
        return $user;
    }

    public function findAll(): ?Collection
    {
        return $this->model->all();
    }

    public function create(array $data): ?LogEvent
    {
        try {
            return $this->model->create($data);
        } catch (Exception $ex) {
            throw new Exception("Error: {$ex->getMessage()}", 400);
        }
    }

    public function update(int $user_id, array $data): ?LogEvent
    {
        try {
            $user = $this->findById($user_id);
            $user->update($data);
            return $user;
        } catch (Exception $ex) {
            throw new Exception("Error: {$ex->getMessage()}", 400);
        }
    }
}
