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
            href="{{ route('products.product.create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            ><i class="fas fa-plus fa-sm text-white-50"></i> 
            New Product
            </a
            >
        </div>

        <div class="row">
            <div class="col-md-12">
                <x-alert></x-alert>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                        Products Table
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table bordered table-heading table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Product Name</th>
                                    <th>
                                        Product Price
                                    </th>
                                    <th>
                                        Avability
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $product->product_name }}
                                        </td>
                                        <td>
                                            AUD {{ number_format($product->item_price,2) }}
                                        </td>
                                        <td>
                                            @if($product->available_quantity > 0 )
                                                <span class="badge badge-success px-2">Yes</span>
                                            @else
                                            <span class="badge badge-danger px-2">No</span>

                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('products.product.edit',$product->id) }}">Edit</a>
                                             | 
                                             <a href="{{ route('products.product_gallery_view',$product->id) }}">Gallery</a>
                                            |
                                             <form style="display:inline" onsubmit="return confirm('Are you sure? This action cannot be undone.')" action="{{ route('products.product.destroy',$product->id) }}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-link px-0 mx-0 text-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
    </div>
</div>
@endsection