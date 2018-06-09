<?php
/**
 * Created by PhpStorm.
 * User: Antonin Sajboch
 * Date: 4/1/18
 * Time: 3:00 PM
 */
namespace Nuttilea\Crud;

use Nette\Application\UI\Control;
use Nuttilea\TableControl\ActionControl\Action;
use Nuttilea\TableControl\ITableConnector;
use Nuttilea\TableControl\TableColumn;
use Nuttilea\TableControl\TableControl;
use Nette\Application\UI\Form;

trait CrudTrait {

    /** @var string @persistent */
    public $action;

    public $isAjax = false;

    public $id;

    public abstract function onCreate(Form $form, $data);

    public abstract function onUpdate(Form $form, $data);

    public abstract function onDelete($id);

    public abstract function fillUpdateForm($id, Form &$form);

//    /** @return CrudFactory */
//    public abstract function getCrudFactory();

    /** @return Form */
    public abstract function createCreateForm();

    /** @return Form */
    public abstract function createUpdateForm();

    /** @return Control */
    public abstract function createListView();

    /** @return Form */
    public function getCreateForm(){
        return $this->createCreateForm();
    }

    /** @return Form */
    public function getUpdateForm(){
        return $this->createUpdateForm();
    }

    /** @return Control */
    public function getListView(){
        return $this->createListView();
    }

    /** @return Control */
    public function createComponentList(){
        $listView = $this->getListView();
        $listView->addAction('update', Action::EDIT, $this->lazyLink('update'))->addClass($this->isAjax ? 'ajax' : '');
        $listView->addAction('delete', Action::DELETE, $this->lazyLink('delete!'))->addClass($this->isAjax ? 'ajax' : '');
        return $listView;
    }

    /** @return Control */
    public function createComponentCreate(){
        $createForm = $this->getCreateForm();
        $createForm->addSubmit('create', 'Create');
        $createForm->onSuccess[] = [$this, 'onCreateSubmitted'];
        return $createForm;
    }

    /** @return Control */
    public function createComponentUpdate(){
        $updateForm = $this->getUpdateForm();
        $updateForm->addSubmit('update', 'Update');
        $updateForm->onSuccess[] = [$this, 'onUpdateSubmitted'];
        $this->fillUpdateForm($this->id, $updateForm);
        return $updateForm;
    }

    public function handleDelete($id){
        $this->onDelete($id);
    }

    public function onCreateSubmitted(Form $form){
        $values = $form->getValues(true);
        $values = $this->beforeCreate($values);
        $this->onCreate($form, $values);
    }

    public function onUpdateSubmitted(Form $form){
        $values = $form->getValues(true);
        $values = $this->beforeUpdate($values);
        $this->onUpdate($form, $values);
    }

    public function beforeCreate($data){
        return $data;
    }

    public function beforeUpdate($data){
        return $data;
    }

    public function beforeDelete($data){
        return $data;
    }

    public function getParentTemplateDir() {
        return __DIR__ . '/templates';
    }


}