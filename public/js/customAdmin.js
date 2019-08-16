$(function () {
    var $enLink = $('#en_link');
    var $ruLink = $('#ru_link');

    $enLink.click(function() {
        $enLink.addClass('bg-aqua-active');
        $ruLink.removeClass('bg-aqua-active');
    });

    $ruLink.click(function() {
        $ruLink.addClass('bg-aqua-active');
        $enLink.removeClass('bg-aqua-active');
    });
});

function deleteField() {

    var $group = $(this).closest('.form-group');

    if ($group.find('[data-parentId]').length > 1) {
        $(this).closest('[data-parentId]').remove();
    }

    return false;
}

function addField() {
    var $field = $(this).closest('[data-parentId]'),
        $newField = $field.clone();

    $newField.find('[data-value]').val('');
    $field.after($newField);

    return false;
}

window.addEventListener('load', function () {
    $('[data-int]').on('keyup', function () {
        $(this).val($(this).val().replace(/\D/, ''));
    });

    $('[data-form]').on('click', '[data-delete-field]', deleteField);

    $('[data-form]').on('click', '[data-add-field]', addField);
});
