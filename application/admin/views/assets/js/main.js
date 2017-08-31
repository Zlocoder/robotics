function addNewsHelpTextFields() {
    var $panel = $(this).parents('.panel:first').clone();
    $panel.find('input').val('').attr('name', 'NewsForm[helpTitles][]');
    $panel.find('textarea').val('').attr('name', 'NewsForm[helpTexts][]');
    $panel.find('span').text(1 + parseInt($panel.find('span').text()));
    $panel.find('.news-help-text-add').click(addNewsHelpTextFields);
    $panel.find('.news-help-text-delete').click(deleteNewsHelpTextFields);

    $(this).parents('.panel:first').parent().append($panel);
    $(this).remove();
}

function deleteNewsHelpTextFields() {
    if ($(this).siblings('.news-help-text-add').length) {
        var $btnAdd = $('.news-help-text-add').remove();
        $(this).parents('.panel:first').remove();
        $btnAdd.insertAfter('.news-help-text-delete:last');
        $('<i> </i>').insertAfter('.news-help-text-delete:last');
        $btnAdd.click(addNewsHelpTextFields);
    } else {
        $(this).parents('.panel:first').remove();
    }
}

$(function() {
    $('.news-help-text-delete').click(deleteNewsHelpTextFields);

    $('.news-help-text-add').click(addNewsHelpTextFields);
});