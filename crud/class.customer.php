<?php
require 'interfaceDatabaseObject.php';

class Customer implements DatabaseObject {

    private $date;
    private $id;
    private $description;
    private $price;

    public function __construct($date, $description, $price)
    {
        $this->date = $date;
        $this->description = $description;
        $this->price = $price;
    }

    public function getList()
    {
        $pdo = Database::connect();
        $sql = 'SELECT * FROM purchase ORDER BY id DESC';
        $result = $pdo->query($sql);
        $resultArray = $result->fetchAll();

        return $resultArray;
        }


   public function save()
    {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE purchase  set date = ?, description = ?, price =? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($this->date,$this->description,$this->price,$this->id));
        Database::disconnect();

    }


    public function get($id)
    {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM purchase where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $date = $data['date'];
        $description = $data['description'];
        $price = $data['price'];
        return new Customer ($date, $description, $price);


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
         $sql = "INSERT INTO purchase (date,description,price) values(?, ?, ?)";
         $q = $cont->prepare($sql);
         $q->execute(array($this->date,$this->description,$this->price));


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
         $sql = "DELETE FROM purchase  WHERE id = ?";
         $q = $cont->prepare($sql);
         $q->execute(array($this->id));

     }
 }
?>

