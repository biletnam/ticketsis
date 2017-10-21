$(function() {
    //click event for create buttons to call popup
$('.modalone').click(function(){
    $('#modal').modal('show')
    .find('#modalContent')
    .load($(this).attr('value'));
})
});