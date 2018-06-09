<?php
/**
 * Created by PhpStorm.
 * User: Antonin Sajboch
 * Date: 4/1/18
 * Time: 4:43 PM
 */

namespace Nuttilea\Crud;


interface ICrudEntityManage {
    public function findById($id);
    public function update($data);
}