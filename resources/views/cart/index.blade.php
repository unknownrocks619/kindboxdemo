@extends("layouts.p")

@section("content")
@php
    $sub_total = 0;
    $amount_for_project = 0;
    $total = 0;
@endphp
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-7">
                <h5 class="mb-3"><a href="/" class="text-body"><i
                      class="icofont-arrow-left me-2"></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping cart</p>
                    <p class="mb-0">You have @if(session()->has("count"))  {{ count(session()->get('cart')) }} @else 0 @endif items in your cart</p>
                  </div>
                  <div>
                    <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                        class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                  </div>
                </div>
                @if( ! session()->has('cart') )
                    <h3>Nothing In your Cart.

                    <a href='/'>Continue Shoping</a>
                    </h3>
                @elseif(  ! count(session()->get('cart')))
                    <h3>Nothing In your Cart.
                    {{ dd(count(session()->get('cart'))) }}
                    <a href='/'>Continue Shoping</a>
                    </h3>
                @else


                @foreach ($carts as $cart)
                    @php
                        $sub_total += $cart["price"];
                    @endphp
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div>
                                <img
                                    src="{{ $cart['thumb'] }}"
                                    class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                </div>
                                <div class="ms-3">
                                <h5>{{ $cart["name"] }}</h5>
                                <p class="small mb-0">{{ $cart["u_price"] }}</p>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <div style="width: 90px;">
                                <h5 class="fw-normal mb-0">{{ $cart["qty"] }} QTY</h5>
                                </div>
                                <div style="width: 140px;">
                                <h5 class="mb-0">AUD {{ number_format($cart["price"],2) }}</h5>
                                </div>
                                <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                @endif

                


              </div>
              <div class="col-lg-5">

                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Card details</h5>
                    </div>

                    <p class="small mb-2">Card type</p>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-visa fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-amex fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                    <form action="{{ route('shop.checkout') }}" id="checkout_form" method="post" class="mt-4">
                        @csrf
                      <div class="form-outline form-white mb-4">
                          @php
                              $projects = \App\Models\Project::get();
                          @endphp
                          <select name="project" id="" class="form-control form-control-lg">
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{ $project->project_title }}</option>
                            @endforeach
                          </select>
                          @error("project")
                              <div class="text-danger">
                                  {{ $message }}
                              </div>
                          @enderror
                        <!-- <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                          placeholder="Cardholder's Name" /> -->
                        <label class="form-label" for="typeName">Select Project <sup class="text-danger">*</sup></label>
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                          value="1234 5678 9012 3457" minlength="19" maxlength="19" />
                        <label class="form-label" for="typeText">Card Number</label>
                      </div>

                      <div class="row mb-4">
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                              value="{{ date('m/Y') }}" size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Expiration</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="password" id="typeText" class="form-control form-control-lg"
                              value="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                          </div>
                        </div>
                      </div>


                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2">AUD {{ $sub_total }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Amount to Project</p>
                      <p class="mb-2">
                        @php
                            $price = ($sub_total * 10 ) / 100;
                            echo "AUD " . number_format($price,2);
                        @endphp
                      </p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total(Incl. taxes)</p>
                      <p class="mb-2">AUD {{ number_format($sub_total,2) }}</p>
                    </div>
                        <button type="submit" class="btn btn-info btn-block btn-lg">
                            <div class="d-flex justify-content-between">
                                <span>AUD {{ number_format($sub_total,2) }} </span> &nbsp;
                                <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                            </div>
                        </button>
                    </form>
                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section("js")

    <script>
        $("form#checkout_form").submit( function (event) {
            event.preventDefault();

            $.ajax({
                type : "POST",
                data : $(this).serializeArray(),
                url : $(this).attr('action'),
                success : function (response) {
                    // location.reload();
                        Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Cool'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href=  "http://demo.chakra-tech.com";
                            }
                        })
                }
            })
        })
        
    </script>
@endsection