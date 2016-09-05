<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | as the size rules. Feel free to tweak each of these messages here.
  |
  */

  'accepted'             => ':attribute must be accepted.',
  'active_url'           => ':attribute không phải là URL hợp lệ.',
  'after'                => ':attribute phải là một ngày sau :date.',
  'alpha'                => ':attribute chỉ có thể bao gồm các chữ cái.',
  'alpha_dash'           => ':attribute chỉ có thể bao gồm các chữ cái, số, dấu - và dấu _.',
  'alpha_num'            => ':attribute chỉ có thể bao gồm các chữ cái và số.',
  'array'                => ':attribute phải là một mảng.',
  'before'               => ':attribute phải là một ngày trước :date.',
  'between'              => [
      'numeric' => ':attribute phải nằm giữa :min và :max.',
      'file'    => ':attribute phải nằm giữa :min và :max kb.',
      'string'  => ':attribute phải nằm giữa :min và :max ký tự.',
      'array'   => ':attribute phải có giữa :min và :max phần tử.',
  ],
  'boolean'              => ':attribute phải là đúng hoặc sai.',
  'confirmed'            => ':attribute xác nhận không khớp.',
  'date'                 => ':attribute không phải là một ngày hợp lệ.',
  'date_format'          => ':attribute không khớp định dạng :format.',
  'different'            => ':attribute và :other phải khác nhau.',
  'digits'               => ':attribute phải là :digits chữ số.',
  'digits_between'       => ':attribute phải nằm giữa :min and :max chữ số.',
  'email'                => ':attribute phải là địa chỉ email hợp lệ.',
  'exists'               => ':attribute được chọn không hợp lệ.',
  'filled'               => 'Mục :attribute bắt buộc có.',
  'image'                => ':attribute phải là ảnh.',
  'in'                   => ':attribute được chọn không hợp lệ.',
  'integer'              => ':attribute phải là số nguyên.',
  'ip'                   => ':attribute phải là địa chỉ IP hợp lệ.',
  'json'                 => ':attribute phải là chuỗi JSON hợp lệ.',
  'max'                  => [
      'numeric' => ':attribute không thể lớn hơn :max.',
      'file'    => ':attribute không thể lớn hơn :max kb.',
      'string'  => ':attribute không thể lớn hơn :max ký tự.',
      'array'   => ':attribute không thể có nhiều hơn :max phần tử.',
  ],
  'mimes'                => ':attribute phải là một tệp có đuôi: :values.',
  'min'                  => [
      'numeric' => ':attribute phải ít nhất là :min.',
      'file'    => ':attribute phải ít nhất là :min kb.',
      'string'  => ':attribute phải ít nhất :min ký tự.',
      'array'   => ':attribute phải ít nhất :min phần tử.',
  ],
  'not_in'               => ':attribute được chọn không hợp lệ.',
  'numeric'              => ':attribute phải là số.',
  'regex'                => 'Định dạng :attribute không hợp lệ.',
  'required'             => 'Mục :attribute là bắt buộc.',
  'required_if'          => 'Mục :attribute là bắt buộc khi :other là :value.',
  'required_unless'      => 'Mục :attribute là bắt buộc trừ khi :other thuộc các giá trị :values.',
  'required_with'        => 'Mục :attribute là bắt buộc khi :values tồn tại.',
  'required_with_all'    => 'Mục :attribute là bắt buộc khi :values tồn tại.',
  'required_without'     => 'Mục :attribute là bắt buộc khi :values không tồn tại.',
  'required_without_all' => 'Mục :attribute là bắt buộc khi không giá trị nào thuộc :values tồn tại.',
  'same'                 => ':attribute và :other phải khớp.',
  'size'                 => [
      'numeric' => ':attribute phải là :size.',
      'file'    => ':attribute phải là :size kb.',
      'string'  => ':attribute phải là :size ký tự.',
      'array'   => ':attribute phải chứa :size phần tử.',
  ],
  'string'               => ':attribute phải là một chuỗi.',
  'timezone'             => ':attribute phải là vùng hợp lệ.',
  'unique'               => ':attribute đã được sử dụng.',
  'url'                  => 'Định dạng :attribute không hợp lệ.',

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | Here you may specify custom validation messages for attributes using the
  | convention "attribute.rule" to name the lines. This makes it quick to
  | specify a specific custom language line for a given attribute rule.
  |
  */

  'custom' => [
      'attribute-name' => [
          'rule-name' => 'custom-message',
      ],
  ],

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap attribute place-holders
  | with something more reader friendly such as E-Mail Address instead
  | of "email". This simply helps us make messages a little cleaner.
  |
  */

  'attributes' => [
    'type_id' => 'Loại nhà đất',
    'district_id' => 'Quận/Huyện',
    'address' => 'Địa chỉ',
    'square' => 'Diện tích',
    'price' => 'Giá',
    'title' => 'Tiêu đề',
    'description' => 'Mô tả chi tiết',
    'avatar' => 'Ảnh đại diện',
    'rooms' => 'Số phòng',
    'toilets' => 'Số toilet',
    'floors' => 'Số tầng',
    'facade' => 'Mặt tiền',
    'frontline' => 'Đường trước nhà',
    'owner_name' => 'Họ và tên chủ nhà',
    'owner_phone' => 'Điện thoại chủ nhà',
    'owner_additional_phone' => 'Điện thoại phụ chủ nhà',
    'owner_birth_year' => 'Năm sinh chủ nhà',

    'mobile_phone' => 'Di động',
  ],

];
