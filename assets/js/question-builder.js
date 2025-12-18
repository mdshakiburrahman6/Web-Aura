jQuery(document).ready(function ($) {

    // Toggle fields based on type
    function toggleType(wrapper) {
        let type = wrapper.find('.question_type').val();

        if (type === 'radio') {
            wrapper.find('.type-radio').show();
            wrapper.find('.type-text').hide();
        } else {
            wrapper.find('.type-text').show();
            wrapper.find('.type-radio').hide();
        }
    }

    // Initial toggle
    $('.question-items').each(function () {
        toggleType($(this));
    });

    // Change type
    $(document).on('change', '.question_type', function () {
        toggleType($(this).closest('.question-items'));
    });

    // Add option
    $(document).on('click', '.add-option', function () {
        let wrapper = $(this).closest('.type-radio');
        let index = wrapper.find('input').length;

        let name = wrapper.find('input:first').attr('name');
        if (!name) return;

        wrapper.find('.add-option').before(
            `<input type="text" name="${name}" placeholder="Option">`
        );
    });

    // Add question
    $('#add_question').on('click', function () {

        let index = $('.question-items').length;

        let html = `
        <div class="question-items">

            <label>Question</label>
            <input type="text" name="qst[${index}][question]">

            <label>Type</label>
            <select name="qst[${index}][type]" class="question_type">
                <option value="text">Text</option>
                <option value="radio">Radio</option>
            </select>

            <div class="type-text">
                <input type="text" name="qst[${index}][answer]" placeholder="Short answer">
            </div>

            <div class="type-radio" style="display:none;">
                <input type="text" name="qst[${index}][options][]" placeholder="Option">
                <button type="button" class="add-option">Add Option</button>
            </div>

        </div>
        `;

        $('.questions-wrapper').append(html);
    });

});
