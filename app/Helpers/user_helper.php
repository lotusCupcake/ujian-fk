<?php
function getSpecificUser($id)
{
    $model = new \Modules\ManajemenAkun\Models\ManajemenAkunModel;
    $result = $model->getSpecificUser(['users.id' => $id])->getResult()[0];
    return $result;
}
