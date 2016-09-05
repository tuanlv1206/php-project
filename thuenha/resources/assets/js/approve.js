
$(function(){

  // Initial bootstrap select
  $('.house .selectpicker').selectpicker({
    width: '100%'
  });
  $('input[type=file]').bootstrapFileInput();

  // approve confirm cancellation
  $('#btn-cancel-approve').bind('click',function(){
    if(confirm('Bạn có muốn hủy chỉnh sửa và không duyệt chứ')){
      window.location='/tin-dang-chua-duyet';
    }
  });

  // disapprove confirm cancellation
  $('#btn-cancel-disapprove').bind('click', function(){
    if(confirm('Bạn có muốn hủy chỉnh sửa và không bỏ duyệt chứ')){
      window.location='/tin-da-duyet';
    }
  });

});
