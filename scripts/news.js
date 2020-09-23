$(document).ready(function (){

    loadListNews();

    var interval = 1000;

    function editTime() {
        $.ajax({
            type: 'POST',
            url: 'update_time.php',
            dataType: 'html',
            success: function (data) {
                $('#time').html(data);
            },
            complete: function (data) {
                setTimeout(editTime, interval);
            }
        });
    }

    setTimeout(editTime, interval);

    $('#sort-date').on('change', function (){
        history.pushState({}, "", "?sort=" + $(this).val()) ;
        loadListNews($(this).val());
    });

    $('#sort-likes').on('change', function (){
        history.pushState({}, "", "?sort=" + $(this).val());
        loadListNews($(this).val());
    });

});

function loadListNews(sort = null){
    $.ajax({
        url: "filter_news.php",
        method: "POST",
        data:{
            'sort': sort,
            'url': 'news',
        },
        dataType: "html",
        success: function (data){
            $('.list_news').html(data);
        }
    });
}

function editSelected(){
    let url = parseUrlQuery();
    for (let key in url){
        if (url[key].hasOwnProperty("sort-date")){
            $("#sort-date option").removeAttr("selected");
            $('#sort-date option').each(function(){
                if ($(this).val() == url[key]["sort-date"]){
                    $(this).attr("selected", true);
                }
            });
        }
        if (url[key].hasOwnProperty("sort-likes")){
            $("#sort-likes option").removeAttr("selected");
            $('#sort-likes option').each(function(){
                if ($(this).val() == url[key]["sort-likes"]){
                    $(this).attr("selected", true);
                }
            });
        }
    }
}

function parseUrlQuery() {
    var data = {};
    if(window.location.search) {
        var pair = (window.location.search.substr(1)).split('&');
        for(var i = 0; i < pair.length; i ++) {
            data[i] = {};
            var param = pair[i].split('=');
            data[i][param[0]] = param[1];
        }
    }
    return data;
}

function putLike(object){
    let id = $(object).attr('id');
    id = (id).split('-')[1];
    let count_likes = $(object).parent('.tiding-details').find('small').text();
    if ($(object).parent('.tiding-details').find('.put_tiding').children('i').hasClass('like-n')){
        $(object).parent('.tiding-details').find('.put_tiding').html('<i class="fa fa-heart fa-2x like-y" aria-hidden="true" style="color: #ff6a59"></i>');
        count_likes++;
        $(object).parent('.tiding-details').find('small').text(String(`${count_likes}`));
        if ($(object).parent('.tiding-details').parent('.tiding-all_description').parent('.tiding').hasClass('full_tiding')){
            $('#put_like-' + id).html('<i class="fa fa-heart fa-2x like-y" aria-hidden="true" style="color: #ff6a59"></i>');
            $('#count_likes-' + id).text(String(`${count_likes}`));
        }
    }
    else{
        $(object).parent('.tiding-details').find('.put_tiding').html('<i class="fa fa-heart-o fa-2x like-n" aria-hidden="true"></i>');
        count_likes--;
        $(object).parent('.tiding-details').find('small').text(String(`${count_likes}`));
        if ($(object).parent('.tiding-details').parent('.tiding-all_description').parent('.tiding').hasClass('full_tiding')){
            $('#put_like-' + id).html('<i class="fa fa-heart-o fa-2x like-n" aria-hidden="true"></i>');
            $('#count_likes-' + id).text(String(`${count_likes}`));
        }
    }
    $.ajax({
        url: "edit_likes.php",
        method: "POST",
        data:{
            'id': id,
            'count_likes': count_likes,
        },
    });
}

function closeTiding(object){
    $(object).parents('.popup-fade').fadeOut();
    return false;
}

function openTiding(object){
    $('.popup-fade').fadeIn();
    let id = $(object).attr('id');
    id = (id).split('-')[1];
    $.ajax({
        url: "load_tiding.php",
        method: "POST",
        data:{
            'id': id,
        },
        dataType: "html",
        success: function (data){
            $('.specific_tiding').html(data);
            if ($('#put_like-' + id).parent('.tiding-details').find('.put_tiding').children('i').hasClass('like-y')){
                $('#put_like_full-' + id).html('<i class="fa fa-heart fa-2x like-y" aria-hidden="true" style="color: #ff6a59"></i>');
            }
        }
    });
    return false;
}
