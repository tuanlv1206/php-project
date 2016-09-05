$(function() {

  // Build title suggestion
  var buildTitleSuggestion = function() {
    var titleSuggestion = '';
    var type = '';
    var street = '';
    var ward = '';
    var district = '';
    var square = '';
    var price = '';

    if ($('#type').val() != '')
      type = $('#type option:selected').text();
    if ($('#street').val() != '')
      street = $('#street option:selected').text();
    if ($('#ward').val() != '')
      ward = $('#ward option:selected').text();
    if ($('#district').val() != '')
      district = $('#district option:selected').text();
    square = $('#square').val().trim();
    price = $('#price').val().trim();

    var location = '';
    if (street != '' || ward != '' || district != '') {
      location = 'tại ';
      if (street != '')
        location = location + street + ',';
      if (ward != '') {
        if (location[location.length - 1] == ',') // Last character is ,
          location = location + ' ' + ward + ',';
        else
          location = location + ward + ',';
      }
      if (district != '') {
        if (location[location.length - 1] == ',') // Last character is ,
          location = location + ' ' + district + ',';
        else
          location = location + district + ',';
      }
      location = location.substr(0, location.length - 1); // Remove last character
    }
    if (type != '' && location != '') {
      titleSuggestion = type + ' ' + location;
      if (square != '')
        titleSuggestion = titleSuggestion + ' diện tích ' + square + 'm2';
      if (price != '')
        titleSuggestion = titleSuggestion + ' giá ' + price + ' triệu/tháng';
    }
    // Set title suggestion for the label
    $('#title-suggestion').text(titleSuggestion);
    // If type and location are identify, the title suggestion container is visible
    if (titleSuggestion != '')
      $('#title-suggestion-container').show();
    else
      $('#title-suggestion-container').hide();
  }

  //  Initial bootstrap select
  $('.house .selectpicker').selectpicker({
    width: '100%'
  });

  // Fire event select box changed when page load
  setTimeout(function() {
    $('#district').trigger('change');
  }, 10);

  $('#district').bind('change', function() {
    // Get list of wards when district is changed
    // Get the default value of ward select option
    var default_ward = $('#ward [value=""]').text();

    // Clear all data in wards select option
    $('#ward').empty();

    // Append a default value
    $('#ward').append($('<option>').text(default_ward).attr('value', ''));

    $.ajax({
      type: 'POST',
      url: '/ajax/getWardsByDistrictId',
      data: {'id': $(this).val()},
      dataType: 'json',
      success: function(result) {
        // Init new data for ward select option
        $.each(result, function(i, value) {
            $('#ward').append($('<option>').text(value).attr('value', i));
        });
        $('#ward').val($('#ward_hidden_id').val());
        $('#ward').selectpicker('refresh');
        buildTitleSuggestion();
      }
    });

    // Get list of streets when district is changed
    // Get the default value of street select option
    var default_street = $('#street [value=""]').text();

    // Clear all data in streets select option
    $('#street').empty();

    // Append a default value
    $('#street').append($('<option>').text(default_street).attr('value', ''));

    $.ajax({
      type: 'POST',
      url: '/ajax/getStreetsByDistrictId',
      data: {'id': $(this).val()},
      dataType: 'json',
      success: function(result) {
        // Init new data for street select option
        $.each(result, function(i, value) {
            $('#street').append($('<option>').text(value).attr('value', i));
        });
        $('#street').val($('#street_hidden_id').val());
        $('#street').selectpicker('refresh');
      }
    });
  });
  $('#type').bind('change', function() {
    buildTitleSuggestion();
  });
  $('#ward').bind('change', function() {
    buildTitleSuggestion();
  });
  $('#street').bind('change', function() {
    buildTitleSuggestion();
  });
  $('#square').bind('keyup', function() {
    buildTitleSuggestion();
  });
  $('#price').bind('keyup', function() {
    buildTitleSuggestion();
  });

  // use title suggestion
  $('#use-title-suggestion').bind('click', function() {
    $('#title').val($('#title-suggestion').text());
  });

  // confirm cancellation
  $('#btn-cancel').bind('click', function() {
    if (confirm('Bạn muốn hủy tin đăng này chứ?')) {
      window.location = '/dang-tin';
    }
  });
  $('#btn-cancel-update').bind('click', function() {
    if (confirm('Bạn muốn hủy việc cập nhật này chứ?')) {
      window.location = '/sua-tin/' + $('#house-id').text();
    }
  });
  $('#btn-delete').bind('click', function() {
    if (confirm('Bạn chắc chắn muốn xóa bất động sản này chứ?')) {
      $.ajax({
        type: 'post',
        url: '/ajax/deleteHouse',
        data: {
          _method: 'delete',
          _token : $('input[name=_token]').val(),
          id: $('#house-id').text()
        },
        dataType: 'json',
        success: function(result) {
          if (result.status == '1')
            window.location = '/dang-tin/';
          else
            window.location = '/dang-tin/';
        }
      });
    }
  });

  $('input[type=file]').bootstrapFileInput();
});

//# sourceMappingURL=house.js.map
