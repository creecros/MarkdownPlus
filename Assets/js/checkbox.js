KB.on('dom.ready', function () {
    const urlParams = new URLSearchParams(window.location.search);

    let URLRewrite = /\/task\/[0-9]+$/.test(window.location);
    if ((urlParams.get('controller') == "TaskViewController" && urlParams.get('action') == 'show') ||
        URLRewrite) { // for activated URL-Rewrite

        KB.onClick('.activecheckbox', ToggleActiveCheckbox, !0);

        function ToggleActiveCheckbox(e) {
            const urlParams = new URLSearchParams(window.location.search);

            var task_id = null;
            var taskIdElem = document.getElementById('form-task_id');
            if (taskIdElem != null) {
                task_id = taskIdElem.value;
            }

            let link = "";
            if (URLRewrite) {
                link = '/MarkdownPlus/Checkbox';
            }
            else {
                link = '?controller=CheckboxController&action=toggle&plugin=MarkdownPlus';
            }

            KB.http.postJson(link, {
                'task_id': task_id,
                'number': e.target.dataset.number
            });
        }
    }
});
