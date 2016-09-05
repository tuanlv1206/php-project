$(function() {
  // move search form to the top on mobile
  function loadSearchForm() {
    if ($(window).width() < 768) {
      $('#panel-search').prependTo('#left-panel');
      $('#panel-search-body').hide();
      $('#panel-search-heading').on('click', function() { // add click event listener
        if ($('#panel-search-body').is(':visible'))
            $('#panel-search-body').hide();
        else
            $('#panel-search-body').show();
      });
    }
    else {
      $('#panel-search').prependTo('#right-panel');
      $('#panel-search-body').show();
      $('#panel-search-heading').off(); // remove all event listener
    }
  }

  $(window).load(function(){
      loadSearchForm();
  });

  $('#reset-search').click(function(event) {
    // reset all fields
    $('#keyword').val('');
    $('#type').val('');
    $('#district').val('');
    $('#district').trigger('change');
    $('#square-min').val('');
    $('#square-max').val('');
    $('#price-min').val('');
    $('#price-max').val('');
    $('#beds').val('');
    $('#direction').val('');

    $('#type').selectpicker('refresh');
    $('#district').selectpicker('refresh');
    $('#beds').selectpicker('refresh');
    $('#direction').selectpicker('refresh');


    return false;
  });

  $('#advanced-search').click(function(event) {
    // display all advanced fields
    $('.advanced-field').show();
    $('#advanced-search').hide();
    $('#remove-advanced-search').show();

    return false;
  });

  $('#remove-advanced-search').click(function(event) {
    // hide all advanced fields
    $('.advanced-field').hide();
    $('#advanced-search').show();
    $('#remove-advanced-search').hide();

    // reset values of all advanced fields
    $('#ward').val('');
    $('#street').val('');
    $('#beds').val('');
    $('#direction').val('');

    $('#ward').selectpicker('refresh');
    $('#street').selectpicker('refresh');
    $('#beds').selectpicker('refresh');
    $('#direction').selectpicker('refresh');


    return false;
  });

  //  Initial bootstrap select
  $('.selectpicker').selectpicker({
    width: '100%'
  });

  $('#district').bind('change', function() {
    console.log($('#ward option:selected').text());
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
        $('#ward').selectpicker('refresh');
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
        $('#street').selectpicker('refresh');
      }
    });
  });

  if ($('#af_visibility').val() == true) {
    $('.advanced-field').show();
    $('#advanced-search').hide();
    $('#remove-advanced-search').show();
  }
});
