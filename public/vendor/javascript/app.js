$('.placa').mask('AAA0U00', {
    translation: {
        'A': {
            pattern: /[A-Za-z]/
        },
        'U': {
            pattern: /[A-Za-z0-9]/
        },
    },
    onKeyPress: function (value, e, field, options) {
        // Convert to uppercase
        e.currentTarget.value = value.toUpperCase();

        // Get only valid characters
        let val = value.replace(/[^\w]/g, '');

        // Detect plate format
        let isNumeric = !isNaN(parseFloat(val[4])) && isFinite(val[4]);
        let mask = 'AAA0U00';
        if(val.length > 4 && isNumeric) {
            mask = 'AAA0000';
        }
        $(field).mask(mask, options);
    }
});
$('.mod_ano').mask("00/00",{placeholder: "  /  "});
