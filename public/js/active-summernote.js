function activeSummerNote(height, theme, el){

    height = typeof height == 'undefined' ? 150 : height;
    theme = typeof theme == 'undefined' ? 'monokai' : theme;
    el = typeof el == 'undefined' ? '.content-summernote' : el;
    $(el).summernote({
        height: height,   //set editable area's height
        codemirror: { // codemirror options
            theme: theme
        },
        toolbar: [
            // [groupName, [list of button]]
            //['style', ['style']],
            ['fontstyle', ['bold', 'italic', 'underline']],
            ['fontname', ['fontsize', 'fontname']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['color', ['color']],
            ['misc', ['fullscreen', 'codeview']],
            //['height', ['height']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'hr', 'picture', 'audio']],
            ['quizfill', ['quizFill']],
            ['quizdropdown', ['quizDropDown']],
            ['table', ['table']],
            ['quiztextentry', ['quizTextEntry']]
        ],
        callbacks: {
            onInit: function() {
                //console.log('Summernote is launched');
            }
        }
    });
}

function showContentSummerNote(content, el) {
    if(el == '' || el == undefined) {
        el = ".content-summernote";
    }
    $(el).summernote("code", content);
}

function getContentSummerNote(el) {
    if(el == '' || el == undefined) {
        el = ".content-summernote";
    }
    return $(el).summernote("code");
}