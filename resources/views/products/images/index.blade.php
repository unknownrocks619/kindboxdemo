@extends("layouts.app")

@section("css")
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section("content")
    <div id="section">
        @include("inc.nav")
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ $product->product_name }} :: Gallery Images</h1>
                <a href="{{ route('products.product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> 
                    Back to Product List
                </a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Product Images
                            </h6>
                        </div>
                        <div class="card-body">
                            <x-alert></x-alert>

                            <div class="row">
                                @foreach ($products_image as $image)
                                @php
                                    $image_path = json_decode($image->file);
                                @endphp
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ asset ($image_path->path) }}" class="img-responsive img-thumbnail">
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <form action="{{ route('products.product_gallery_delete',[$image->id]) }}" method="post">
                                                            @csrf
                                                            @method("DELETE")
                                                            <button type="submit" class='btn btn-sm btn-danger'>
                                                                <i class="fas fa-trash"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Drag / Drop Your Photo to Upload
                            </h6>
                        </div>
                        <div class="card-body">
                            <form class="dropzone" action="{{ route('products.product_gallery_store',$product->id) }}" id="dropzone_form" method="post">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Dropzone.autoDiscover = false;
        $("form#dropzone_form").dropzone({
        addRemoveLinks: true,
        success: function (file, response) {
            if (response.success == true) {
                location.reload();
            }
            // var imgName = response;
            // file.previewElement.classList.add("dz-success");
            // console.log("Successfully uploaded :" + imgName);
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        },
        removedfile : function (file) {

            var fileRef;
                return (fileRef = file.previewElement) != null ? 
                      fileRef.parentNode.removeChild(file.previewElement) : void 0;
        }
    });

    </script>
@endsection