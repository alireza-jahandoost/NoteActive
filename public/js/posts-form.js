BalloonEditor
.create( document.querySelector( '#editor' ) )
.catch( error => {
    console.error( error );
} );
let form = $('#create-new-post-form');
let div = $('#editor');
form.find('#submit-form').click(function () {
    let element = $(`<input type="hidden" name="body" value="${encodeURIComponent(div.html())}"/>`);
    form.append(element);
    form.submit();
});
form.find('#delete-image').click(function () {
    let element = $(`<input type="hidden" name="delete_image" value="true" />`);
    form.append(element);
    $('.image-div').html(`<p>there is no image for this post</p>`);
});
