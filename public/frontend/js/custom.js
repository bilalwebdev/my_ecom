/**
  * Template Name: Daily Shop
  * Version: 1.0
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS


  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER
  13. RELATED ITEM SLIDER (SLICK SLIDER)


**/



jQuery(function ($) {
    /* ----------------------------------------------------------- */
    /*  1. CARTBOX
  /* ----------------------------------------------------------- */

    jQuery(".aa-cartbox").hover(
        function () {
            jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
        },
        function () {
            jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
        }
    );

    /* ----------------------------------------------------------- */
    /*  2. TOOLTIP
  /* ----------------------------------------------------------- */
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

    /* ----------------------------------------------------------- */
    /*  3. PRODUCT VIEW SLIDER
  /* ----------------------------------------------------------- */

    jQuery("#demo-1 .simpleLens-thumbnails-container img").simpleGallery({
        loading_image: "demo/images/loading.gif",
    });

    jQuery("#demo-1 .simpleLens-big-image").simpleLens({
        loading_image: "demo/images/loading.gif",
    });

    /* ----------------------------------------------------------- */
    /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-popular-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });

    /* ----------------------------------------------------------- */
    /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-featured-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });

    /* ----------------------------------------------------------- */
    /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */
    jQuery(".aa-latest-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });

    /* ----------------------------------------------------------- */
    /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-testimonial-slider").slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
    });

    /* ----------------------------------------------------------- */
    /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-client-brand-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });

    /* ----------------------------------------------------------- */
    /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(function () {
        if ($("body").is(".productPage")) {
            var skipSlider = document.getElementById("skipstep");
            var minPrice = jQuery('#min_price').val();
            var maxPrice = jQuery('#max_price').val();
            if (minPrice == 0 || maxPrice == 0) {
                var minPrice = 200.00;
                var maxPrice = 800.00;
            }
            noUiSlider.create(skipSlider, {
                range: {
                    min: 0,
                    "10%": 100,
                    "20%": 200,
                    "30%": 300,
                    "40%": 400,
                    "50%": 500,
                    "60%": 600,
                    "70%": 700,
                    "80%": 800,
                    "90%": 900,
                    max: 1000,
                },
                snap: true,
                connect: true,
                start: [minPrice, maxPrice],
            });
            // for value print
            var skipValues = [
                document.getElementById("skip-value-lower"),
                document.getElementById("skip-value-upper"),
            ];

            skipSlider.noUiSlider.on("update", function (values, handle) {
                skipValues[handle].innerHTML = values[handle];
            });
        }
    });

    /* ----------------------------------------------------------- */
    /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

    //Check to see if the window is top if not then display button

    jQuery(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".scrollToTop").fadeIn();
        } else {
            $(".scrollToTop").fadeOut();
        }
    });

    //Click event to scroll to top

    jQuery(".scrollToTop").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 800);
        return false;
    });

    /* ----------------------------------------------------------- */
    /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function () {
        // makes sure the whole site is loaded
        jQuery("#wpf-loader-two").delay(200).fadeOut("slow"); // will fade out
    });

    /* ----------------------------------------------------------- */
    /*  12. GRID AND LIST LAYOUT CHANGER
  /* ----------------------------------------------------------- */

    jQuery("#list-catg").click(function (e) {
        e.preventDefault(e);
        jQuery(".aa-product-catg").addClass("list");
    });
    jQuery("#grid-catg").click(function (e) {
        e.preventDefault(e);
        jQuery(".aa-product-catg").removeClass("list");
    });

    /* ----------------------------------------------------------- */
    /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-related-item-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });
});

function change_product_image(img, color) {
    jQuery("#color_id").val(color);
    jQuery(".simpleLens-big-image-container").html(
        '<a data-lens-image="' +
        img +
        '"class="simpleLens-lens-image"><img class="simpleLens-big-image" src="' +
        img +
        '"></a>'
    );
}
function showColor(size) {
    jQuery("#size_id").val(size);
    jQuery(".product_color").hide();
    jQuery(".size_" + size).show();
    jQuery(".size_link").css("border", "1px solid #ddd");
    jQuery("#size_" + size).css("border", "1px solid");
}

