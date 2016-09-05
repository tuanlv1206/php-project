<?php

/**
 * Directors model config
 */

return array(

  'title' => 'Permission',

  'single' => 'permission',

  'model' => 'App\Permission',

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
    'display_name' => array(
      'title' => 'Display name',
    ),
    'description' => array(
      'title' => 'Description',
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
      'title' => 'Name',
    ),
    'display_name' => array(
      'title' => 'Display name',
    ),
    'description' => array(
      'title' => 'Description',
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
    'display_name' => array(
      'title' => 'Display name',
      'type' => 'text',
    ),
    'description' => array(
      'title' => 'Description',
      'type' => 'text',
    ),
  ),

);
