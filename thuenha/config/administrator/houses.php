<?php

/**
 * Direction model config
 */

return array(

  'title' => 'Houses',

  'single' => 'house',

  'model' => 'App\House',

  /**
   * The display columns
   */
  'columns' => array(
    'id' => array(
      'title' => 'ID',
    ),
    'type' => array(
      'title' => 'Type',
      'relationship' => 'type',
      'select' => '(:table).name',
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
    'ward' => array(
      'title' => 'Ward',
      'relationship' => 'ward',
      'select' => '(:table).name',
    ),
    'street' => array(
      'title' => 'Street',
      'relationship' => 'street',
      'select' => '(:table).name',
    ),
    'address' => array(
      'title' => 'Address',
    ),
    'square' => array(
      'title' => 'Square',
    ),
    'price' => array(
      'title' => 'Price',
    ),
    'title' => array(
      'title' => 'Title',
    ),
    'slug' => array(
      'title' => 'Slug',
    ),
    'description' => array(
      'title' => 'Description',
    ),
    'avatar' => array(
      'title' => 'Avatar',
      'output' => '<img src="/uploads/images/thumbs/(:value)" height="100"/>',
    ),
    'beds' => array(
      'title' => 'Beds',
    ),
    'toilets' => array(
      'title' => 'Toilets',
    ),
    'floors' => array(
      'title' => 'Floors',
    ),
    'facade' => array(
      'title' => 'Facade',
    ),
    'direction' => array(
      'title' => 'Direction',
      'relationship' => 'direction',
      'select' => '(:table).name',
    ),
    'frontline' => array(
      'title' => 'Frontline',
    ),
    'owner_name' => array(
      'title' => 'Owner Name',
    ),
    'owner_phone' => array(
      'title' => 'Owner Phone',
    ),
    'owner_additional_phone' => array(
      'title' => 'Owner Additional Phone',
    ),
    'owner_birth_year' => array(
      'title' => 'Owner Birth Year',
    ),
    'owner_gender' => array(
      'title' => 'Owner Gender',
    ),
    'status' => array(
      'title' => 'Status',
    ),
    'approved' => array(
      'title' => 'Approved',
    ),
    'author' => array(
      'title' => 'Author',
      'relationship' => 'author',
      'select' => '(:table).name',
    ),
    'created_at' => array(
      'title' => 'Created At',
    ),
    'updated_at' => array(
      'title' => 'Updated At',
    ),
    'deleted_at' => array(
      'title' => 'Deleted At',
    ),
  ),

  /**
   * The filter set
   */
  'filters' => array(
    'id' => array(
      'title' => 'ID'
    ),
    'title' => array(
      'title' => 'Title',
    ),
    'city' => array(
      'title' => 'City',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'district' => array(
      'title' => 'District',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'ward' => array(
      'title' => 'Ward',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'street' => array(
      'title' => 'Street',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'address' => array(
      'title' => 'Address',
    ),
    'type' => array(
      'title' => 'Type',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'direction' => array(
      'title' => 'Direction',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'status' => array(
      'title' => 'Status',
      'type' => 'enum',
      'options' => array('0' => 'Chưa cho thuê', '1' => 'Đã cho thuê'),
    ),
    'approved' => array(
      'title' => 'Approved',
      'type' => 'enum',
      'options' => array('0' => 'Chưa duyệt', '1' => 'Đã duyệt'),
    ),
    'author' => array(
      'title' => 'Author',
      'type' => 'relationship',
      'select' => '(:table).name',
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
    'title' => array(
      'title' => 'Title',
    ),
    'slug' => array(
      'title' => 'Slug',
    ),
    'city' => array(
      'title' => 'City',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'district' => array(
      'title' => 'District',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'ward' => array(
      'title' => 'Ward',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'street' => array(
      'title' => 'Street',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'address' => array(
      'title' => 'Address',
    ),
    'type' => array(
      'title' => 'Type',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'direction' => array(
      'title' => 'Direction',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
    'square' => array(
      'title' => 'Square',
      'type' => 'number',
      'decimals' => 2,
    ),
    'price' => array(
      'title' => 'Price',
      'type' => 'number',
      'decimals' => 2,
    ),
    'description' => array(
      'title' => 'Description',
      'type' => 'textarea',
    ),
    'beds' => array(
      'title' => 'Beds',
      'type' => 'number',
    ),
    'toilets' => array(
      'title' => 'Toilets',
      'type' => 'number',
    ),
    'floors' => array(
      'title' => 'Floors',
      'type' => 'number',
    ),
    'facade' => array(
      'title' => 'Facade',
      'type' => 'number',
      'decimals' => 2,
    ),
    'frontline' => array(
      'title' => 'Frontline',
      'type' => 'number',
      'decimals' => 2,
    ),
    'avatar' => array(
      'title' => 'Avatar',
      'type' => 'image',
      'location' => public_path() . '/uploads/images/originals/',
      'naming' => 'random',
      'length' => 20,
      'size_limit' => 20,
      'sizes' => array(
        array(200, 200, 'landscape', public_path() . '/uploads/images/thumbs/', 100),
      )
    ),
    'status' => array(
      'title' => 'Status',
      'type' => 'enum',
      'options' => array('0' => 'Chưa cho thuê', '1' => 'Đã cho thuê'),
    ),
    'approved' => array(
      'title' => 'Approved',
      'type' => 'enum',
      'options' => array('0' => 'Chưa duyệt', '1' => 'Đã duyệt'),
    ),
    'author' => array(
      'title' => 'Author',
      'type' => 'relationship',
      'select' => '(:table).name',
    ),
  ),
);
