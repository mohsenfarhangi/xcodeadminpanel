//
// Global init of core components
//

// Init components
import * as kt_app from "./app.js";
import * as kt_util from "./util";
import * as KT_Drawer from "./drawer"
import * as KT_menu from "./menu"
import * as KT_scroll from "./scroll"
import * as sticky from "./sticky"
import * as swapper from "./swapper"
import * as toggle from "./toggle"
import * as scrolltop from "./scrolltop"
import * as dialer from "./dialer"
import * as image_input from "./image-input"
import * as password_meter from "./password-meter"

window.KTApp = kt_app.KTApp;
window.KTUtil = kt_util.KTUtil;
window.KTDrawer = KT_Drawer.default;
window.KTMenu = KT_menu.default;
window.KTScroll = KT_scroll.default;
window.KTSticky = sticky.default;
window.KTSwapper = swapper.default;
window.KTToggle = toggle.default;
window.KTScrolltop = scrolltop.default;
window.KTDialer = dialer.default;
window.KTImageInput = image_input.default;
window.KTPasswordMeter = password_meter.default;

const KTComponents = function () {
    // Public methods
    return {
        init: function () {
            KTApp.init();
			KTDrawer.init();
			KTMenu.init();
			KTScroll.init();
			KTSticky.init();
			KTSwapper.init();
			KTToggle.init();
			KTScrolltop.init();
			KTDialer.init();
			KTImageInput.init();
			KTPasswordMeter.init();
        }
    }
}();

// On document ready
if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", function() {
		KTComponents.init();
	});
 } else {
	KTComponents.init();
 }

 // Init page loader
window.addEventListener("load", function() {
    KTApp.hidePageLoading();
});

export default {
    'KTComponents' : KTComponents
}
// Declare KTApp for Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
	window.KTComponents = module.exports = KTComponents;
}
