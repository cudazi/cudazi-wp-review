# WordPress Review Helper

WordPress plugin to assist in theme checks. Displays notices using admin_notices hook.

## Checks Performed by Plugin

* Checks if front page setting was changed from "Your Latest Posts"
* Checks if WooCommerce support was added, reminds to install plugin and check these areas
* Checks if do_shortcode filter is added to widget text. (Note: Plugins can trigger this)

## Settings Changed by Plugin

* Sets comments per page to 5, breaks comments into pages. (For testing comment navigation)
