Auto Header Images
==================

This is a plugin for WordPress_. Let you change header images by just
changing the images under ``THEMEDIR/images/headers``.

Without additional settings, make theme to take the header images under
``THEMEDIR/images/headers`` as the default header images.

The file whose postfix is ``-thumbnail`` will be treat as the thumbnail. And
the file whose name starts with ``.`` will be ignore.

**Notice:** It will clear the settings of default header images by theme.

.. _WordPress : http://wordpress.org/

Installation
------------

Just copy the php file to the ``WORDPRESS/wp-content/plugins``. And activate
it on your WordPress console.

Example
-------

If your ``THEMEDIR/images/headers`` contains the files below:

    ./
    ../
    .hidden.jpg
    .hidden-thumbnail.jpg
    pine-cone.jpg
    pine-cone-thumbnail.jpg

It gererates the below array for ``register_default_header``:

    Array
    (
        [Pine Cone] => Array
            (
                [url] => %s/images/headers/pine-cone.jpg
                [description] => Pine Cone
            )
    )

That's all. Have fun!
