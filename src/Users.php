<?php

namespace Tarearecuperacion1;

use PDOException;
use PDO;
use Faker;

class Users extends Conexion
{
    private $id;
    private $nombre;
    private $apellidos;
    private $username;
    private $mail;
    private $pass;

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $q = "insert into users(nombre, apellidos, username, mail, pass) values(:n, :a, :u, :m, :p)";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':a' => $this->apellidos,
                ':u' => $this->username,
                ':m' => $this->mail,
                ':p' => $this->pass
            ]);
        } catch (PDOException $ex) {
            die("Error al crear user: " . $ex->getMessage());
        }
        parent::$conexion = null;
    }

    public function generarUsuarios($cantidad)
    {
        if (!$this->hayUsers()) {
            $faker = Faker\Factory::create('es_ES');
            (new Users)->setNombre("admin")
                ->setApellidos("admin")
                ->setUsername("admin")
                ->setMail("admin@email.net")
                ->setPass("secret0")
                ->create();
            for ($i = 0; $i < $cantidad; $i++) {
                (new Users)->setNombre(ucfirst($faker->words(1, true)))
                    ->setApellidos(ucfirst($faker->words(2, true)))
                    ->setUsername($faker->userName())
                    ->setMail($faker->email())
                    ->setPass($faker->password(5, 10))
                    ->create();
            }
        }
    }

    public function hayUsers()
    {
        $q = "select * from users";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al comprobar si hay users: " . $ex->getMessage());
        }
        parent::$conexion = null;
        return ($stmt->rowCount() != 0);
    }

    public function readAll()
    {
        $q = "select * from users order by id";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al ver si hay users: " . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of pass
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }
}
