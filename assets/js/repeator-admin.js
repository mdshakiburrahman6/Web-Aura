jQuery(document).ready(function ($) {

    /* ============================
     * Toggle Fields by Type
     * ============================ */
    function toggleRepeatorType(wrapper) {

        let type = wrapper.find('.repeator-type').val();

        // hide all first
        wrapper.find('.rep-type-text').hide();
        wrapper.find('.rep-type-editor').hide();
        wrapper.find('.repeator-answer-radio').hide();
        wrapper.find('.repeator-type-image').hide();
        wrapper.find('.repeator-type-gallery').hide();

        // show based on type
        if (type === 'text') {
            wrapper.find('.rep-type-text').show();
        }

        if (type === 'editor') {
            wrapper.find('.rep-type-editor').show();
        }

        if (type === 'radio') {
            wrapper.find('.repeator-answer-radio').show();
        }

        if (type === 'image') {
            wrapper.find('.repeator-type-image').show();
        }

        if (type === 'gallery') {
            wrapper.find('.repeator-type-gallery').show();
        }
    }

    /* ============================
     * Initial Load
     * ============================ */
    $('.repeator-item').each(function () {
        toggleRepeatorType($(this));
    });

    /* ============================
     * On Type Change
     * ============================ */
    $(document).on('change', '.repeator-type', function () {
        toggleRepeatorType($(this).closest('.repeator-item'));
    });

    /* ============================
     * Add New Question
     * ============================ */
    $('#add-rep-question').on('click', function () {

        let index = $('.repeator-item').length;

        let template = `
        <div class="repeator-item">

            <input class="repeator-question" type="text"
                   name="rpt[${index}][question]"
                   placeholder="Enter your Question">

            <label>Select a Type</label>
            <select class="repeator-type" name="rpt[${index}][type]">
                <option value="text">Text</option>
                <option value="editor">Editor</option>
                <option value="radio">Radio</option>
                <option value="image">Image</option>
                <option value="gallery">Gallery</option>
            </select>

            <!-- Text -->
            <div class="rep-type-text">
                <input type="text"
                       name="rpt[${index}][answer]"
                       placeholder="Enter the Answer">
            </div>

            <!-- Editor -->
            <div class="rep-type-editor">
                <textarea name="rpt[${index}][answer]" rows="6"></textarea>
            </div>

            <!-- Radio -->
            <div class="repeator-answer-radio">
                <input type="text"
                       name="rpt[${index}][options][]"
                       placeholder="Option">
                <button type="button" class="button add-rep-opt">
                    Add Option
                </button>
            </div>

            <!-- Image -->
            <div class="repeator-type-image">
                <input type="hidden"
                       class="rep-image-id"
                       name="rpt[${index}][image]">
                <button type="button"
                        class="button rep-image-upload">
                    Select Image
                </button>
                <div class="rep-image-preview"></div>
            </div>

            <!-- Gallery -->
            <div class="repeator-type-gallery">
                <input type="hidden"
                       class="rep-gallery-ids"
                       name="rpt[${index}][gallery]">
                <button type="button"
                        class="button rep-gallery-upload">
                    Add Gallery
                </button>
                <div class="rep-gallery-preview"></div>
            </div>

        </div>
        `;

        let newItem = $(template);

        $('.repeator-button').before(newItem);

        // 🔥 VERY IMPORTANT
        toggleRepeatorType(newItem);
    });

    /* ============================
     * Add Radio Option
     * ============================ */
    $(document).on('click', '.add-rep-opt', function () {

        let wrapper = $(this).closest('.repeator-answer-radio');
        let name = wrapper.find('input:first').attr('name');

        wrapper.prepend(`
            <input type="text"
                   name="${name}"
                   placeholder="Option">
        `);
    });

    /* ============================
     * Single Image Uploader
     * ============================ */
    let imageUploader;

    $(document).on('click', '.rep-image-upload', function (e) {
        e.preventDefault();

        let wrapper = $(this).closest('.repeator-type-image');
        let input   = wrapper.find('.rep-image-id');
        let preview = wrapper.find('.rep-image-preview');

        imageUploader = wp.media({
            title: 'Select Image',
            button: { text: 'Use this image' },
            multiple: false
        });

        imageUploader.on('select', function () {
            let attachment = imageUploader.state().get('selection').first().toJSON();
            input.val(attachment.id);
            preview.html(`<img src="${attachment.sizes.thumbnail.url}" />`);
        });

        imageUploader.open();
    });

    /* ============================
     * Gallery Uploader (Multiple)
     * ============================ */
    let galleryUploader;

    $(document).on('click', '.rep-gallery-upload', function (e) {
        e.preventDefault();

        let wrapper = $(this).closest('.repeator-type-gallery');
        let input   = wrapper.find('.rep-gallery-ids');
        let preview = wrapper.find('.rep-gallery-preview');

        let ids = input.val()
            ? input.val().split(',').map(id => parseInt(id))
            : [];

        galleryUploader = wp.media({
            title: 'Select Images',
            button: { text: 'Add to Gallery' },
            multiple: true
        });

        galleryUploader.on('select', function () {

            let selection = galleryUploader.state().get('selection');

            selection.each(function (attachment) {

                attachment = attachment.toJSON();

                if (!ids.includes(attachment.id)) {
                    ids.push(attachment.id);

                    preview.append(`
                        <div class="rep-gallery-item" data-id="${attachment.id}">
                            <span class="rep-gallery-remove">×</span>
                            <img src="${attachment.sizes.thumbnail.url}">
                        </div>
                    `);
                }
            });

            input.val(ids.join(','));
        });

        galleryUploader.open();
    });

    /* ============================
     * Remove Single Gallery Image
     * ============================ */
    $(document).on('click', '.rep-gallery-remove', function () {

        let item    = $(this).closest('.rep-gallery-item');
        let id      = item.data('id');
        let wrapper = item.closest('.repeator-type-gallery');
        let input   = wrapper.find('.rep-gallery-ids');

        let ids = input.val()
            ? input.val().split(',').filter(v => parseInt(v) !== id)
            : [];

        input.val(ids.join(','));
        item.remove();
    });

});
