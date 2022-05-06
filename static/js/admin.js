$("#input-logo").change(function () {    
    const [file] = $(this)[0].files;
    if (file) {
        $("#img-logo")[0].src = URL.createObjectURL(file)
    }
});