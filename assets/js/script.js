jQuery(document).ready(function ($) {
    $(document).on('dblclick', function (e) {
        const selection = window.getSelection();
        const word = selection.toString().trim();
        const $popup = $('#wmp-popup');

        if (word.length === 0) return;

        const x = e.pageX + 10;
        const y = e.pageY + 10;

        $popup.css({
            left: x + 'px',
            top: y + 'px',
            display: 'block'
        }).html('Looking up definition...');

        $.ajax({
            url: wmp_ajax.api_url + encodeURIComponent(word),
            method: 'GET',
            success: function (data) {
                if (!Array.isArray(data)) {
                    $popup.html(`<strong>${word}</strong><br>No definition found.`);
                    return;
                }

                const definition = data[0].meanings[0].definitions[0].definition;
                $popup.html(`
                    <strong>${data[0].word}</strong> <em>(${data[0].meanings[0].partOfSpeech})</em>
                    <p>${definition}</p>
                `);

            },
            error: function () {
                $popup.html(`<strong>${word}</strong><br>No definition found.`);
            }
        });
    });

    // Hide popup on single click elsewhere
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#wmp-popup').length) {
            $('#wmp-popup').hide();
        }
    });
});
