$(function(){
    'use strict';

    $('[placeholder]').focus(function(){
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function(){
        $(this).attr('placeholder', $(this).attr('data-text'));
    });
    $('input').each(function(){
        if($(this).attr('required')==='required'){
            $(this).after('<span class="asterisk">*</span>')
        }
    });

    // var passField = $('.password');
    // $('.showpass').hover(function(){
    //     passField.attr('type', 'text');
    // },function(){
    //     passField.attr('type', 'password');
    // });
    

    $('.confirm').click(function(){
        return confirm('Are you sure to delete record');
    });
    
    

});


