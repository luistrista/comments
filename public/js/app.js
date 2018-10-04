$(document).ready(function() {
    $('.comment-link').click(function () {
        $('html, body').animate({scrollTop: $('#name').offset().top - 50}, 500);
        $( "#name" ).focus();
    });

    initFormValidations('newCommentForm');

});

function initFormValidations(idForm) {
    $("#"+idForm).validate({
        ignore: '*:not([name])',
        rules: {
            name: {required: true,maxlength: 255},
            comment: {required: true, maxlength: 500},
        },
        errorPlacement: function(error, element) {
        },
        submitHandler: function (form) {
            ajaxSubmit(form, function (response) {
                $(form)[0].reset();
                if(response.body)
                    $('.comments').html(response.body);
            });
            return false;
        }
    });
}

function ajaxRequest(url, funct){
    $.ajax({
        url: url,
    }).done(function(response) {
        funct(response);
    }).error(function(response){
        alert(response.responseJSON.message);
    });
}

function ajaxSubmit(form, funct) {
    var postUrl = $(form).attr("action");
    var requestMethod = $(form).attr("method");
    var formFieldsData = $(form).serialize();
    var fields = $(form).find('input');
    var textareas = $(form).find('textarea');
    fields.prop('readonly', true);
    textareas.prop('readonly', true);

    $.ajax({
        url : postUrl,
        type: requestMethod,
        data : formFieldsData
    }).done(function(response){
        if (response.code == 1){
            funct(response);
        }
        else{
            if(response.message){
                alert(response.message)
            }
        }
        fields.prop('readonly', false);
        textareas.prop('readonly', false);
    }).error(function(response){
        alert(response.responseJSON.message);
        fields.prop('readonly', false);
        textareas.prop('readonly', false);
    });
}