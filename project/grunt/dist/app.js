/*Processed by SNA Labs on 20/1/2024 @ 7:46:30*/
// init Masonry
let $grid = $('#masonry-area').masonry({
    // itemSelector: '.col',
    // columnWidth: '.col',
    percentPosition: true
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
    $grid.masonry('layout');
});

//
$.post('/api/posts/count', {
    id: 10
}, function(data) {
    console.log(data);
    $('#total-posts').html("Total posts: " + data.count);
});

$('#share-memory').on('click', function(){
    var formData = new FormData();
    var files = $('#post_image')[0].files;
    if ($('#post_text').val() == "") {
        t = new Toast('Error', 'now', 'Please enter a caption');
        t.show();
        return;
    }
    if (files.length > 0) {
        formData.append('post_image', files[0]);
        formData.append('post_text', $('#post_text').val());

        $.ajax({
            url: '/api/posts/add', // Replace with your server endpoint
            type: 'POST',
            data: formData,
            contentType: false, // Important: Set content type to false
            processData: false, // Important: Do not process the data
            success: function(response) {
                console.log('File uploaded successfully');
                console.log(response);
                response = $(response);
                $grid.prepend(response).masonry('prepended', response).masonry('layout');
                $grid.imagesLoaded().progress( function() {
                    $grid.masonry('layout');
                });
                $('#post_image').val("");
                $('#post_text').val("");
            },
            error: function(error) {
                console.error('Error uploading file');
                console.log(error);
            }
        });
    } else {
        t = new Toast('Error', 'now', 'Please select a file to upload');
        t.show();
    }
});

// Function to set a cookie
function setCookie(name, value, daysToExpire) {
  var expires = "";
  
  if (daysToExpire) {
    var date = new Date();
    date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }

  document.cookie = name + "=" + value + expires + "; path=/";
}

$(document).on('click', '.album .btn-like', function(){
    post_id = $(this).parent().attr('data-id');
    $this = $(this);
    $(this).html() == "Like" ? $(this).html("Liked") : $(this).html("Like");
    $(this).hasClass('btn-outline-primary') ? $(this).removeClass('btn-outline-primary').addClass('btn-primary') : $(this).removeClass('btn-primary').addClass('btn-outline-primary');
    $.post('/api/posts/like', {
        id: post_id
    }, function(data, textSuccess, xhr){
        if(textSuccess == "success"){
            if(data.liked){
                $($this).html("Liked");
                $($this).removeClass('btn-outline-primary').addClass('btn-primary');
            } else {
                $($this).html("Like");
                $($this).removeClass('btn-primary').addClass('btn-outline-primary');
            }
        }
    });
});

$(document).on('click', '.album .btn-delete', function(){
    post_id = $(this).parent().attr('data-id');
    d = new Dialog("Delete Post", "Are you sure want to remove this post");
    d.setButtons([
        {
            'name': "Delete",
            "class": "btn-danger",
            "onClick": function(event){
                console.log(`Assume this post ${post_id} is deleted`);
                // $(`#post-${post_id}`).remove();
                
                $.post('/api/posts/delete',
                {
                    id: post_id
                }, function(data, textSuccess, xhr){
                    console.log(textSuccess);
                    console.log(data);

                    if(textSuccess =="success" ){ //means 200
                        var el = $(`#post-${post_id}`)[0]
                        $grid.masonry('remove', el).masonry('layout');
                    }
                });

                $(event.data.modal).modal('hide')
            }
        },
        {
            'name': "Cancel",
            "class": "btn-secondary",
            "onClick": function(event){
                $(event.data.modal).modal('hide');
            }
        }
    ]);
    d.show();
});




// $(document).ready(function(){
//     dialog("Notify", "Page finished loading");

//     $('#exampleModal').on('show.bs.modal', function(){
//         console.log("Modal is being shown");
//     });

//     $('#exampleModal').on('shown.bs.modal', function(){
//         console.log("Modal has been shown");
//     });

//     $('#exampleModal').on('hide.bs.modal', function(){
//         console.log("Modal is being hidden");
//     });

//     $('#exampleModal').on('hidden.bs.modal', function(){
//         console.log("Modal is hidden");
//     });

//     $('#exampleModal').on('mouseover', function(){
//         console.log("Mouse is over this button");
//     });

//     $('#textbox').on('keydown', function(event){
//         console.log(event.originalEvent.key + " Key is pressed")
//     });

//     $('#textbox').on('keyup', function(event){
//         console.log(event.originalEvent.key + " Key is released")
//     });

//     $('#liveToastBtn').click(function(){
//         var el = $('#liveToast');
//         new bootstrap.Toast(el).show();
//     });

//     $('#fetchModal').on('click', function(){
//         $.get('/api/demo/modal', function(data, textStatus){
//             $('main#mainel').append(data);
//         });
//     });

    
// });
//# sourceMappingURL=app.js.map