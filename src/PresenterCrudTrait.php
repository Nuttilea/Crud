<?php
/**
 * Created by PhpStorm.
 * User: Antonin Sajboch
 * Date: 4/1/18
 * Time: 3:02 PM
 */
namespace Nuttilea\Crud;

use Nette\Application\UI\Control;
use Nuttilea\TableControl\ITableConnector;

trait PresenterCrudTrait {
    use CrudTrait;

    /** @return CrudFactory */
    public abstract function getCrudFactory();

    /** @return \Nette\Application\UI\Form */
    public function createCreateForm() {
        return $this->getCrudFactory()->createCreateForm();
    }

    /** @return \Nette\Application\UI\Form */
    public function createUpdateForm() {
        return $this->getCrudFactory()->createUpdateForm();
    }

    /** @return Control */
    public function createListView(ITableConnector $iTableConnector) {
        return $this->getCrudFactory()->createListView($iTableConnector);
    }

}