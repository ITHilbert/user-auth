window.onload = function() {

    var permission_group = document.getElementById('input-text-4');
    var permission_display = document.getElementById('input-text-3');

    permission_display.addEventListener("change", function() {
        var permission;

        permission = permission_display.value.toLowerCase();
        permission = permission.replace(' ', '_');
        permission = permission.replace('ä', 'ae');
        permission = permission.replace('ö', 'oe');
        permission = permission.replace('ü', 'ue');
        permission = permission.replace('ß', 'ss');
        permission = permission.replace(':', '');
        permission = permission.replace(';', '');
        permission = permission.replace('"', '');
        permission = permission.replace("'", '');
        permission = permission.replace("'", '');
        permission = permission.replace("`", '');
        permission = permission.replace("~", '');
        permission = permission.replace("<", '');
        permission = permission.replace(">", '');
        permission = permission.replace("|", '');

        permission_group.value = permission;
    });

}