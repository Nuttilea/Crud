<?php
/**
 * Created by PhpStorm.
 * User: Antonin Sajboch
 * Date: 4/2/18
 * Time: 9:03 PM
 */

class CrudGenerator {

    public function generateCreateLatte(){
        return `
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="btn btn-success" n:href='create'> New item </a>
    <a class="btn btn-default" n:href='default'> Items </a>
</nav>
{block content}
    {control create}
{/block}
        `;
    }

    public function generateUpdateLatte(){
        return `
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="btn btn-success" n:href='create'> New item </a>
    <a class="btn btn-default" n:href='default'> Items </a>
</nav>
{block content}
    {control update}
{/block}
        `;
    }

    public function generateDefaultLatte(){
        return `
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="btn btn-success" n:href='create'> New item </a>
    <a class="btn btn-default" n:href='default'> Items </a>
</nav>
{block content}
    {control list}
{/block}
        `;
    }

    public function generateCrudPresenter(){
        $php = new \Nette\PhpGenerator\PhpFile();
        $namespace = $php->addNamespace('App\AdminModule\Presenters');
    }


    public function generateCrudFactory(){

    }
}