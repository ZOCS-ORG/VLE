tinymce.init({
    selector: "textarea", // Specify the ID of your textarea
    plugins: [
        "autolink",
        "lists",
        "link",
        "image",
        "media",
        "preview",
        "searchreplace",
        // "wordcount",
        "code",
        "fullscreen",
    ],
    toolbar: [
        "undo redo | styleselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview fullscreen",
    ],
});