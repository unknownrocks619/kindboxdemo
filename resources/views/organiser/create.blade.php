@extends("layouts.app")
@section("content")
<div id="content">
    @include("inc.nav")
    <!-- Begin Page Content -->
    <div class="container-fluid">
            <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Organiser</h1>
            <a
            href="{{ route('organiser.organiser.index') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
            ><i class="fas fa-arrow-left fa-sm text-white-50"></i> 
            Go Back
            </a
            >
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="response_message" style="display:none"></div>
                <form id="new_org" action="{{ route('organiser.organiser.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                New Organiser
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="lable-control">Organisation Name
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" name="name" id="name" class="form-control">
                                        <div id="name_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 bg-dark pt-2">
                                    <div class="form-group">
                                        <textarea id="description" name="description"></textarea>
                                        <div id="description_error"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="featured_image" class="label-control">
                                            Select Featured Image
                                        </label>
                                        <input type="file" name="featured_image" id="featured_image" class="form-control" />
                                        <dir id="featured_image_error"></dir>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="website" class="label-control">Website</label>
                                        <input type="url" class="form-control" name="website" id="website" />
                                        <div id="website_error"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-block btn-primary">Save Organisation Detail</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("js")
<script src="https://cdn.tiny.cloud/1/gfpdz9z1bghyqsb37fk7kk2ybi7pace2j9e7g41u4e7cnt82/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
      height: '400'
    });
  </script>

  <script>
      $("form#new_org").submit(function(event) {
          event.preventDefault();
          tinyMCE.triggerSave();
          var form_record = new FormData($("form#new_org")[0]);
            $("#response_message").fadeOut('fast',function(){
                $(this).empty();
            })
            var error_fields = [
                "name",
                "description",
                "featured_image",
                "webiste"
            ];
            $.each(error_fields, function(key, val) {
                $("#"+val+"_error").empty().removeClass("text-danger");
            })
            $.ajax( {
                data : form_record,
                url : $(this).attr('action'),
                type : "POST",
                dataType : "Json",
                contentType : false,
                processData: false,
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

              success : function (response) {
                  console.log(response.success);
                if (response.success === true) {
                    $("#response_message").html("<div class='alert alert-success'>"+response.message+"</div>");
                    window.location.href = response.redirect;
                } else {
                    $("#response_message").html("<div class='alert alert-danger'>"+response.message+"</div>");
                }
                $("#response_message").fadeIn('fast');
                document.getElementById("response_message").scrollIntoView({behavior : 'smooth'});
              },
              error : function (reject) {
                var response = $.parseJSON(reject.responseText);
                $("#response_message").fadeIn('medium',function (){
                    $(this).html("<div class='alert alert-danger'>"+response.message+"</div>");
                });
                $.each(response.errors, function(key, val) {
                    console.log("#"+key + "_error");
                    console.log(val[0]);
                    $("#" + key + "_error").addClass('text-danger').html(val[0]);
                })
                document.getElementById("response_message").scrollIntoView({behavior : 'smooth'});

              }
          })
      })
  </script>
@endsection