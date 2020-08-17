function setInternValue() {
    var value = document.getElementById('input-text-3').value;

    value = formatDisplayToIntern(value);

    document.getElementById('input-text-4').value = value;
}


function formatDisplayToIntern(value) {
    if (value === undefined) return '';

    value = value.toLowerCase();
    value = value.replace(' ', '_');
    value = value.replace('ä', 'ae');
    value = value.replace('ö', 'oe');
    value = value.replace('ü', 'ue');
    value = value.replace('ß', 'ss');
    value = value.replace(':', '');
    value = value.replace(';', '');
    value = value.replace('"', '');
    value = value.replace("'", '');
    value = value.replace("'", '');
    value = value.replace("`", '');
    value = value.replace("~", '');
    value = value.replace("<", '');
    value = value.replace(">", '');
    value = value.replace("|", '');

    return value;
}
