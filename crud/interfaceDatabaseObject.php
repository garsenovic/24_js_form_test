<?php

include 'database.php';

interface DatabaseObject
{
    /**
     * Get an object from database
     * @param integer $id
     * @return object single object
     */
    public function get($id);

    /**
     * Get an array of objects from database
     * @return array array of objects
     */
    public function getList();

    /**
     * Creates a new object in the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function create();

    /**
     * Saves the object to the database
     */
    public function save();

    /**
     * Deletes the object from the database
     * @return boolean true on success
     */
    public function delete();

    /**Tips:
     * •    You can use the database code from the given example.
     * •    PDO lastInsertId is not compatible with MySQL, find some workaround or use mysqli instead
     * •    Implement anonymous getter and setter methods:
     */


}
?>