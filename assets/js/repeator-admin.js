jQuery(document).ready(function ($) {

    /* ============================
     * Toggle Fields by Type
     * ============================ */
    function toggleRepeatorType(wrapper) {
        let type = wrapper.find('.repeator-type').val();

        wrapper.find('.rep-type-text').hide();
        wrapper.find('.rep-type-editor').hide();
        wrapper.find('.repeator-answer-radio').hide();
        wrapper.find('.repeator-type-image').hide();

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
    }

    /* Initial load */
    $('.repeator-item').each(function () {
        toggleRepeatorType($(this));
    });

    /* On type change */
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
            </select>

            <!-- Text -->
            <div class="rep-type-text">
                <input type="text"
                       name="rpt[${index}][answer]"
                       placeholder="Enter the Answer">
            </div>

            <!-- Editor -->
            <div class="rep-type-editor" style="display:none;">
                <textarea name="rpt[${index}][answer]" rows="6"></textarea>
            </div>

            <!-- Radio -->
            <div class="repeator-answer-radio" style="display:none;">
                <input type="text"
                       name="rpt[${index}][options][]"
                       placeholder="Option">
                <button type="button" class="button add-rep-opt">
                    Add Option
                </button>
            </div>

            <!-- Image -->
            <div class="repeator-type-image" style="display:none;">
                <input type="hidden"
                       class="rep-image-id"
                       name="rpt[${index}][image]">

                <button type="button"
                        class="button rep-image-upload">
                    Select Image
                </button>

                <div class="rep-image-preview"></div>
            </div>

        </div>
        `;

        $('.repeator-button').before(template);

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
     * Image Media Uploader
     * ============================ */
    let mediaUploader;

    $(document).on('click', '.rep-image-upload', function (e) {
        e.preventDefault();

        let button = $(this);
        let wrapper = button.closest('.repeator-type-image');
        let imageInput = wrapper.find('.rep-image-id');
        let preview = wrapper.find('.rep-image-preview');

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media({
            title: 'Select Image',
            button: { text: 'Use this image' },
            multiple: false
        });

        mediaUploader.on('select', function () {
            let attachment = mediaUploader.state().get('selection').first().toJSON();

            imageInput.val(attachment.id);
            preview.html(`<img src="${attachment.sizes.thumbnail.url}" />`);
        });

        mediaUploader.open();
    });

});
