var total_photos_counter = 0;
Dropzone.options.myDropzone = {
    uploadMultiple: false,
    parallelUploads: 2,
    acceptedFiles: ".jpeg,.jpg,.png,.gif, .hst,.ord",
    maxFilesize: 2,
    previewTemplate: document.querySelector('#preview').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Retirer de la liste',
    dictFileTooBig: 'Image is larger than 16MB',
    timeout: 10000,

    init: function () {
        this.on("removedfile", function (file) {
            $.post({
                url: '/files-delete',
                data: {id: file.name, _token: $('[name="_token"]').val()},
                dataType: 'json',
                success: function (data) {
                    total_photos_counter--;
                    $("#counter").text("# " + total_photos_counter);
                }
            });
        });

        this.on('complete', function () {
            location.reload();
        });
    },
    success: function (file, done) {
        total_photos_counter++;
        $("#counter").text("# " + total_photos_counter);

    }
};