function home_add_to_cart(id, size_str_id, color_str_id) {
    jQuery("#color_id").val(color_str_id);
    jQuery("#size_id").val(size_str_id);
    add_to_cart(id, size_str_id, color_str_id);
}
function add_to_cart(id, size_str_id, color_str_id) {
    const color = jQuery("#color_id").val();
    const size = jQuery("#size_id").val();
    var qty = jQuery("#qty").val();
    const home_qty = jQuery("#pqty").val(qty);

    if (size_str_id == 0 && color_str_id == 0) {
        color = "no";
        size = "no";
    }
    if (color == null && color != "no") {
        swal("Ooops", "Please Select Color!", "error");
    } else if (!size && size != "no") {
        swal("Ooops", "Please Select Size!", "error");
    } else {
        jQuery("#product_id").val(id);
        jQuery.ajax({
            url: "/add-to-cart",
            data: jQuery("#frmAddToCart").serialize(),
          //  dataType: "json",
            type: "post",
            success: function (result) {
            //    var result = parseJSON(res);
            //     console.log(result);
               var cart_total = 0;
                if(result.msg=="not")
                 {

                    alert(result.data);
                 }
                 else
                 {

                    alert("Product " + result.msg);
                    // swal(
                    //     "Good Job",
                    //     "Product " + result.msg + " Successfully :)",
                    //     "success"
                    // );
                    if (result.t_items !== 0) {
                        jQuery(".aa-cart-notify").html(result.t_items);
                        var html = '<ul>';
                        jQuery.each(result.data, function (arrKey, arrVal) {
                            cart_total = parseInt(cart_total) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
                            // console.log(cart_total);

                            html += '<li id="popup' + arrVal.attr_id + '"><a class="aa-cartbox-img" href="#"><img src="' + image_path + '/' +
                                arrVal.image +
                                '"alt="img"></a><div class="aa-cartbox-info"> <h4><a href="#"></a>' +
                                arrVal.name +
                                "</h4>  <p>" +
                                arrVal.qty +
                                " x Rs " +
                                arrVal.price +
                                '</p></div></li> ';
                        });
                    }
                    else {
                        jQuery(".aa-cart-notify").html("0");
                        jQuery(".aa-cartbox-summary").remove();
                        //  jQuery('.aa-cart-notify').html(result.t_items);
                    }
                    //    console.log(cart_total);
                    html += '<li> <span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">' + cart_total + '</span></li>';
                    html += '</ul><a class="aa-cartbox-checkout aa-primary-btn" href="cart">Go to Cart</a>';
                    jQuery(".aa-cartbox-summary").html(html);
                    //console.log(data, "here");
                 }
            },
        });
    }
}
function deleteCartProduct(pid, size, color, attr_id) {
    jQuery("#color_id").val(color);
    jQuery("#size_id").val(size);
    jQuery("#qty").val(0);
    jQuery("#cart_box" + attr_id).remove();
    add_to_cart(pid, size, color);
}
function deletePopUpCartProduct(pid, size, color, attr_id) {
    jQuery("#color_id").val(color);
    jQuery("#size_id").val(size);
    jQuery("#qty").val(0);
    jQuery("#popup" + attr_id).remove();
    add_to_cart(pid, size, color);
}
function updateQty(pid, size, color, attr_id, price) {
    jQuery("#color_id").val(color);
    jQuery("#size_id").val(size);
    var cart_qty = jQuery("#qty" + attr_id).val();
    jQuery("#qty").val(cart_qty);
    var qty = jQuery("#qty").val();
    var a = parseInt(qty) * parseInt(price);
    jQuery("#total_price_" + attr_id).html("Rs " + a);
    add_to_cart(pid, size, color);
}

function sort() {
    var sort = jQuery('#sort_by').val();
    jQuery('#sort').val(sort);
    jQuery('#categoryFilter').submit();
}

function price_filter() {
    jQuery('#min_price').val(jQuery('#skip-value-lower').html());
    jQuery('#max_price').val(jQuery('#skip-value-upper').html());
    jQuery('#priceFilter').submit();
}

function color_filter(pro_color_id, type) {
    // alert(color);-
    var color_str = jQuery('#pro_color_id').val();
    if (type == 1) {
        var new_color_str = color_str.replace(pro_color_id + ':', '');
        // alert(new_color_str);
        jQuery('#pro_color_id').val(new_color_str);
    }
    else {
        jQuery('#pro_color_id').val(pro_color_id + ':' + color_str);
        jQuery('#colorFilter').submit();
    }
    jQuery('#colorFilter').submit();
}
function funSearch() {

    var search_str = jQuery('#search_bar').val();

    if (search_str != '' && search_str.length > 3) {
        window.location.href = '/search/' + search_str;

    }
}

