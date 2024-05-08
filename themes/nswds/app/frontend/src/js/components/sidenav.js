/**
 * Handle side-nav active selection
 */
export default function initSideNav() {

  try {
    // handle side nav selector
    let currentSideNavItem = document.querySelector('.nsw-side-nav li a.current');
    if(currentSideNavItem) {
      // traverse up tree to top level li
      const parentListItemFinder = function(startElement) {
        let parentElement = startElement.parentNode;
        if(!parentElement || parentElement.tagName == 'NAV') {
          // stop
          return null;
        } else if(parentElement.tagName == 'LI') {
          parentElement.classList.add('active');
        }
        return parentListItemFinder(parentElement);
      };
      parentListItemFinder(currentSideNavItem);
    }
  } catch (e) {
    console.warn('initSideNav', e);
  }

}
