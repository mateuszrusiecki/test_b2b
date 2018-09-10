var App = {};

App.ajaxPaginate = function(e){
    var that = this;
    $(this).parents('.paginationSlider').block({
        message: 'Ładowanie...'
    }); 
    $.ajax({
        url: $(this).attr('href'),
        dataType: 'html',
        success: function(data) {
            $(that).parents('.ui-tabs-panel').html(data);
        }
    });
    e.stopPropagation();
    return false;
    
};

App.goToPage = function(e){
    var that = this;
    $(this).parents('.paginationSlider').block({
        message: 'Ładowanie...'
    }); 
    $.ajax({
        url: $(this).parents('.paginationSlider').find('span a').eq(0).attr('href').replace(/\/page:[0-9]+/, '/page:'+$(this).attr('value')),
        dataType: 'html',
        success: function(data) {
            $(that).parents('.ui-tabs-panel').html(data);
        }
    });
    e.stopPropagation();
    return false;
};

App.modernLabel = function(input, top, left) {
    if (input.blur(function(){if ($(this).attr('value') == '') {$(this).prev().show();}}).on('click, focus', function() {$(this).prev().hide();}).prev().css({position: 'absolute', top: top+'px', left: left+'px'}).parent('div').css('position', 'relative').find('input').attr('value') != '') $('#ContactEmail').prev().hide();
}