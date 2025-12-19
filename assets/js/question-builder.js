jQuery(document).ready(function ($) {

    /* =========================
       Toggle Text / Radio
    ========================= */
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

    // Initial toggle on page load
    $('.question-items').each(function () {
        toggleType($(this));
    });

    // Toggle on type change
    $(document).on('change', '.question_type', function () {
        toggleType($(this).closest('.question-items'));
    });


    /* =========================
       Add Option (Radio)
    ========================= */
    $(document).on('click', '.add-option', function () {
        let wrapper = $(this).closest('.type-radio');
        let name = wrapper.find('input:first').attr('name');
        if (!name) return;

        $(this).before(
            `<input type="text" name="${name}" placeholder="Option">`
        );
    });


    /* =========================
       Add Question
    ========================= */
    $('#add_question').on('click', function () {

        let index = $('.question-items').length;

        let html = `
        <div class="question-items">

            <div class="question-box">
                <label>Question</label>
                <input type="text" name="qst[${index}][question]">
            </div>

            <div class="answer">

                <div class="question-type">
                    <label>Type</label>
                    <select name="qst[${index}][type]" class="question_type">
                        <option value="text">Text</option>
                        <option value="radio">Radio</option>
                    </select>
                </div>

                <div class="type-text">
                    <input type="text" name="qst[${index}][answer]" placeholder="Short answer">
                </div>

                <div class="type-radio" style="display:none;">
                    <input type="text" name="qst[${index}][options][]" placeholder="Option">
                    <button type="button" class="add-option button">
                        Add Option
                    </button>
                </div>

            </div>

            <div class="question-actions">
                <button type="button" class="remove-question button button-secondary">
                    Remove Question
                </button>
            </div>

        </div>
        `;

        $('.questions-wrapper').append(html);

        // Initialize toggle for new question
        toggleType($('.question-items').last());

        // Optional: focus new question
        $('.question-items').last().find('input:first').focus();
    });


    /* =========================
       Remove Question (ADMIN ONLY)
    ========================= */
    $(document).on('click', '.remove-question', function () {

        let total = $('.question-items').length;

        // At least 1 question must remain
        if (total <= 1) {
            alert('At least one question is required.');
            return;
        }

        if (!confirm('Are you sure you want to remove this question?')) {
            return;
        }

        $(this).closest('.question-items').slideUp(200, function () {
            $(this).remove();
            reindexQuestions();
        });
    });


    /* =========================
       Reindex After Remove
    ========================= */
    function reindexQuestions() {
        $('.question-items').each(function (index) {

            $(this).find('input, select').each(function () {
                let name = $(this).attr('name');
                if (!name) return;

                name = name.replace(/qst\[\d+\]/, 'qst[' + index + ']');
                $(this).attr('name', name);
            });

        });
    }

});
