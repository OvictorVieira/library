<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29/06/18
 * Time: 13:03
 */

abstract class People
{
    protected $fullName;
    protected $cpf;
    protected $id;

    abstract public function getFullName();

    abstract public function setFullName($fullName);

    abstract public function getCpf();

    abstract public function setCpf($cpf);

    abstract public function getId();

    abstract public function setId($id);
}