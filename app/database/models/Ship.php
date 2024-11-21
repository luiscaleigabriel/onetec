<?php
namespace app\database\models;

class Ship extends Model
{
    protected string $table = 'entrega';
    protected array $data;

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }
}
