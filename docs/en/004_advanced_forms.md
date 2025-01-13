# Advanced forms

## CompositeField grid options

CompositeFields support a variety of simple grid options, allowing layout control over their child fields.

> At small screen sizes, all child fields stack and the grid option value is ignored.

### Options

> Use the `setGridOption` method to set a grid option on a composite field.
> Each option is a value selectable in CSS via the [data-grid-option] selector

+ `equal-width-fields`: child fields will be equal spaced across the row. This works well with 2 to 4 child fields
+ `2-across`: child fields appear in a 2xN grid, each field is 1/2 width of the container
+ `3-across`: child fields appear in a 3xN grid, each field is 1/3 width of the container

Any `HTMLReadonlyField` in a composite field is considered a break and will be given a `flex-basis` of 100%.
