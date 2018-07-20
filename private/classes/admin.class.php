<?php
  /**
   * Created by PhpStorm.
   * User: zayt
   * Date: 7/20/2018
   * Time: 10:17 AM
   */

  class Admin extends DatabaseObject
  {
    protected static $table_name = 'admins';
    protected static $db_columns = [
      'id',
      'first_name',
      'last_name',
      'email',
      'username',
      'hashed_password'
    ];

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $username;
    protected $hashed_password;
    public $password;
    public $confirm_password;

    public function __construct($args=[])
    {
      $this->first_name = $args['first_name'] ?? '';
      $this->last_name = $args['last_name'] ?? '';
      $this->email = $args['email'] ?? '';
      $this->username = $args['username'] ?? '';
      $this->password = $args['password'] ?? '';
      $this->confirm_password = $args['confirm_password'] ?? '';
    }

    public function full_name()
    {
      return $this->first_name . ' ' . $this->last_name;
    }

    protected function set_hashed_password()
    {
      $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    protected function create()
    {
      $this->set_hashed_password();
      return parent::create();
    }

    protected function update()
    {
      $this->set_hashed_password();
      return parent::update();
    }

    protected function validate()
    {
      $this->errors = [];

      if (is_blank($this->first_name)) {
        $this->errors[] = 'First name cannot be blank.';
      }
      if (is_blank($this->last_name)) {
        $this->errors[] = 'Last name cannot be blank.';
      }
      return $this->errors;
    }
  }