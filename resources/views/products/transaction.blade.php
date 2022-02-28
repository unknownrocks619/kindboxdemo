@extends("layouts.app")

@section("content")
<div id="content">
    @include("inc.nav")
    <!-- Begin Page Content -->
    <div class="container-fluid">
            <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Project Transaction</h1>
            <a
            href="{{ route('organiser.project.index') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
            ><i class="fas fa-arrow-left fa-sm text-white-50"></i> 
            Back
            </a
            >
        </div>

        <div class="row">
            <div class="col-md-12">
                <x-alert></x-alert>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Transaction:: {{ $project->project_title }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Product</th>
                                    <th>
                                        Unit Price
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @php
                                                $product = json_decode($transaction->product);
                                                echo $project->name
                                            @endphp
                                        </td>

                                        <td>
                                            AUD {{ number_format($product->u_price,2) }}
                                        </td>
                                        <td>
                                            {{ $product->qty }}
                                            
                                        </td>
                                        <td>
                                            <span class="badge badge-success">
                                                AUD {{ number_format($transaction->total,2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-dagner">
                                                @php
                                                    $deduct_amount = ($transaction->total * 10 /100);
                                                    echo "AUD ". number_format($deduct_amount,2);
                                                @endphp
                                            </span>
                                        </td>
                                    </tr>
                                   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection