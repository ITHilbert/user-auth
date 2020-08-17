var group_display = $('input[name="group_display"]')[0];
var group_name = $('input[name="group_name"]')[0];


group_display.addEventListener("change", function() {
    var value = this.value; //$('input[name="group_display"]')[0].val();

    value = formatDisplayToIntern(value);

    $('input[name="group_name"]')[0].value = value;
});


function showSinglePermissions() {
    var cb = $('input[name="ckPermissionGroup"]')[0].checked;

    if (cb) {
        $('#group_permissions_show').removeClass('d-none');
    } else {
        $('#group_permissions_show').addClass('d-none');
    }
}



var newID = 1;

function newPermission() {
    var vorlage = $('#vorlage').clone()

    newID++;
    vorlage.removeClass('d-none');
    vorlage.attr('id', 'new-row-' + newID)
    vorlage.attr('nummer', newID);

    //ID anpassen
    var rowid = vorlage.find('#new-id');
    rowid.attr('id', 'new-id-' + newID);
    rowid.append('new_' + newID);

    //Recht anpassen
    var rowid = vorlage.find('#vorlage_display');
    rowid.attr('id', 'display_new_' + newID);
    rowid.attr('name', 'permission_display_new_' + newID);

    //Recht anpassen
    var tb1 = vorlage.find('#vorlage_display');
    tb1.attr('id', 'display_new_' + newID);
    tb1.attr('name', 'permission_display_new_' + newID);

    //Recht intern anpassen
    var tb2 = vorlage.find('#vorlage_intern');
    tb2.attr('id', 'intern_new_' + newID);
    tb2.attr('name', 'permission_new_' + newID);

    //Löschen Button
    var btn = vorlage.find('#btnVorlage');
    btn.removeAttr('id');
    btn.attr('onclick', "deletePermission('new-row-" + newID + "')");

    //Angepasste Vorlage einfügen
    $('#tbody').append(vorlage);

    var tb = document.getElementById('display_new_' + newID)
    tb.addEventListener("change", function() {
        editIntern('new-row-' + newID);
    });
}


function deletePermission(rowID) {

    //Neuer Eintrag
    if (rowID.indexOf('new-row') == 0) {
        var element = document.getElementById(rowID)
        element.parentNode.removeChild(element);
    } else {
        var element = $('#' + rowID);
        var nr = element.attr('nummer');

        element.addClass('d-none');


        //Recht anpassen
        var tb1 = element.find('#display_' + nr);
        tb1.attr('name', 'delete_display_' + nr);

        //Recht intern anpassen
        var tb2 = element.find('#intern_' + nr);
        tb2.attr('name', 'delete_intern_' + nr);
    }




}

function editIntern(rowID) {
    //console.log('editIntern(' + rowID + ')');

    var nr = $('#' + rowID).attr('nummer');
    //console.log('Nr: ' + nr);

    //Neuer Eintrag
    if (rowID.indexOf('new-row') == 0) {
        //console.log(1);
        var value = $('#display_new_' + nr).val();
        value = $('input[name="group_name"]')[0].value + '_' + formatDisplayToIntern(value);
        $('#intern_new_' + nr).val(value);
    } else {
        //console.log(2);
        var value = $('#display_' + nr).val();
        value = $('input[name="group_name"]')[0].value + '_' + formatDisplayToIntern(value);
        $('#intern_' + nr).val(value);
    }
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
