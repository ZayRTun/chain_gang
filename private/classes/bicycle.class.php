<?php
  /**
   * Created by PhpStorm.
   * User: zayt
   * Date: 7/11/2018
   * Time: 1:24 PM
   */

  class Bicycle
  {
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

    protected const CONDITION_OPTIONS = [
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
      $this->condition_id = $args['condition_id'] ?? NULL;
      $this->weight_kg = $args['weight_kg'] ?? 0.0;
      $this->price = $args['price'] ?? 0.0;

      // Caution: allows private/protected properties to be set
//      foreach ($args as $k => $v) {
//        if (property_exists($this, $k)) {
//          $this->$k = $v;
//        }
//      }
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