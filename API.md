# Oxpeckers backend API

## Print

**Get print url**

`oxpeckers_get_print_url($post_id)` 

Example:
```
<a href="<?php echo oxpeckers_get_print_url(); ?>">Print this post</a>

```

[Output example](http://oxpeckers.org/2013/09/2-rhinos-poached-on-provincial-reserve-in-north-west-provincial-reserve/?print=1)

## Contribution system

The form to submit a story is automatically opened on clicking elements with `.submit-story` class.

Example:

```
<a href="#" class="submit-story">Submit a story</a>
```

All the fields from the published post, except for "title" and "content", are stored as custom field. If you can't see it while editing the contributed post, go to "Screen options" on the top right corner and enable "Custom fields".