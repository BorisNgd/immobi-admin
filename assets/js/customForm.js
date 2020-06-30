import $ from "jquery";

var $collectionHolder;
var $addImageButton = jQuery('<button type="button" class="add_image_file  btn btn-primary"><i class="fa fa-plus"></i></button>');
var $newLinkLi = jQuery('<li></li>').append($addImageButton);


jQuery(document).ready(function () {
/*    jQuery(function () {
        jQuery('.house_promote').bootstrapToggle({
            on: 'Promoted',
            off: 'Not Promoted',
            size: 'xs',
            width: 150,
            height: 40
        });
    });*/


    $collectionHolder = $('ul.image');

    $collectionHolder.find('li').each(function () {
        addPhotoFormDeleteLink(jQuery(this));
    });

    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find('input').length);

    $addImageButton.on('click', function (e) {
        addImageForm($collectionHolder, $newLinkLi);
    })
});

function addImageForm($collectionHolder, $newLinLi) {

    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $newLinLi.before($newFormLi);

    addPhotoFormDeleteLink($newFormLi);
}

function addPhotoFormDeleteLink($photoFormLink) {
    var $removeImageButton = jQuery('<button type="button" class="add_image_file btn btn-danger"><i class="fa fa-trash"></i></button>');
    $photoFormLink.append($removeImageButton);

    $removeImageButton.on('click' , function (e) {
        $photoFormLink.remove();
    });
}

