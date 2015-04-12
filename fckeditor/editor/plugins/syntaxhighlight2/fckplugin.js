/*
*   Syntax Highlighter 2.0 plugin for FCKEditor
*   ========================
*   Copyright (C) 2008  Darren James
*   Email : darren.james@gmail.com
*   URL : http://www.psykoptic.com/blog/
*
*   NOTE:
*   ========================
*   This plugin will add or edit a formatted <pre> tag for FCKEditor
*   To see results on the front end of your website
*   You will need to install SyntaxHighlighter 2.0.x from
*   http://alexgorbatchev.com/wiki/SyntaxHighlighter
*
*
*   This program is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.

*   This program is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details.

*   You should have received a copy of the GNU General Public License
*   along with this program.  If not, see <http:*www.gnu.org/licenses/>.

*   This program comes with ABSOLUTELY NO WARRANTY.
*/


// Register the related command.

/*
NOTE - Values are case sensitive
- syntaxhighlight2: name of the plugin and directory name (must be the same!)
- SyntaxHighLight2: Name of command used to identify the new toolbar button
*/

FCKCommands.RegisterCommand('SyntaxHighLight2', new FCKDialogCommand('SyntaxHighLight2', FCKLang.DlgSyntaxhighlightTitle, FCKPlugins.Items['syntaxhighlight2'].Path + 'dialog/fck_syntaxhighlight.html', 500, 500));

// Create the "SyntaxHighLight" toolbar button.
var oSyntaxhighlightItem = new FCKToolbarButton('SyntaxHighLight2', FCKLang.SyntaxhighlightBtn);
oSyntaxhighlightItem.IconPath = FCKPlugins.Items['syntaxhighlight2'].Path + 'images/syntaxhighlight.gif';

FCKToolbarItems.RegisterItem('SyntaxHighLight2', oSyntaxhighlightItem);













//Added by Sergey Gurevich (06/06/2009). -START
//Disabling control buttons when pointer selection is code in order to prevent styling.

function FCKeditorControlDisplay(ctrl, state)
{
	if (!ctrl) return;
	if (ctrl._UIButton) ctrl._UIButton.MainElement.style.visibility = (state) ? 'visible' : 'hidden';
	else if (ctrl._Combo) ctrl._Combo._OuterTable.style.visibility = (state) ? 'visible' : 'hidden';
	else alert('Unknown Control Type: ' + ctrl.Title);
}

function syntaxHighLight_btn_lock()
{
	var state = true;
	if (FCK.Selection.HasAncestorNode('PRE'))
	{
		var oContainerPre = FCK.Selection.MoveToAncestorNode('PRE');
		state = !(oContainerPre.getAttribute('title') == 'code');
	}
	
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Source'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['DocProps'], state);

//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Save'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['NewPage'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Preview'], state);

//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Templates'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Cut'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Copy'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['SyntaxHighLight'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Paste'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['PasteText'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['PasteWord'], state);

//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Print'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['SpellCheck'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Undo'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Redo'], state);

//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Find'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Replace'], state);

//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['SelectAll'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['RemoveFormat'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Form'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Checkbox'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Radio'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['TextField'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Textarea'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Select'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Button'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['ImageButton'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['HiddenField'], state);

	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Bold'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Italic'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Underline'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['StrikeThrough'], state);

	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Subscript'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Superscript'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['OrderedList'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['UnorderedList'], state);

	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Outdent'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Indent'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Blockquote'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['CreateDiv'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['JustifyLeft'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['JustifyCenter'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['JustifyRight'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['JustifyFull'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Link'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Unlink'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Anchor'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Image'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Flash'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Table'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Rule'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Smiley'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['SpecialChar'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['PageBreak'], state);

	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['Style'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['FontFormat'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['FontName'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['FontSize'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['TextColor'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['BGColor'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['FitWindow'], state);
//	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['ShowBlocks'], state);
	FCKeditorControlDisplay(FCKToolbarItems.LoadedItems['About'], state);
}


//Disabling buttons when code block is selected.
FCK.AttachToOnSelectionChange(syntaxHighLight_btn_lock);

//Added by Sergey Gurevich (06/06/2009). -END