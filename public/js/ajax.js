jQuery(document).ready(function($){
    ////----- Open the modal to CREATE a link -----////
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#modalFormData').trigger("reset");
        jQuery('#linkEditorModal').modal('show');
    });

    ////----- Open the modal to UPDATE a link -----////
    jQuery('body').on('click', '.open-modal', function () {
        var link_id = $(this).val();
        $.get('links/' + link_id, function (data) {
            jQuery('#link_id').val(data.id);
            jQuery('#link').val(data.url);
            jQuery('#description').val(data.description);
            jQuery('#btn-save').val("update");
            jQuery('#linkEditorModal').modal('show');
        })
    });

    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            url: jQuery('#link').val(),
            description: jQuery('#description').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var link_id = jQuery('#link_id').val();
        var ajaxurl = 'links';
        if (state == "update") {
            type = "PUT";
            ajaxurl = 'links/' + link_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var link = '<tr id="link' + data.id + '"><td>' + data.id + '</td><td>' + data.url + '</td><td>' + data.description + '</td>';
                link += '<td><button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>&nbsp;';
                link += '<button class="btn btn-danger delete-link" value="' + data.id + '">Delete</button></td></tr>';
                if (state == "add") {
                    jQuery('#links-list').append(link);
                } else {
                    $("#link" + link_id).replaceWith(link);
                }
                jQuery('#modalFormData').trigger("reset");
                jQuery('#linkEditorModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    ////----- DELETE a link and remove from the page -----////
    jQuery('.delete-link').click(function () {
        var link_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: 'links/' + link_id,
            success: function (data) {
                console.log(data);
                $("#link" + link_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});




// shunisini qib koraman shunisi yaxshiroga oxshidi
// $(document).ready(function () {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     /*  When user click add user button */
//     $('#create-new-user').click(function () {
//         $('#btn-save').val("create-user");
//         $('#userForm').trigger("reset");
//         $('#userCrudModal').html("Add New User");
//         $('#ajax-crud-modal').modal('show');
//     });

//    /* When click edit user */
//     $('body').on('click', '#edit-user', function () {
//       var user_id = $(this).data('id');
//       $.get('ajax-crud/' + user_id +'/edit', function (data) {
//          $('#userCrudModal').html("Edit User");
//           $('#btn-save').val("edit-user");
//           $('#ajax-crud-modal').modal('show');
//           $('#user_id').val(data.id);
//           $('#name').val(data.name);
//           $('#email').val(data.email);
//       })
//    });
//    //delete user login
//     $('body').on('click', '.delete-user', function () {
//         var user_id = $(this).data("id");
//         confirm("Are You sure want to delete !");

//         $.ajax({
//             type: "DELETE",
//             url: "{{ url('ajax-crud')}}"+'/'+user_id,
//             success: function (data) {
//                 $("#user_id_" + user_id).remove();
//             },
//             error: function (data) {
//                 console.log('Error:', data);
//             }
//         });
//     });
//   });

//  if ($("#userForm").length > 0) {
//       $("#userForm").validate({

//      submitHandler: function(form) {

//       var actionType = $('#btn-save').val();
//       $('#btn-save').html('Sending..');

//       $.ajax({
//           data: $('#userForm').serialize(),
//           url: "https://www.tutsmake.com/laravel-example/ajax-crud/store",
//           type: "POST",
//           dataType: 'json',
//           success: function (data) {
//               var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
//               user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
//               user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';


//               if (actionType == "create-user") {
//                   $('#users-crud').prepend(user);
//               } else {
//                   $("#user_id_" + data.id).replaceWith(user);
//               }

//               $('#userForm').trigger("reset");
//               $('#ajax-crud-modal').modal('hide');
//               $('#btn-save').html('Save Changes');

//           },
//           error: function (data) {
//               console.log('Error:', data);
//               $('#btn-save').html('Save Changes');
//           }
//       });
//     }
//   })
// }
