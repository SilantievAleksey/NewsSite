$(document).ready(function (){

    $('button[name="look_create_tiding"]').on('click', function (){
        if ($('#form_create_tiding').hasClass('form_create_tiding')){
            $('#form_create_tiding').removeClass('form_create_tiding');
            $(this).text('Закрыть форму создания новости');
        }
        else{
            $('#form_create_tiding').addClass('form_create_tiding');
            $(this).text('Открыть форму создания новости');
            clearForm();
        }
    });

});

function edit_tiding(object){
    let id = $(object).parent('.tiding-details').parent('.tiding-all_description').parent('.tiding').attr('id');
    if ($('#edit_' + id + " form").hasClass('form_edit_tiding')){
        $('#edit_' + id + " form").removeClass('form_edit_tiding');
        $(object).text('Закрыть форму редактирования новости');
    }
    else{
        $('#edit_' + id + " form").addClass('form_edit_tiding');
        $(object).text('Открыть форму редактирования новости');
    }
}

function clearForm(){
    $('#form_create_tiding').reset();
}

function hide_tiding(object){
    let id = $(object).parent('.tiding_control').parent('.tiding-show').parent('.tiding').attr('id');
    if ($('#'+String(`${id}`)).children('.tiding-show').children('.block-tiding_hide').hasClass('element_tiding_hide')){
        $('#'+String(`${id}`)).children('.tiding-img').addClass('element_tiding_hide');
        $('#'+String(`${id}`)).children('.tiding-all_description').addClass('element_tiding_hide');
        $('#'+String(`${id}`)).children('.tiding-show').children('.tiding_control').children('.hide_tiding').attr('src', '../images/general/HideTiding.png');
        $('#'+String(`${id}`)).children('.tiding-show').addClass('tiding-control-hide');
        $('#'+String(`${id}`)).children('.tiding-show').children('.block-tiding_hide').removeClass('element_tiding_hide');
        if (!$('#edit_' + id + " form").hasClass('form_edit_tiding')){
            $('#edit_' + id + " form").addClass('form_edit_tiding');
        }
    }
    else{
        $('#'+String(`${id}`)).children('.tiding-img').removeClass('element_tiding_hide');
        $('#'+String(`${id}`)).children('.tiding-all_description').removeClass('element_tiding_hide');
        $('#'+String(`${id}`)).children('.tiding-show').children('.tiding_control').children('.hide_tiding').attr('src', '../images/general/ShowTiding.png');
        $('#'+String(`${id}`)).children('.tiding-show').removeClass('tiding-control-hide');
        $('#'+String(`${id}`)).children('.tiding-show').children('.block-tiding_hide').addClass('element_tiding_hide');
        if (!$('#edit_' + id + " form").hasClass('form_edit_tiding')){
            $('#edit_' + id + " form").addClass('form_edit_tiding');
        }
    }
    id = (id).split('-');
    $.ajax({
        url: "update_tiding.php",
        method: "POST",
        data:{
            'id': id[1],
        },
    });
}

function delete_tiding(object){
    let id = $(object).parent('.tiding_control').parent('.tiding-show').parent('.tiding').attr('id');
    id = (id).split('-');
    $.ajax({
        url: "delete_tiding.php",
        method: "POST",
        data:{
            'id': id[1],
        },
        success: function (){
            loadListNews();
        }
    });
}

function loadListNews(sort = null){
    $.ajax({
        url: "filter_news.php",
        method: "POST",
        data:{
            'sort': sort,
            'url': 'admin',
        },
        dataType: "html",
        success: function (data){
            $('.list_news').html(data);
        }
    });
}

