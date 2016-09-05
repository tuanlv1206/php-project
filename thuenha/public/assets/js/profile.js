
$(function(){

  // Initial bootstrap select
  $('.profile .selectpicker').selectpicker({
    width: '100%'
  });
  $('input[type=file]').bootstrapFileInput();
  // create confirm cancellation
  $('#profile-btn-cancel').bind('click',function(){
    if(confirm('Bạn có muốn hủy đăng ký hồ sơ này chứ')){
      window.location='/tao-ho-so';
    }
  });
  // update confirm cancellation
  $('#profileupd-btn-cancel').bind('click',function(){
    if(confirm('Bạn có muốn hủy sửa hồ sơ này chứ')){
      window.location='/sua-ho-so';
    }
  });

});

//# sourceMappingURL=profile.js.map
