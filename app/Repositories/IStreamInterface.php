<?php

namespace App\Repositories;

use App\Models\Stream;

interface IStreamInterface{

    public function getAllData();
    public function view($id);
    public function store($data);
    public function update($id,$data);
    public function delete($id);
}