jQuery('#frmLogin').submit(function (e) {
    e.preventDefault();
    jQuery.ajax({
        url: '/login',
        data: jQuery('#frmLogin').serialize(),
        type: 'post',
        success: function (result) {
            if (result.status == "error") {
                jQuery('#login_msg').html(result.msg);
            }
            else {
                window.location.href = window.location.href;
            }
        }
    })
})

function forgot_password() {
    jQuery('#popup_login').hide();
    jQuery('#popup_forgot').show();
}
function login_modal() {
    jQuery('#popup_login').show();
    jQuery('#popup_forgot').hide();
}
function applyCouponCode() {
    jQuery('#coupon_code_msg_err').html('');
    jQuery('#coupon_code_msg_success').html('');
    coupon_code = jQuery('#coupon_code').val();
    if (coupon_code) {
        jQuery.ajax({
            url: '/apply-coupon-code',
            data: 'coupon_code=' + coupon_code + '&_token=' + jQuery("[name='_token']").val(),
            type: 'post',
            success: function (result) {
                if (result.status == "error") {
                    jQuery('#coupon_code_msg_err').html(result.msg);
                }
                else {
                    jQuery('.show_coupon_box').removeClass('hide');
                    jQuery('#coupon_code_name').html(coupon_code);
                    jQuery('#total_price').html('RS ' + result.total_price);
                    jQuery('#coupon_code_msg_success').html(result.msg);
                    jQuery('.apply_coupon').hide();
                }
            }
        })
    }
    else {
        jQuery('#coupon_code_msg').html('Please enter a coupon code!');
    }
}
function removeCouponCode() {
    coupon_code = jQuery('#coupon_code').val();
    jQuery('#coupon_code').val('');
    if (coupon_code) {
        jQuery.ajax({
            url: '/remove-coupon-code',
            data: 'coupon_code=' + coupon_code + '&_token=' + jQuery("[name='_token']").val(),
            type: 'post',
            success: function (result) {
                if (result.status == "error") {
                    jQuery('#coupon_code_msg_err').html(result.msg);
                }
                else {
                    jQuery('.show_coupon_box').addClass('hide');
                    jQuery('#coupon_code_name').html('');
                    jQuery('#total_price').html('RS ' + result.total_price);
                    jQuery('#coupon_code_msg_success').html(result.msg);
                    jQuery('.apply_coupon').show();
                }
            }
        })
    }
    else {
        //jQuery('#coupon_code_msg').html('Please enter a coupon code!');
    }
}
jQuery('#frmForgot').submit(function (e) {
    e.preventDefault();
    jQuery.ajax({
        url: '/forgot',
        data: jQuery('#frmForgot').serialize(),
        type: 'post',
        success: function (result) {
            if (result.status == "error") {
                jQuery('#forgot_msg').html(result.msg);
            }
            else {
                window.location.href = '/';
            }
        }
    });
});

jQuery('#frmPlaceOrder').submit(function (e) {
    jQuery('#order_paced_msg').html('Please wait...');
    e.preventDefault();
    jQuery.ajax({
        url: '/place-order',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: jQuery('#frmPlaceOrder').serialize(),
        type: 'post',
        success: function (result) {
            if (result.status == "success") {
                window.location.href = '/order-placed';
            }
            else {
                jQuery('#order_placed_msg').html(result.msg);
            }

        }
    });
});

jQuery('#frmProductReview').submit(
    function (e) {
        e.preventDefault();
        jQuery.ajax({
            url: '/product-review',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: jQuery('#frmProductReview').serialize(),
            type: 'post',
            success: function (result) {
              if(result.status == "error")
              {
                  jQuery('.review-msg').html(result.msg);
              }
              else{
               // jQuery('#frmProductReview').reset();
                jQuery('.review-msg').html(result.msg);
                setInterval(function() {
                    window.location.href = window.location.href;
                }, 3000);
              }
            }
        });
    }

)
function listAlign()
{
    jQuery('#pro_desc').removeClass('hide_desc');
}
