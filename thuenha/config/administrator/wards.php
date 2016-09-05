<?php

/**
 * Direction model config
 */

return array(

  'title' => 'Wards',

  'single' => 'ward',

  'model' => 'App\Ward',

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
    'district' => array(
      'title' => 'District',
      'relationship' => 'district',
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
      'options' => array('Phường' => 'Phường', 'Xã' => 'Xã', 'Thị Trấn' => 'Thị Trấn'),
    ),
    'district' => array(
      'title' => 'District',
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
      'options' => array('Phường' => 'Phường', 'Xã' => 'Xã', 'Thị Trấn' => 'Thị Trấn'),
    ),
    'district' => array(
      'title' => 'District',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
  ),

);
