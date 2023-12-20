/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    config.language = "es";
    config.height = "400";
	
    config.toolbarGroups = [
        { name: "document", groups: ["mode", "document", "doctools"] },
        { name: "clipboard", groups: ["clipboard", "undo"] },
        {
            name: "editing",
            groups: ["find", "selection", "spellchecker", "editing"],
        },
        { name: "forms", groups: ["forms"] },
        { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
        {
            name: "paragraph",
            groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"],
        },
        { name: "links", groups: ["links"] },
        { name: "insert", groups: ["insert"] },
        { name: "styles", groups: ["styles"] },
        { name: "colors", groups: ["colors"] },
        { name: "tools", groups: ["tools"] },
        { name: "others", groups: ["others"] },
        { name: "about", groups: ["about"] },
    ];

    config.removeButtons =
        "Save,NewPage,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,About,ShowBlocks,Maximize,Language,Anchor,Smiley,PageBreak,CreateDiv,Blockquote,Indent,Outdent,Font,FontSize";
};
