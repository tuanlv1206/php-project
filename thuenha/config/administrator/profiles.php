<?php

/**
 * Direction model config
 */

return array(

  'title' => 'Profiles',

  'single' => 'profile',

  'model' => 'App\Profile',

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
    'register_name' => array(
      'title' => 'Register Name',
    ),
    'email' => array(
      'title' => 'eEmail',
    ),
    'mobile_phone' => array(
      'title' => 'Mobile Phone',
    ),
    'home_phone' => array(
      'title' => 'Home Phone',
    ),
    'city' => array(
      'title' => 'City',
      'relationship' => 'city',
      'select' => '(:table).name',
    ),
    'district' => array(
      'title' => 'District',
      'relationship' => 'district',
      'select' => '(:table).name',
    ),
    'facebook' => array(
      'title' => 'Facebook',
    ),
    'skype' => array(
      'title' => 'Skype',
    ),
    'image' => array(
      'title' => 'Image',
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
    'register_name' => array(
      'title' => 'Register Name',
    ),
    'email' => array(
      'title' => 'eEmail',
    ),
    'mobile_phone' => array(
      'title' => 'Mobile Phone',
    ),
    'home_phone' => array(
      'title' => 'Home Phone',
    ),
    'city' => array(
      'title' => 'City',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'district' => array(
      'title' => 'District',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'facebook' => array(
      'title' => 'Facebook',
    ),
    'skype' => array(
      'title' => 'Skype',
    ),
    'image' => array(
      'title' => 'Image',
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
      'title' => 'Name',
    ),
    'register_name' => array(
      'title' => 'Register Name',
    ),
    'email' => array(
      'title' => 'eEmail',
    ),
    'mobile_phone' => array(
      'title' => 'Mobile Phone',
    ),
    'home_phone' => array(
      'title' => 'Home Phone',
    ),
    'city' => array(
      'title' => 'City',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'district' => array(
      'title' => 'District',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'facebook' => array(
      'title' => 'Facebook',
    ),
    'skype' => array(
      'title' => 'Skype',
    ),
    'image' => array(
      'title' => 'Image',
    ),
  ),

);
