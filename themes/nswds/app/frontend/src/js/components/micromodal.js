import MicroModal from 'micromodal';
export default function initMicroModal() {
  try {
    let defaultOpts = {};
    let modalOpts = {
      awaitCloseAnimation: true,
      awaitOpenAnimation: true
    };
    MicroModal.init(defaultOpts);
    // handle the first onload modal
    let loadUp = document.querySelector('.wrth-mm[data-onload="1"]');
    if(loadUp && loadUp.id) {
      let loadUpSeen = true;// assume true
      let mmStorage = JSON.parse( window.localStorage.getItem('mm') );
      if(mmStorage === null) {
        mmStorage = {};
      }
      if(!mmStorage[ loadUp.id ] || !mmStorage[ loadUp.id ].seen) {
        loadUpSeen = false;
      }
      if(!loadUpSeen) {
        mmStorage[ loadUp.id ] = { seen: true };
        window.localStorage.setItem('mm', JSON.stringify( mmStorage) );
        MicroModal.show( loadUp.id, modalOpts );
        let autocloseAfter = loadUp.dataset.autocloseAfter;
        if(autocloseAfter > 0) {
          window.setTimeout(
            function(a) {
              MicroModal.close( loadUp.id );
            },
            (autocloseAfter * 1000)
          );
        }
      }
    }
  } catch(e) {
    console.warn('initMicroModal', e);
  }
}
