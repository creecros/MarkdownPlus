KB.on('dom.ready', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if ((urlParams.get('controller') == "TaskViewController" && urlParams.get('action') == 'show') || /\/task\/[0-9]+$/.test(window.location)) {
        var Content = document.getElementsByClassName('sidebar-content')[0];

        const elements = [...Content.getElementsByTagName('input')];
        var checkboxes = elements.filter(input=>input.type == 'checkbox');
        const matches = [...Content.innerHTML.matchAll(RegExp('(<input type="checkbox")|(\\[[xX ]\\])', 'gm'))];

        var count = 0;
        var currentCheckbox = 0;
        for (const match of matches) {
            ++count;
            if (match[1] !== undefined) {
                var checkbox = checkboxes[currentCheckbox];
                checkbox.setAttribute('class', 'activecheckbox');
                checkbox.setAttribute('number', count);
                ++currentCheckbox;
            }
        }

        KB.onClick('.activecheckbox', ToggleActiveCheckbox, !0);

        function ToggleActiveCheckbox(e) {
            const urlParams = new URLSearchParams(window.location.search);

            const link = '?controller=CheckboxController&action=toggle&plugin=MarkdownPlus';
            KB.http.postJson(link, {
                'task_id': urlParams.get('task_id'),
                'number': e.target.getAttribute('number')
            });
        }
    }
});
