<?php
  /**
   * Created by PhpStorm.
   * User: zayt
   * Date: 7/11/2018
   * Time: 1:24 PM
   */

  class Bicycle
  {
    // ----- START OF ACTIVE RECORD CODE -----
    protected static $database;
    protected static $db_columns = ['brand', 'model', 'year', 'category','color', 'gender', 'price', 'weight_kg', 'condition_id', 'description'];

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

    public function create()
    {
      $attributes = $this->sanitized_attributes();

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
    // ----- END OF ACTIVE RECORD CODE -----

    public $id;
    public $brand;
    public $model;
    public $year;
    public $category;
    public $color;
    public $description;
    public $gender;
    public $price = 0.0;
    protected $weight_kg = 0.0;
    protected $condition_id;

    public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Cruiser', 'City', 'BMX'];

    public const GENDERS = ['Mens', 'Womens', 'Unisex'];

    public const CONDITION_OPTIONS = [
      1 => 'Beat up',
      2 => 'Decent',
      3 => 'Good',
      4 => 'Great',
      5 => 'Like New'
    ];

    public function __construct($args=[])
    {
      $this->brand = $args['brand'] ?? NULL;
      $this->model = $args['model'] ?? NULL;
      $this->year = $args['year'] ?? NULL;
      $this->category = $args['category'] ?? NULL;
      $this->color = $args['color'] ?? NULL;
      $this->description = $args['description'] ?? NULL;
      $this->gender = $args['gender'] ?? NULL;
      $this->condition_id = $args['condition_id'] ?? 3;
      $this->weight_kg = $args['weight_kg'] ?? 0.0;
      $this->price = $args['price'] ?? 0.0;

      // Caution: allows private/protected properties to be set
//      foreach ($args as $k => $v) {
//        if (property_exists($this, $k)) {
//          $this->$k = $v;
//        }
//      }
    }

    public function name()
    {
      return "{$this->brand} {$this->model} {$this->year}";
    }

    public function weight_kg()
    {
      return number_format($this->weight_kg, 2) . ' kg';
    }

    public function set_weight_kg($val)
    {
      $this->weight_kg = floatval($val);
    }

    public function weight_lbs()
    {
      $weight_lbs =  floatval($this->weight_kg) * 2.205;
      return number_format($weight_lbs, 2) . ' lbs';
    }

    public function set_weight_lbs($val)
    {
      $this->weight_kg = floatval($val) / 2.205;
    }

    public function condition()
    {
      if ($this->condition_id > 0) {
        return self::CONDITION_OPTIONS[$this->condition_id];
      } else {
        return 'Unknown';
      }
    }
  }

  // Testing Class
  /*$params = ['brand'=> 'Trek', 'model'=> 'Emonda', 'year'=> '2017','category'=> 'Hybrid', 'gender'=> 'Unisex', 'color'=> 'black', 'weight_kg' => 1.5, 'condition_id' => 5,'price' => 1495.00];

  $trek = new Bicycle($params);

  echo $trek->condition() . '<br />';
  echo $trek->weight_kg() . '<br />';
  echo $trek->weight_lbs() . '<br />';*/