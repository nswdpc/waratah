import SlimSelect from 'slim-select';

export function applySlimSelect(listbox) {
  try {
    let placeholderText = listbox.getAttribute('placeholder');
    let searchText = listbox.dataset.hasOwnProperty('searchText') ? listbox.dataset.searchText : '';
    let searchPlaceholder = listbox.dataset.hasOwnProperty('searchPlaceholder') ? listbox.dataset.searchPlaceholder : '';
    let minSelected = listbox.dataset.hasOwnProperty('minSelected') ? listbox.dataset.minSelected : null;
    let maxSelected = listbox.dataset.hasOwnProperty('maxSelected') ? listbox.dataset.maxSelected : null;
    let matching = listbox.dataset.hasOwnProperty('matching') ? listbox.dataset.matching : 'default';
    let settings = {
      searchHighlight: true,
      allowDeselect: true,
      closeOnSelect: false
    };
    if(placeholderText) {
      settings.placeholderText = placeholderText;
    }
    if(searchText) {
      settings.searchText = searchText;
    }
    if(searchPlaceholder) {
      settings.searchPlaceholder = searchPlaceholder;
    }
    if(minSelected >= 0) {
      settings.minSelected = minSelected;
    }
    if(maxSelected >= 0) {
      settings.maxSelected = maxSelected;
    }
    let events = {};
    if(matching == 'start') {
      events.searchFilter = function(option, search) {
        return option.text.toLowerCase().substr(0, search.length) === search.toLowerCase();
      };
    }
    let slim = new SlimSelect({
        select: listbox,
        settings: settings,
        events: events
    });
  } catch (e) {
    console.error(e);
  }
};

export default function initSlimSelect() {
    /**
     * Apply slim-select to any multiple select inputs
     */
    document.querySelectorAll('div:not(.nsw-multi-select) > select[multiple]').forEach( (listbox) => {
      applySlimSelect(listbox);
    });
}
