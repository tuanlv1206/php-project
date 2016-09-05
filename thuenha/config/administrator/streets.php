<?php

/**
 * Direction model config
 */

return array(

  'title' => 'Streets',

  'single' => 'street',

  'model' => 'App\Street',

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
      'type' => 'key',
    ),
    'name' => array(
      'title' => 'Tên',
      'type' => 'text',
    ),
    'slug' => array(
      'title' => 'Slug',
      'type' => 'text',
    ),
    'district' => array(
      'title' => 'District',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
  ),

);
