<link href='https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/js/froala_editor.pkgd.min.js'></script>
<script>
    window.addEventListener('load', function () {
        new FroalaEditor('textarea#text', {
            pastePlain: true
        });
    }, false);
</script>
<textarea id="text" name="text" required>{{$text}}</textarea>
