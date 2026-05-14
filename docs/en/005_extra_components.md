# Extra components

We ship extra components not covered by or not yet included in the NSW Design System (NSWDS).

Extra components are based on standard HTML elements sometimes supported by plain Javascript to add an enhancement. If we can get away with no Javascript, then that's a win. We don't use any Javascript frameworks but some older components require jQuery, which is slowly being phased out.

Some third-party Silverstripe modules with frontend components require jQuery. If this is the case, we block the module's jQuery using the Silverstripe Requirements API and load the latest jQuery version available.

Some of the extra components are not represented in the CMS as a content block and instead require a developer to create the component based on project requirements.

## Including a component

Using a component is easy, we follow the convention of using an include within a custom template and passing prefixed variables containing the values for the template.

Here is an example including a NSWDS List Item from their "List items" component. In this example, $List in the template is a DataList, each item in the DataList has entries for $AppCategoy, $Title, $Abstract, $LastEdited, $Link.

```html
<% loop $List %>
    <% include nswds/ListItem ListItem_PrimaryLabel=$AppCategory.UpperCase, ListItem_IsReversed=0, ListItem_Date=$LastEdited, ListItem_DateTime='', ListItem_LinkURL=$Link, ListItem_Title=$Title, ListItem_Abstract=$Abstract, ListItem_Tags=''  %>
<% end_loop %>
```

## Third-party components

### Slim Select

[Slim Select](https://slimselectjs.com/) is used as the default tool for managing [ListboxField](https://api.silverstripe.org/5/SilverStripe/Forms/ListboxField.html) fields (aka `<select multiple>`). We chose Slim Select as it has no dependences and is very small.

Any `<select>` element that is not a child of a `.nsw-multi-select` element will automatically be decorated with SlimSelect.

You can modify the Slim Select handling of a select element to an extent via its data-* attributes (use `$field->setAttribute()`). We have tried to maintain consistency with Slim Select settings:

+ data-search-text - sets SlimSelect settings.searchText
+ data-search-placeholder - sets SlimSelect settings.searchPlaceholder
+ data-min-selected - sets SlimSelect settings.minSelected
+ data-max-selected - sets SlimSelect settings.maxSelected
+ data-matching - sets the searchFilter event function to use. The only current option is 'start', which matches options from the start of the text. If this is not set, the default Slim Select matching filter is used.
+ data-addable - adds an 'addable' event to the SlimSelect settings, supporting creation of new options in the element. New option values are prefixed "new=". You must handle removal of this prefix and sanitise the remaining input when saving user-supplied values.

You can access the SlimSelect object on each `<select>` element via `element.slim`. See SlimSelect documentation for assistance.

### MicroModal

MicroModal, a tiny modal library, handles modals. We also support the NSW Design System `dialog` component, although MicroModal has better event handling.

To use MicroModal, just include the Modal.ss template with options: `<% include NSWDPC/Waratah/Modal Modal_ModalID='my-modal', Modal_Title='A title' %>`. See the Modal.ss template for available variables.

### Our components

## Video player

We ship our own video player loader that supports Vimeo and YouTube videos. An example implementation is in the video gallery element/module, where videos are presented as image thumbnails and clicking/tapping them will load a NSWDS dialog box with the video to play.

The video player component handles pausing and playing of videos when dialogs are closed/opened.

## Additional components

All additional components are prefixed in CSS with the `wrth-` prefix, to separate them from the the `nsw-*` prefix used by the NSWDS.
To review component CSS, look in the themes/nswds/app/frontend/src/scss/waratah directory. In some cases the relevant `wrth-` prefix modifies the core NSWDS component to add extra features. A good example is a NSWDS 'nsw-card' with an added 'wrth-card' class.

All of these components have been implemented over time based on use-cases, feedback and requirements in projects.

+ Card: an extension to nsw-card, the wrth-card provides some more interesting visuals such as a zoomable image
+ Date: improves the NSWDS date input component
+ Details: adds a details disclosure element with NSWDS styling
+ DL: adds a responsive definition list (`<dl>`) element with NSWDS styling
+ Feature: adds a component that can be used to decorate a content element holding an image and some content
+ Filters: updated filter styling for NSWDS filters
+ Form: improved form integration between Silverstripe forms and NSWDS form field components
+ Image: improves images with some extra styles
+ List: provide a list component with icons and images
+ Mapping: maps component styling
+ Scale: adds some scaling options for components
+ Search: provides some search extras
+ Slider: implements a basic content slider. See also the NSWDS Carousel component
+ Social Links: links to social networks, see also the NSWDS Utility List component
+ Uploader: support for upload fields
+ Video: video component improvements

The best way to see these in action is to run up a project using this module, dive into the code, add some content blocks to pages, and review the templates provided.

If you would like to contribute feedback, please open an issue or pull request on Github.
