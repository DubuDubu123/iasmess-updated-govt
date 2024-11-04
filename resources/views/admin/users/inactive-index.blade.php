@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')


<style type="text/css">
    .confirm.active {
    font-size: 0px;
    width: 40px;
    height: 40px;
    padding: 0px !important;
    background: none !important;
    border-radius: 50% !important;
    border-left-color: transparent !important;
    animation: rotate 0.5s ease 0.5s infinite;
    border: 3px solid blue;
}
@keyframes rotate{
  0%{
    transform: rotate(360deg);
  }
}
.modal-dialog{
    top:120px;
}
      .sendPush.active {
        font-size: 0px;
        width: 40px;
        height: 40px;
        padding: 0px !important;
        background: none !important;
        border-radius: 50% !important;
        border-left-color: transparent !important;
        animation: rotate 0.5s ease 0.5s infinite;
        border: 3px solid blue;
    }
    @keyframes rotate{
    0%{
        transform: rotate(360deg);
    }
    }
    input[type=file]::file-selector-button {
  margin-right: 10px;
  border: none;
  background: #084cdf;
  padding: 10px 10px;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
  font-size: 10px;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}

</style>


    <!-- Start Page content -->
    <section class="content">
        {{-- <div class="container-fluid"> --}}

        <div class="row" style="margin: 20px 20px 20px 20px;background: white;padding-top: 30px;border-radius:3px">
        <h3 style="
    padding-left: 30px;
    margin-bottom: 30px;
