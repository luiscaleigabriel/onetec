<?php
namespace app\database\models;

class User extends Model
{
    protected string $table = 'usuario';
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
