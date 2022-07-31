<?php

namespace App\Repositories;

use App\Models\Student;
use DateTime;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

/**
 * Class StudentRepository.
 *
 * @package namespace App\Repositories;
 */
class StudentRepository extends BaseRepository
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    public function createNew($data)
    {
        if ($data instanceof Request) {
            $data = $data->all();
        }

        $student = Arr::only($data, $this->model->getFillable());

        $student = $this->model->create($student);

        return Student::find($student->id);
    }

    public function updateStudent($id, $data)
    {
        if ($id instanceof $this->model) {
            $student = $id;
        } else {
            $student = $this->model->find($id);
        }

        if ($data instanceof Request) {
            $data = $data->all();
        }
        $inputData = Arr::only($data, $this->model->getFillable());

        $student->update($inputData);

        return $student;
    }


}
