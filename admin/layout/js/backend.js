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

    var passField = $('.password');
    $('.showpass').hover(function(){
        passField.attr('type', 'text');
    },function(){
        passField.attr('type', 'password');
    });

    $('.confirm').click(function(){
        return confirm('Are you sure to delete record');
    });
    
    // $('.confirm').on('click', function(){
    //     $.confirm({
    //         title: 'Confirm!',
    //         content: 'Simple confirm!',
    //         buttons: {
    //             confirm: function(){
    //                 $.alert('Confirmed!');
    //             },
    //             cancel: function(){
    //                 $.alert('Canceled!');
    //             },
    //             somethingElse: {
    //                 text: 'Something else',
    //                 btnClass: 'btn-blue',
    //                 keys: [
    //                     'enter',
    //                     'shift'
    //                 ],
    //                 action: function(){
    //                     this.$content // reference to the content
    //                     $.alert('Something else?');
    //                 }
    //             }
    //         }
    //     });
    // });

});

