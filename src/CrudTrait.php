<?php
/**
 * Created by PhpStorm.
 * User: Antonin Sajboch
 * Date: 4/1/18
 * Time: 3:00 PM
 */
namespace Nutillea\Crud;

use Nutillea\TableView\ActionControl\Action;
use Nutillea\TableView\TableColumn;
use Nutillea\TableView\TableControl;
use Nette\Application\UI\Form;

trait CrudTrait {

    /** @var string @persistent */
    public $action;

    /** @var string @persistent */
    public $id;

    /** @var CrudFactory */
    protected $crudFactory;

    public abstract function onCreate(Form $form, $data);

    public abstract function onUpdate(Form $form, $data);

    public abstract function onDelete($id);

    public abstract function fillUpdateForm($id, Form &$form);

    /** @return CrudFactory */
    public abstract function getCrudFactory();

    /** @return Form */
    public function getCreateForm(){
        return $this->getCrudFactory()->createCreateForm();
    }

    /** @return Form */
    public function getUpdateForm(){
        return $this->getCrudFactory()->createUpdateForm();
    }

    /** @return TableControl */
    public abstract function getListView();


    public function createComponentList(){
        $listView = $this->getListView();
        $listView->addAction('update', Action::EDIT, $this->lazyLink('update'));
        $listView->addAction('delete', Action::DELETE, $this->lazyLink('delete!'));
        return $listView;
    }

    public function createComponentCreate(){
        $createForm = $this->getCreateForm();
        $createForm->addSubmit('create', 'Create');
        $createForm->onSuccess[] = [$this, 'onCreateSubmitted'];
        return $createForm;
    }

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