 <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
data-aos-delay="200">
<!-- Single Prodect -->
<div class="product">
    <div class="thumb">
        <a href="{{ url('product/details') }}/{{ $allproduct->product_slug }}" class="image">
            <img src="{{ asset('uploads/product_photo') }}/{{ $allproduct->product_photo }}" alt="Product" />
        </a>
        <div class="actions">
                <a href="#" class="action wishlist" title="Wishlist">
                    <i class="fa {{ (wishlistcheck($allproduct->id))? 'fa-heart text-danger' : 'fa fa-heart-o'}}"></i>
                </a>


            {{-- <a href="#" class="action quickview" data-link-action="quickview"
                title="Quick view" data-bs-toggle="modal"
                data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a> --}}
        </div>
        {{-- <button title="Add To Cart" class=" add-to-cart">Add
            To Cart</button> --}}
    </div>
    <div class="content">
        <span class="ratings">
            <span class="rating-wrap">
                <span class="star" style="width: {{ rating_percentage($allproduct->id) }}%"></span>
            </span>
            <span class="rating-num">( {{how_many_review($allproduct->id)}})</span>
        </span>

        <h5 class="title"><a href="{{ url('product/details') }}/{{ $allproduct->product_slug }}">{{ $allproduct->product_name }}
            </a>
        </h5>
        <span class="price">
            <span class="new">${{ $allproduct->product_price }}</span>
        </span>

        <span class="price">
            <span class="new">Vendor: {{ App\Models\User::find($allproduct->user_id)->name }}</span>
        </span>

    </div>
</div>
</div>
