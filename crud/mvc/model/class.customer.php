<?php
require 'interfaceDatabaseObject.php';

class Customer implements DatabaseObject {

    private $name;
    private $id;
    private $email;
    private $mobile;

    public function __construct($name, $email, $mobile)
    {
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
    }

    public function getList()
    {
        $pdo = Database::connect();
        $sql = 'SELECT * FROM customers ORDER BY id DESC';
        $result = $pdo->query($sql);
        $resultArray = $result->fetchAll();

        return $resultArray;
        }


   public function save()
    {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE customers  set name = ?, email = ?, mobile =? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($this->name,$this->email,$this->mobile,$this->id));
        Database::disconnect();

    }


    public function get($id)
    {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customers where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        return new Customer ($name, $email, $mobile);


    }


    /**
     * Getter for some private attributes
     * @return mixed $property
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }

    /**
     * Setter for some private attributes
     * @return mixed $name
     * @return mixed $value
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

     /**
      * Creates a new object in the database
      * @return integer ID of the newly created object (lastInsertId)
      */
     public function create()
     {
         $cont = Database::connect();
         $cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
         $q = $cont->prepare($sql);
         $q->execute(array($this->name,$this->email,$this->mobile));


         return $cont->lastInsertId();
     }

     /**
      * Deletes the object from the database
      * @return boolean true on success
      */
     public function delete()
     {
         $cont = Database::connect();
         $cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "DELETE FROM customers  WHERE id = ?";
         $q = $cont->prepare($sql);
         $q->execute(array($this->id));

     }
 }
?>

