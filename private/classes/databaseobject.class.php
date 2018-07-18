<?php
  /**
   * Created by PhpStorm.
   * User: zayt
   * Date: 7/18/2018
   * Time: 3:02 PM
   */

  class DatabaseObject
  {
    static protected $database;
    static protected $table_name = "";
    static protected $columns = [];
    public $errors = [];

    public static function set_database($database)
    {
      self::$database = $database;
    }

    public static function find_by_sql($sql)
    {
      $result =  self::$database->query($sql);
      if (!$result) {
        exit('Database query failed.');
      }

      // Results into objects
      $object_array = [];
      while ($record = $result->fetch_assoc())
      {
        $object_array[] = self::instantiate($record);
      }

      $result->free();

      return $object_array;
    }

    public static function find_all()
    {
      $sql = "SELECT * FROM bicycles";
      return self::find_by_sql($sql);
    }

    public static function find_by_id($id)
    {
      $sql = "SELECT * FROM bicycles ";
      $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
      $obj_array = self::find_by_sql($sql);
      if (!empty($obj_array)) {
        return array_shift($obj_array);
      } else {
        return false;
      }
    }

    protected static function instantiate($record)
    {
      $object = new self();
      // Could manually assign values to properties
      // but automatic assignment is easier and re-usable
      foreach ($record as $property => $value)
      {
        if (property_exists($object, $property)) {
          $object->$property = $value;
        }
      }
      return $object;
    }

    protected function validate()
    {
      $this->errors = [];

      if (is_blank($this->brand)) {
        $this->errors[] = 'Brand cannot be blank.';
      }
      if (is_blank($this->model)) {
        $this->errors[] = 'Model cannot be blank.';
      }
      return $this->errors;
    }

    public function create()
    {
      $this->validate();
      if (!empty($this->errors)) { return false; }

      $attributes = $this->sanitized_attributes();
      // language=<mySQL>
      $sql = "INSERT INTO bicycles (";
      $sql .= join(', ', array_keys($attributes));
      $sql .= ") VALUES ('";
      $sql .= join("', '", array_values($attributes));
      $sql .= "')";
      $result = self::$database->query($sql);
      if ($result) {
        $this->id = self::$database->insert_id;
      }
      return $result;
    }

    public function update()
    {
      $this->validate();
      if (!empty($this->errors)) { return false; }

      $attributes = $this->sanitized_attributes();
      $attribute_pairs = [];
      foreach ($attributes as $key => $value)
      {
        $attribute_pairs[] = "{$key}='{$value}'";
      }
      $sql = "UPDATE bicycles SET ";
      $sql .= join(', ', $attribute_pairs);
      $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
      $sql .= "LIMIT 1";
      $result = self::$database->query($sql);
      return $result;
    }

    public function save()
    {
      // A new record will not have an ID yet
      if (isset($this->id)) {
        return $this->update();
      } else {
        return $this->create();
      }
    }

    public function merge_attributes($args=[])
    {
      foreach ($args as $key => $value)
      {
        if (property_exists($this, $key) && !is_null($value))
        {
          $this->$key = $value;
        }
      }
    }

    // Properties which have database columns, excluding ID
    public function attributes()
    {
      $attributes = [];
      foreach (self::$db_columns as $column)
      {
        if ($column == 'id') { continue; }
        $attributes[$column] = $this->$column;
      }
      return $attributes;
    }

    protected function sanitized_attributes()
    {
      $sanitized = [];
      foreach ($this->attributes() as $key => $value)
      {
        $sanitized[$key] = self::$database->escape_string($value);
      }
      return $sanitized;
    }

    public function delete()
    {
      $sql = "DELETE FROM bicycles ";
      $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
      $sql .= "LIMIT 1";
      $result = self::$database->query($sql);
      return $result;

      // After deleting, the instance of the object will still
      // exist, even though the database record does not.
      // This can be useful, as in:
      //  echo $user->first_name . " was deleted.";
      // but, for example, we can't call $user->update() after
      // calling $user->delete().
    }
  }