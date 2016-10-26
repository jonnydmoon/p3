var editor
if($('#editorAce').length){
	editor = ace.edit("editorAce");
	//editor.setTheme("ace/theme/monokai");
	editor.setShowPrintMargin(false)
	editor.getSession().setMode("ace/mode/json");
}


function submitJSONForm(){
	var text = editor ? editor.getValue() : $('#editorTextarea').val();
	$('#hiddenTextInput').val(text);
	return true;
}