">Approved Officer's Details</h3>
            <div class="col-12">
                <div class="box">

                    <div class="box-header with-border">
                        <div class="row text-right">

                            <div class="col-8 col-md-3">
                                <div class="form-group">
                                    <input type="text" name="search" id="search_keyword" class="form-control"
                                        placeholder="@lang('view_pages.enter_keyword')">
                                </div>
                            </div>

                            <div class="col-4 col-md-2 text-left">
                                <button id="search" class="btn btn-success btn-outline btn-sm py-2" type="submit">
                                    @lang('view_pages.search')
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="js-user-partial-target">
                        <include-fragment src="in_active/fetch">
                            <span style="text-align: center;font-weight: bold;"> @lang('view_pages.loading')</span>
                        </include-fragment>
                    </div>


                </div>
            </div>

        </div>
        <!-- container -->

        {{-- </div> --}}
        <!-- content -->

        <script src="{{ asset('assets/js/fetchdata.min.js') }}"></script>
        <script>
            var search_keyword = '';
            var query = '';

            $(function() {
                $('body').on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    $.get(url, $('#search').serialize(), function(data) {
                        $('#js-user-partial-target').html(data);
                    });
                });

                $('#search').on('click', function(e) {
                    e.preventDefault();
                    search_keyword = $('#search_keyword').val();

                    fetch('in_active/fetch?search=' + search_keyword)
                        .then(response => response.text())
                        .then(html => {
                            document.querySelector('#js-user-partial-target').innerHTML = html
                        });
                });

                $('.filter,.resetfilter').on('click', function() {
                    let filterColumn = ['area'];

                    let className = $(this);
                    query = '';
                    $.each(filterColumn, function(index, value) {
                        if (className.hasClass('resetfilter')) {
                            $('input[name="' + value + '"]').prop('checked', false);
                            if(value == 'area') $('#service_location_id').val('all')
                            query = '';
                        } else {
                            if ($('input[name="' + value + '"]:checked').attr('id') != undefined) {
                                var activeVal = $('input[name="' + value + '"]:checked').attr(
                                    'data-val');

                                query += value + '=' + activeVal + '&';
                            }else if (value == 'area') {
                                var area = $('#service_location_id').val()

                                query += 'area=' + area + '&';
                            }
                        }
                    });

                    fetch('users/fetch?' + search_keyword)
                        .then(response => response.text())
                        .then(html => {
                            document.querySelector('#js-user-partial-target').innerHTML = html
                        });
                });
            });
            $(document).on('click', '.make-approve', function(e) {
                e.preventDefault();
                let url = $(this).attr('data-url');

                swal({
                    title: "Are you sure to Resend Payment Link ?",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonColor: "blue",
                    confirmButtonText: "Resend Payment Link",
                    cancelButtonText: "No! Keep it",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        $(".confirm").addClass("active");
                        $(".cancel").hide();
                       

                        $.ajax({
                            url: url,
                            cache: false,
                            success: function(res) { 
                                $(".confirm").removeClass("active");
                                $(".cancel").hide();
                                swal.close();
                                $.toast({
                                    heading: '',
                                    text: "Payment Link Sent Successfully",
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 5000,
                                    stack: 1
                                });
                                // window.location.reload();
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.sweet-delete', function(e) {
                e.preventDefault();

                let url = $(this).attr('data-url');


                swal({
                    title: "Are you sure to delete ?",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    cancelButtonText: "No! Keep it",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        swal.close();

                        $.ajax({
                            url: url,
                            cache: false,
                            success: function(res) {

                                fetch('in_active/fetch?search=' + search_keyword)
                                    .then(response => response.text())
                                    .then(html => {
                                        document.querySelector('#js-user-partial-target')
                                            .innerHTML = html
                                    });

                                $.toast({
                                    heading: '',
                                    text: res,
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 5000,
                                    stack: 1
                                });
                            }
                        });
                    }
                });
            });
            $(document).on('click', '.sendPush', function(e) {

e.preventDefault();
$(this).addClass("active");
var data_id = $(this).attr("data-id");
$.ajax({
            url: "{{url('/')}}/users/delete/"+data_id+"",
            cache: false,
            success: function(res) { 
                popup_close();
                $.toast({
                    heading: '',
                    text: "Updated Successfully",
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 5000,
                    stack: 1
                });
                window.location.reload();
                $(".sendPush").removeClass("active");  
            }
        });

});

$(document).on('click', '.make-confirm', function(e) {
e.preventDefault();
let url = $(this).attr('data-url');

swal({
    title: "Are you sure to Confirm Offline Payment?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: "blue",
    confirmButtonText: "Confirm Offline Payment",
    cancelButtonText: "No! Keep it",
    closeOnConfirm: false,
    closeOnCancel: true
}, function(isConfirm) {
    if (isConfirm) {
        $(".confirm").addClass("active");
        $(".cancel").hide();
        // swal.close();

        $.ajax({
            url: url,
            cache: false,
            success: function(res) { 
                $(".confirm").removeClass("active");
                $(".cancel").hide();
                $.toast({
                    heading: '',
                    text: "Confirmed Successfully",
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 5000,
                    stack: 1
                });
                window.location.reload();
            }
        });
    }
});
});

$(document).on('click', '.sweet-delete', function(e) {
    e.preventDefault();

    let url = $(this).attr('data-url');
    let data_id = $(this).attr('data-id');

    swal({
        title: "Are you sure to mark Officer as deceased?",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Mark Officer as deceased",
        cancelButtonText: "No! Keep it",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            swal.close();

            popup_init();
            var content = `<div class="popup_deceased">
            <div class="form-group" style="text-align: center;">
                <label for="image" style="font-size: 16px;">Legal Heir proof of family: </label><br>
                <img src="" id="blah" alt="" style="width: 300px; margin-bottom: 20px; display: none;"><br>
                <p id="pdfMessage" style="display: none;">PDF file uploaded: <span id="pdfFileName"></span></p>
                <input type="file" id="image" onchange="readURL(this)" name="image" style="display:none">
                <button class="btn btn-primary btn-sm" type="button" onclick="$('#image').click()" id="upload">Browse</button>
                <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                <span class="text-danger" id="fileError"></span>
            </div>
            </div><div class="form-group">
                <div class="col-12">
                    <button class="btn btn-primary btn-sm pull-right m-5 sendPush" id="submitDeceased" type="button" data-id="${data_id}" style="display:none;">Mark Officer as Deceased</button>
                </div>
            </div>`;
            popup_data(content);
        }
    });
});

// Function to read the file input and display image or handle PDF
function readURL(input) {
    var file = input.files[0];
    var fileType = file.type;
    var fileError = $('#fileError');
    var imageElement = $('#blah');
    var pdfMessage = $('#pdfMessage');
    var pdfFileName = $('#pdfFileName');
    var removeButton = $('#remove_img');
    var submitButton = $('#submitDeceased');  // Submit button

    fileError.html(''); // Clear any previous errors
    imageElement.hide(); // Hide image preview initially
    pdfMessage.hide(); // Hide PDF message initially
    removeButton.hide(); // Hide remove button initially
    submitButton.hide(); // Hide the submit button initially

    if (file) {
        if (fileType.match('image.*')) {
            // If it's an image file
            var reader = new FileReader();
            reader.onload = function(e) {
                imageElement.attr('src', e.target.result).show(); // Show image
                removeButton.show(); // Show remove button
                submitButton.show(); // Show submit button
            };
            reader.readAsDataURL(file);
        } else if (fileType === 'application/pdf') {
            // If it's a PDF file
            pdfFileName.text(file.name); // Show PDF file name
            pdfMessage.show(); // Show PDF message
            removeButton.show(); // Show remove button
            submitButton.show(); // Show submit button
        } else {
            // If it's neither an image nor a PDF
            fileError.html('Only image or PDF files are allowed.');
        }
    }
}

// Remove image or PDF
$('#remove_img').on('click', function() {
    $('#image').val(''); // Clear the file input
    $('#blah').hide(); // Hide image preview
    $('#pdfMessage').hide(); // Hide PDF message
    $('#fileError').html(''); // Clear error message
    $('#submitDeceased').hide(); // Hide submit button
    $(this).hide(); // Hide the remove button
});


        </script>
    @endsection
