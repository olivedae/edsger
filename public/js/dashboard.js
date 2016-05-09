$(document).ready(function() {
    $('.list-group-item-linkable').on('click', function() {
        window.location.href = $(this).data('link');
        //new window:
        //window.open($(this).data('link'));
    });

    $('.list-group-item-linkable a, .list-group-item-linkable button')
    .on('click', function(e) {
        e.stopPropagation();
    });
});
