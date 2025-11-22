<!doctype html>
@if (App::getLocale() == 'ar')
    <html lang="ar" dir="rtl">
@else
    <html lang="en">
@endif

    @include('frontend.layouts.head')

<body>

<!-- Start Navbar Area -->
    @include('frontend.layouts.navbar')
<!-- End Navbar Area -->

<!-- Search Overlay -->
<div class="search-overlay">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>

            <div class="search-overlay-close">
                <span class="search-overlay-close-line"></span>
                <span class="search-overlay-close-line"></span>
            </div>

            <div class="search-overlay-form">
                <form>
                    <input type="text" class="input-search" placeholder="Enter your keywords...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Search Overlay -->



    @yield('content')



<!-- Start Footer Area -->
    @include('frontend.layouts.footer')
<!-- End Footer Area -->


<div class="go-top"><i class="fas fa-chevron-up"></i></div>

<!-- Start QuickView Modal Area -->
<div class="modal fade productsQuickView" id="productsQuickView" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="products-image">
                        <img src="assets/img/products/products-img13.jpg" alt="image">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="products-content">
                        <h3><a href="products-details.html">Ergonomic Desk Sofa</a></h3>
                        <div class="price">
                            <span class="old-price">$99.00</span>
                            <span class="new-price">$69.00</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <div class="products-add-to-cart">
                            <div class="quantities">
                                <span class="sub-title">Qty:</span>
                                <div class="input-counter">
                                    <span class="minus-btn"><i class='fas fa-minus'></i></span>
                                    <input type="text" value="1">
                                    <span class="plus-btn"><i class='fas fa-plus'></i></span>
                                </div>
                            </div>
                            <button type="submit" class="default-btn shop-color">Add to Cart <i class="fas fa-chevron-right"></i></button>
                        </div>
                        <ul class="social-share">
                            <li><span>Share:</span></li>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End QuickView Modal Area -->

<!-- Links of JS files -->
@include('frontend.layouts.script')

</body>
</html>
