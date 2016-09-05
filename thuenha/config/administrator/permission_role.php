<?php

/**
 * Directors model config
 */

return array(

  'title' => 'Permission Role',

  'single' => 'permission_role',

  'model' => 'App\Permission_role',

  /**
   * The display columns
   */
  'columns' => array(
    'id' => array(
      'title' => 'ID'
    ),
    'permission' => array(
      'title' => 'Permission',
      'relationship' => 'permission',
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
    'id' => array(
      'title' => 'ID'
    ),
    'permission' => array(
      'title' => 'Permission',
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
    'id' => array(
      'title' => 'ID',
      'type' => 'number',
    ),
    'permission' => array(
      'title' => 'Permission',
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
