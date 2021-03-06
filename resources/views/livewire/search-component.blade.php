<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Accueil</a></li>
                <li class="item-link"><span>Recherche</span></li>
                <li class="item-link"><span>{{ $search }}</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="banner-shop">
                    <a href="javascript:void(0);" class="banner-link">
                        <figure><img src="{{ asset('assets/images/shop-banner.jpg') }}" alt=""></figure>
                    </a>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title">Produits</h1>

                    <div class="wrap-right">

                        <div class="sort-item orderby ">
                            <select name="orderby" class="use-chosen" wire:model="sorting">
                                <option value="default" selected="selected">Tri par défaut</option>
                                <option value="date">Trier par nouveauté</option>
                                <option value="price">Trier par prix : faible à élevé</option>
                                <option value="price-desc">Trier par prix : de haut en bas</option>
                            </select>
                        </div>

                        <div class="sort-item product-per-page">
                            <select name="post-per-page" class="use-chosen"  wire:model="pagesize">
                                <option value="12" selected="selected">12 par page</option>
                                <option value="16">16 par page</option>
                                <option value="18">18 par page</option>
                                <option value="21">21 par page</option>
                                <option value="24">24 par page</option>
                                <option value="30">30 par page</option>
                                <option value="32">32 par page</option>
                            </select>
                        </div>

                        <div class="change-display-mode">
                            <a href="javascript:void(0);" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                            <a href="javascript:void(0);" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                        </div>

                    </div>

                </div><!--end wrap shop control-->
                @if ($products->count() > 0)
                    <div class="row">

                        <ul class="product-list grid-products equal-container">
                            @foreach ($products as $product)
                                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                    <div class="product product-style-3 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('product.details', $product->slug) }}" title="{{ $product->name }}">
                                                <figure><img src="{{ asset('assets/images/products') }}/{{ $product->image }}" alt="{{ $product->name }}"></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('product.details', $product->slug) }}" class="product-name"><span>{{ $product->name }}</span></a>
                                            <div class="wrap-price"><span class="product-price">{{ priceFormat($product->regular_price) }}</span></div>
                                            {{-- <a href="javascript:void(0);" class="btn add-to-cart" wire:click.prevent="store({{$product->id}}, {{ $product->name }}, {{ $product->regular_price }})">Add To Cart</a> --}}
                                            <a href="javascript:void(0);" class="btn add-to-cart" wire:click.prevent="store({{$product->id}}, '{{ $product->name }}', {{ $product->regular_price }})">Add To Cart</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @else
                    <p style="padding-top: 30px;">Acun produit trouver</p>
                @endif

                <div class="wrap-pagination-info">
                    {{ $products->links() }}
                    {{-- <ul class="page-numbers">
                        <li><span class="page-number-item current" >1</span></li>
                        <li><a class="page-number-item" href="javascript:void(0);" >2</a></li>
                        <li><a class="page-number-item" href="javascript:void(0);" >3</a></li>
                        <li><a class="page-number-item next-link" href="javascript:void(0);" >Next</a></li>
                    </ul>
                    <p class="result-count">Showing 1-8 of 12 result</p> --}}
                </div>
            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget categories-widget">
                    <h2 class="widget-title">Toute les categories</h2>
                    <div class="widget-content">
                        <ul class="list-category">
                            @foreach ($categories as $category)
                                <li class="category-item">
                                    <a href="{{ route('product.category', ['category_slug' => $category->slug]) }}" class="cate-link">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget filter-widget brand-widget">
                    <h2 class="widget-title">Brand</h2>
                    <div class="widget-content">
                        <ul class="list-style vertical-list list-limited" data-show="6">
                            <li class="list-item"><a class="filter-link active" href="javascript:void(0);">Fashion Clothings</a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Laptop Batteries</a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Printer & Ink</a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">CPUs & Prosecsors</a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Sound & Speaker</a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Shop Smartphone & Tablets</a></li>
                            <li class="list-item default-hiden"><a class="filter-link " href="javascript:void(0);">Printer & Ink</a></li>
                            <li class="list-item default-hiden"><a class="filter-link " href="javascript:void(0);">CPUs & Prosecsors</a></li>
                            <li class="list-item default-hiden"><a class="filter-link " href="javascript:void(0);">Sound & Speaker</a></li>
                            <li class="list-item default-hiden"><a class="filter-link " href="javascript:void(0);">Shop Smartphone & Tablets</a></li>
                            <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="javascript:void(0);">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div><!-- brand widget-->

                <div class="widget mercado-widget filter-widget price-filter">
                    <h2 class="widget-title">Price</h2>
                    <div class="widget-content">
                        <div id="slider-range"></div>
                        <p>
                            <label for="amount">Price:</label>
                            <input type="text" id="amount" readonly>
                            <button class="filter-submit">Filter</button>
                        </p>
                    </div>
                </div><!-- Price-->

                <div class="widget mercado-widget filter-widget">
                    <h2 class="widget-title">Color</h2>
                    <div class="widget-content">
                        <ul class="list-style vertical-list has-count-index">
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Red <span>(217)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Yellow <span>(179)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Black <span>(79)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Blue <span>(283)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Grey <span>(116)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">Pink <span>(29)</span></a></li>
                        </ul>
                    </div>
                </div><!-- Color -->

                <div class="widget mercado-widget filter-widget">
                    <h2 class="widget-title">Size</h2>
                    <div class="widget-content">
                        <ul class="list-style inline-round ">
                            <li class="list-item"><a class="filter-link active" href="javascript:void(0);">s</a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">M</a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">l</a></li>
                            <li class="list-item"><a class="filter-link " href="javascript:void(0);">xl</a></li>
                        </ul>
                        <div class="widget-banner">
                            <figure><img src="{{ asset('assets/images/size-banner-widget.jpg') }}" width="270" height="331" alt=""></figure>
                        </div>
                    </div>
                </div><!-- Size -->

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">Popular Products</h2>
                    <div class="widget-content">
                        <ul class="products">
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="javascript:void(0);" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                            <figure><img src="{{ asset('assets/images/products/digital_1.jpg') }}" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                        <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="javascript:void(0);" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                            <figure><img src="{{ asset('assets/images/products/digital_17.jpg') }}" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                        <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="javascript:void(0);" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                            <figure><img src="{{ asset('assets/images/products/digital_18.jpg') }}" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                        <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="javascript:void(0);" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                            <figure><img src="{{ asset('assets/images/products/digital_20.jpg') }}" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                        <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div><!-- brand widget-->

            </div><!--end sitebar-->

        </div><!--end row-->

    </div><!--end container-->

</main>
