<form action="{{ route('carts.store')}}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}" >
        <button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i>Add to cart</button>                
</form>