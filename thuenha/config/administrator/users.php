<?php

/**
 * Directors model config
 */

return array(

  'title' => 'Users',

  'single' => 'user',

  'model' => 'App\User',

  /**
   * The display columns
   */
  'columns' => array(
    'id' => array(
      'title' => 'ID'
    ),
    'name' => array(
      'title' => 'Name',
    ),
    'email' => array(
      'title' => 'E-mail',
    ),
  ),

  /**
   * The filter set
   */
  'filters' => array(
    'id' => array(
      'title' => 'ID'
    ),
    'name' => array(
      'title' => 'Name'
    ),
    'email' => array(
      'title' => 'E-mail'
    ),
  ),

  /**
   * The editable fields
   */
  'edit_fields' => array(
    'id' => array(
      'title' => 'ID',
      'type' => 'key',
    ),
    'name' => array(
      'title' => 'Name',
      'type' => 'text',
    ),
    'email' => array(
      'title' => 'E-mail',
      'type' => 'text',
    ),
    'password' => array(
      'title' => 'Password',
      'type' => 'password',
    ),
  ),

);
