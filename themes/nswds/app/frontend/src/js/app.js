// Core components
import initSlimSelect from './components/slimselect';
import initSideNav from './components/sidenav';
import initMicroModal from './components/micromodal';
import initVideoPlayer from './components/videoplayer';

function initAppMain() {
    try {
        // remove no-js
        (function(e){e.className=e.className.replace(/\bno-js\b/,'js')})(document.documentElement);
        // init the site
        window.NSW.initSite();
    } catch (e) {
        console.warn('initSite', e);
    }
    // init components
    initSlimSelect();
    initSideNav();
    initMicroModal();
    initVideoPlayer();
}
initAppMain();

// Project components
import '../../../../../../../../../waratah-branding/frontend/src/app.js';
