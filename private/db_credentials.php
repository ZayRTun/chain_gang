<?php
  /**
   * Created by PhpStorm.
   * User: zayt
   * Date: 7/13/2018
   * Time: 3:24 PM
   */

  // Keep database credentials in a separated file
  // 1. Easy to exclude this file from source code managers
  // 2. Unique credentials on development and production servers
  // 3. Unique credentials if working with multiple developers

  define("DB_SERVER", "localhost");
  define("DB_USER", "dev");
  define("DB_PASS", "devpass");
  define("DB_NAME", "chain_gang");