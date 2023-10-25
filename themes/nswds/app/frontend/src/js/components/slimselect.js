import SlimSelect from 'slim-select';

export default function initSlimSelect() {
    /**
     * Apply slim-select to any multiple select inputs
     */
    document.querySelectorAll('div:not(.nsw-multi-select) > select[multiple]').forEach( (listbox) => {
      try {
        let placeholderText = listbox.getAttribute('placeholder');
        let searchText = listbox.dataset.searchText;
        let searchPlaceholder = listbox.dataset.searchPlaceholder;
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
        let slim = new SlimSelect({
            select: listbox,
            settings: settings
        });
      } catch (e) {
        console.error(e);
      }
    });
}
