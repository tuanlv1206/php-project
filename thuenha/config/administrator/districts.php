<?php

/**
 * Direction model config
 */

return array(

  'title' => 'Districts',

  'single' => 'district',

  'model' => 'App\District',

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
    'type' => array(
      'title' => 'Type',
    ),
    'city' => array(
      'title' => 'City',
      'relationship' => 'city',
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
    'name' => array(
      'title' => 'Name'
    ),
    'slug' => array(
      'title' => 'Slug'
    ),
    'type' => array(
      'title' => 'Type',
      'type' => 'enum',
      'options' => array('Quận' => 'Quận', 'Huyện' => 'Huyện', 'Thị Xã' => 'Thị Xã'),
    ),
    'city' => array(
      'title' => 'City',
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
    'name' => array(
      'title' => 'Tên',
      'type' => 'text',
    ),
    'slug' => array(
      'title' => 'Slug',
      'type' => 'text',
    ),
    'type' => array(
      'title' => 'Type',
      'type' => 'enum',
      'options' => array('Quận' => 'Quận', 'Huyện' => 'Huyện', 'Thị Xã' => 'Thị Xã'),

    ),
    'city' => array(
      'title' => 'City',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
  ),

);
