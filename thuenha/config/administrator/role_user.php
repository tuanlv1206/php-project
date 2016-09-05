<?php

/**
 * Directors model config
 */

return array(

  'title' => 'Role user',

  'single' => 'role_user',

  'model' => 'App\Role_user',

  /**
   * The display columns
   */
  'columns' => array(
    'user' => array(
      'title' => 'User',
      'relationship' => 'user',
      'select' => '(:table).name',
    ),
    'role' => array(
      'title' => 'Role',
      'relationship' => 'role',
      'select' => '(:table).name',
    ),
  ),

  /**
   * The filter set
   */
  'filters' => array(
    'user' => array(
      'title' => 'User',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'role' => array(
      'title' => 'Role',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
  ),

  /**
   * The editable fields
   */
  'edit_fields' => array(
    'user' => array(
      'title' => 'User',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'role' => array(
      'title' => 'Role',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
  ),

);
