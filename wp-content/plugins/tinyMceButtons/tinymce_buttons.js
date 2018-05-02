(function() {
    tinymce.PluginManager.add('columns', function(editor, url) {
        editor.addButton('columns', {
            icon: false,
            text: "DEWATA",
            buttons: [{
				text: 'Do Action',
				subtype: 'primary',
				onclick: function() {
					// TODO: handle primary button click
					(this).parent().parent().close();
				}
			},
			{
				text: 'Close',
				onclick: function() {
					(this).parent().parent().close();
				}
			}]
        });
    });
})();