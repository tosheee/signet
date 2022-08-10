<script>
    // create the editor
    const container = document.getElementById("jsoneditor");
    const options = {"mode": "code"};
    const editor = new JSONEditor(container, options);

    // set json
    var json_data = "{{ $category->filters ?? '{}'}}";
    const initialJson = JSON.parse(json_data.replace(/&quot;/g,'"'));
    editor.set(initialJson);

    // get json
    $('#form-category').submit(function() {
        const updatedJson = editor.get();
        var json_to_string = JSON.stringify(updatedJson);
        $('#json-data-filter').val(json_to_string);
    })
</script>