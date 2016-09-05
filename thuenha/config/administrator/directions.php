<?php

/**
 * Direction model config
 */

return array(

  'title' => 'Directions',

  'single' => 'direction',

  'model' => 'App\Direction',

  /**
   * The display columns
   */
  'columns' => array(
    'id' => array(
      'title' => 'ID',
    ),
    'name' => array(
      'title' => 'Name',
    ),
    'slug' => array(
      'title' => 'Slug',
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
    'slug' => array(
      'title' => 'Slug'
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
    'name' => array(
      'title' => 'Tên',
      'type' => 'text',
    ),
    'slug' => array(
      'title' => 'Slug',
      'type' => 'text',
    ),
  ),

);
