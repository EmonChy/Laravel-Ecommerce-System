<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>


<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


<!-- real time add to cart products  -->

<script>
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
 //  addToCart used in cart-button page

    function addToCart(product_id) {
        var url = "{{ url('/') }}";

        $.post(url+"/api/carts/store",
         { product_id: product_id

          })
            .done(function( data ) {
                data = JSON.parse(data);
                if(data.status == 'success'){
                    // toast
                     alertify.set('notifier','position', 'top-center');
                     alertify.success('Item added to cart successfully !! Total Items' + data.totalItems
                     + '<br/>To checkout <a href="{{ route('carts') }}">Go to checkout</a>');
                     $("#totalItems").html(data.totalItems);
                } 
       });
    }
</script>