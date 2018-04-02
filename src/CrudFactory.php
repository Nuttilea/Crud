<?php
/**
 * Created by PhpStorm.
 * User: Antonin Sajboch
 * Date: 4/1/18
 * Time: 5:15 PM
 */

namespace Nutillea\Crud;


use Nutillea\TableView\DibiTableConnector;

abstract class CrudFactory {

    public abstract function createCreateForm();
    public abstract function createUpdateForm();
    public abstract function createListView(DibiTableConnector $connector);

}