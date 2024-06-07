<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
         .error{
            color: red;
         }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <div class="py-5 text-center">
        <h2>Make Payment here</h2>

    </div>

    <div class="row">
        <div class="col-md-6 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form method="POST" class="needs-validation" action="{{ route('payment_page', $event->event_unique_code) }}">
             
             @csrf
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label>Event<small style="color: brown">*</small></label>
                          <select name="event_id" id="event_id" class="form-control"> 
                              <option value="">---Select Event---</option>
                               <option value="{{ $event->id }}" {{$event_unique_code=$event->event_unique_code  ? "selected": ""  }}>{{ $event->name }}</option>
                          </select>
                            @error('event_id')
                                <div class="error">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="form-group col-sm-8">
                        <label>Employee<small style="color: brown">*</small></label>
                          <select name="employee_id" id="employee_id" class="form-control">
                            <option value="">---Select Employee---</option>
                            @foreach ($employee as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                          </select>
                          @error('employee_id')
                          <div class="error">{{$message}}</div>
                      @enderror
                    </div>
                </div>
                 <input type="text" value="" id="event_code" name="event_code" hidden>
                <hr class="mb-4">
                  
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2024 SSLwireless</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<!-- If you want to use the popup integration, -->


<script> 
   
     
    $(document).ready(function(){
         $('#event_id').on('change', function() {
             
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
             var event_id = $(this).val();
                $.ajax({
                 url: '{{ url("event_code") }}', 
                 type: 'POST', 
                 data: { event_id: event_id },
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                 success: function(response) {
                   console.log(response.event_unique_code);
                   $("#event_code").val(response.event_unique_code);
                 }
             });
         });
     });
 
 </script>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


<script>
 






    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
</html>
