function require(jspath) {
    document.write('<script type="text/javascript" src="'+jspath+'"><\/script>');
}

var base_url = $(".base_url").val();
require(base_url+"static/gl_build/jquery_validation/jquery.validate.min.js");
require(base_url+"static/gl_build/cart/shopping_cart.js");
require(base_url+"static/gl_build/cart/checkout.js");
require(base_url+"static/gl_build/infinite_scroll/infinite_scroll.js");
require(base_url+"static/gl_build/infinite_scroll/pagescrolling.js");
require(base_url+"static/gl_build/ajax_request_loader/ajaxloader.js");
require(base_url+"static/gl_build/common/js/gl_build-other.js");



