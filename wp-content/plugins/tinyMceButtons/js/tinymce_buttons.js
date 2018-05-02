(function() {
	tinymce.PluginManager.add( 'columns', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('columns', {
            title: 'Insert Link',
            cmd: 'columns',
            image: url + '/columns.png',
        });
 
        editor.addCommand('columns', function() {
			editor.windowManager.open({
                title: "Insert Link",
				body: [{
					type: 'textbox',
					name: 'title',
					label: 'Label',
					value: ''
				},
				{
					type: 'listbox', 
					name: 'slideshow', 
					label: 'Choose Page', 
					id : 'demo_slide',
					'values': slideshow
				}
				],
				onsubmit: function(e) {
					var open_column = '<a href="" class="modal-popup">';
					var selected = e.data.slideshow
					if(!selected){
						selected = "#";
					}
					var return_text = '';
					return_text = '<a data-target="'+selected+'" href="'+selected+'" class="modal-popup">' +e.data.title+ '</a>';
					editor.execCommand('mceReplaceContent', false, return_text);
					return; 
				}
            });
	
        });
 
    });
})();


