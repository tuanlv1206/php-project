<?php

/**
 * Direction model config
 */

return array(

  'title' => 'Images',

  'single' => 'image',

  'model' => 'App\Image',

  /**
   * The display columns
   */
  'columns' => array(
    'id' => array(
      'title' => 'ID',
    ),
    'name' => array(
      'title' => 'Image',
      'output' => '<img src="/uploads/images/originals/(:value)" height="100"/>',
    ),
    'created_at' => array(
      'title' => 'Created At',
    ),
    'updated_at' => array(
      'title' => 'Updated At',
    ),
    'house' => array(
      'title' => 'House',
      'relationship' => 'house',
      'select' => "CONCAT((:table).id, ' - ', (:table).title)",
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
    'house' => array(
      'title' => 'House',
      'type' => 'relationship',
      'name_field' => 'id',
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
      'title' => 'Image',
      'type' => 'image',
      'location' => public_path() . '/uploads/images/originals/',
      'naming' => 'random',
      'length' => 20,
      'size_limit' => 20,
      'sizes' => array(
        array(500, 500, 'portrait', public_path() . '/uploads/images/portraits/', 100),
        array(200, 200, 'landscape', public_path() . '/uploads/images/thumbs/', 100),
      )
    ),
    'house' => array(
      'title' => 'House',
      'type' => 'relationship',
      'name_field' => 'id',
    ),
  ),

);
