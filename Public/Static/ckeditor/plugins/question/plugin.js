CKEDITOR.plugins.add('question', {
    requires: ['dialog'],
    init: function (a) {
        var b = a.addCommand('question', new CKEDITOR.dialogCommand('question'));
        a.ui.addButton('question', {
            label: '选择题目',
            command: 'question',
            icon: this.path + 'images/pagebreak.gif'
        });
        CKEDITOR.dialog.add('question', this.path + 'dialogs/data.js');
    }
});