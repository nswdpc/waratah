import SlimSelect from 'slim-select';

export default function initSlimSelect() {
    /**
     * Apply slim-select to any multiple select inputs
     */
    document.querySelectorAll('div:not(.nsw-multi-select) > select[multiple]').forEach( (listbox) => {
      try {
        let placeholder = listbox.getAttribute('placeholder');
        let searchText = listbox.dataset.searchText;
        new SlimSelect({
            select: listbox,
            settings: {
              placeholder: placeholder ? placeholder : 'Select one or more items',
              searchText: searchText ? searchText : 'Sorry couldn\'t find anything..',
              searchHighlight: true,
              allowDeselect: true,
              closeOnSelect: false
            }
        });
      } catch (e) {
        console.error(e);
      }
    });
}
