@extends("layouts.app")

@section("content")
<div id="content">
    @include("inc.nav")
    <!-- Begin Page Content -->
    <div class="container-fluid">
            <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
            <a
            href="{{ route('products.product.index') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
            ><i class="fas fa-arrow-left fa-sm text-white-50"></i> 
            Go back
            </a
            >
        </div>

        <div class="row">
            <div class="col-md-12">
                <x-alert></x-alert>
                <div id="response_message" style="display:none"></div>
                <form id="product_form" action="{{ route('products.product.update',$product->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Add Product
                            </h6>
                        </div>
                        <div class="card-body">                        
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="product_name" class="label-control">Product Name
                                            <sup class="text-danger">
                                                *
                                            </sup>
                                        </label>
                                        <input type="text" value="{{$product->product_name}}" name="product_name" id="product_name" class="form-control">
                                        <div id="product_name_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_code" class="label-control">Product Code
                                            <sup class="text-danger">
                                                *
                                            </sup>
                                            <br />
                                        </label>
                                        <input disabled value="{{strtoupper($product->product_code)}}" type="text" name="product_code" id="product_code" class="form-control" />
                                            <div id="product_code_error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="label-control">Description</label>
                                        <textarea name="description" id="description" class="form-control">{{$product->product_full_description}}</textarea>
                                        <div id="description_error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="item_price" class="label-control">Item Price
                                        <sup class="text-danger">
                                            *
                                        </sup>
                                    </label>
                                    <input type="text" value="{{$product->item_price}}" name="item_price" id="item_price" class="form-control" />
                                    <div id="item_price_error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="available_quantity" class="label-control">Available Quantity
                                        <sup class="text-danger">
                                            *
                                        </sup>
                                    </label>
                                    <input type="number" value="{{$product->available_quantity}}" name="available_quantity" id="available_quantity" class="form-control" />
                                    <div id="available_quantity_error"></div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="featured_image" class="label-control">Featured Image
                                        </label>
                                        <input type="file" name="featured_image" id="featured_image" class="form-control" />
                                        <div id="featured_image_error"></div>
                                    </div>
                                </div>
                                @if($product->featured_image)
                                <div class="col-md-4">
                                    <img src="{{ asset ($product->featured->path) }}" class='img img-thumbnail' /> 
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update Product</button>
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
      $("form#product_form").submit(function(event) {
          event.preventDefault();
          tinyMCE.triggerSave();
          var form_record = new FormData($("form#product_form")[0]);
            $("#response_message").fadeOut('fast',function(){
                $(this).empty();
            })
            var error_fields = [
                "product_name_error",
                "product_code_error",
                "description",
                "item_price",
                "available_quantity"
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