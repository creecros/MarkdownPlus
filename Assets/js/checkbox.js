KB.on('dom.ready', function () {
    const urlParams = new URLSearchParams(window.location.search);

    let URLRewrite = /\/task\/[0-9]+$/.test(window.location);
    if ((urlParams.get('controller') == "TaskViewController" && urlParams.get('action') == 'show') ||
        URLRewrite) { // for activated URL-Rewrite

        KB.onClick('.activecheckbox', ToggleActiveCheckbox, !0);

        function ToggleActiveCheckbox(e) {
            const urlParams = new URLSearchParams(window.location.search);

            if (URLRewrite) {
                const link = '/MarkdownPlus/Checkbox';
                KB.http.postJson(link, {
                    'task_id': urlParams.get('task_id'),
                    'number': e.target.getAttribute('number')
                });
            }
            else {
                const link = '?controller=CheckboxController&action=toggle&plugin=MarkdownPlus';
                KB.http.postJson(link, {
                    'task_id': urlParams.get('task_id'),
                    'number': e.target.getAttribute('number')
                });
            }
        }
    }
});
