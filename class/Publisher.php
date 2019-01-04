<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29/06/18
 * Time: 14:29
 */

class Publisher
{
    protected $publisherName;
    protected $id;

    /**
     * @return mixed
     */
    public function getPublisherName()
    {
        return $this->publisherName;
    }

    /**
     * @param mixed $publisherName
     */
    public function setPublisherName($publisherName)
    {
        $this->publisherName = $publisherName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}