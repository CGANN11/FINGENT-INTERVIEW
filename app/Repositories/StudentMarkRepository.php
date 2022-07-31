<?php

namespace App\Repositories;

use App\Models\StudentMarkDetail;
use DateTime;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

/**
 * Class StudentMarkRepository.
 *
 * @package namespace App\Repositories;
 */
class StudentMarkRepository extends BaseRepository
{
    public function __construct(StudentMarkDetail $model)
    {
        parent::__construct($model);
    }

    public function createNew($data)
    {
        if ($data instanceof Request) {
            $data = $data->all();
        }

        $studentMarkDetails = Arr::only($data, $this->model->getFillable());

        $studentMarkDetails = $this->model->create($studentMarkDetails);

        return StudentMarkDetail::find($studentMarkDetails->id);
    }

    public function updateStudentMark($data)
    {
        foreach($data['student_mark_id'] as $value) {
            $studentMark = $this->model->find($value);

            $studentMark->mark = $data['mark'][$value];
            $studentMark->save();
        }
        return true;
    }

}
