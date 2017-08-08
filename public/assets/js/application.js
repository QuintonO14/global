$(function () {
    function getRight() {
        return ($(window).width() - ($('[data-toggle="popover"]').offset().left + $('[data-toggle="popover"]').outerWidth()))
    }

    $(window).on('resize', function () {
        var instance = $('[data-toggle="popover"]').data('bs.popover')
        if (instance) {
            instance.options.viewport.padding = getRight()
        }
    })

    $('[data-toggle="popover"]').popover({
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
        title: '',
        html: true,
        trigger: 'manual',
        placement:'bottom',
        viewport: {
            selector: 'body',
            padding: getRight()
        },
        content: function () {
            var $nav = $('.app-navbar .navbar-nav:last-child').clone()
            return '<div class="nav nav-stacked" style="width: 200px">' + $nav.html() + '</div>'
        }
    })

    $('[data-toggle="popover"]').on('click', function (e) {
        e.stopPropagation()

        if ($('[data-toggle="popover"]').data('bs.popover').tip().hasClass('in')) {
            $('[data-toggle="popover"]').popover('hide')
            $(document).off('click.app.popover')

        } else {
            $('[data-toggle="popover"]').popover('show')

            setTimeout(function () {
                $(document).one('click.app.popover', function () {
                    $('[data-toggle="popover"]').popover('hide')
                })
            }, 1)
        }
    })

});

function chooseFile() {
    $("#fileInput").click();
}

$('.deletePhoto').click(function(event) {
    event.preventDefault();

    var id = $(this).data("id");
    var token = $(this).data("token");
    $.ajax(
        {
            url: "photo/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success : $(this).closest('.photoImage').fadeOut('slow'),

        });

});

$('.deleteModalPhoto').click(function(event) {
    event.preventDefault();

    var id = $(this).data("id");
    var token = $(this).data("token");
    $.ajax(
        {
            url: "photo/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: $(this).closest('.photoDiv').fadeOut('slow'),

            error : function()
            {
                console.log('it failed');
            }
        });
});

$('.acceptBtn').click(function(event) {
    event.preventDefault();

    var id = $(this).data("id");
    var token = $(this).data("token");
    $.ajax(
        {
            url: "/dashboard/accept/"+id,
            type: 'GET',
            dataType: "JSON",
            data: {
                "id": id,
                "_token": token,
            },
            success: $(this).closest('.list-group-item').fadeOut('slow'),

            error : function()
            {
                console.log('it failed');
            }
        });
});

$('.declineBtn').click(function(event) {
    event.preventDefault();

    var id = $(this).data("id");
    var token = $(this).data("token");
    $.ajax(
        {
            url: "/dashboard/decline/"+id,
            type: 'GET',
            dataType: "JSON",
            data: {
                "id": id,
                "_token": token,
            },
            success: $(this).closest('.list-group-item').fadeOut('slow'),

            error : function()
            {
                console.log('it failed');
            }
        });
});




$('ul.pagination').hide();
$(function() {
    $('.infinite-scroll').jscroll({
        autoTrigger: true,
        loadingHtml: '<img class="center-block" style="height:25px; width: 25px;" src="/images/loading.gif" alt="Loading..." />',
        padding: 0,
        nextSelector: '.pagination li.active + li a',
        contentSelector: 'li.posts',
        callback: function() {
            $('ul.pagination').remove();
            $(".commentForm").hide();
            $(".commentBtn, .commentBtn2").click(function (e) {
                $(this).siblings(".commentForm").show();
            });
            $(".commentHistory").hide();
            $(".commentBtn, .commentBtn2").click(function (e) {
                $(this).siblings(".commentHistory").show();
            });

            $(".cancelcomment").click(function (e) {
                $(".commentForm").hide();
                $(".commentHistory").hide();
            });


        }
    });
});

$(document).ready(function() {
    $(".commentForm").hide();
    $(".commentBtn, .commentBtn2").click(function (e) {
        $(this).siblings(".commentForm").show();
    });

    $(".commentHistory").hide();
    $(".commentBtn, .commentBtn2").click(function (e) {
        $(this).siblings(".commentHistory").show();
    });


    $(".cancelcomment").click(function (e) {
        $(".commentForm").hide();
        $(".commentHistory").hide();
    });
});
