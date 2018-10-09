CKEditor Qualtrics Button -  is an extension to the Drupal 8 CKEditormodule.


REQUIREMENTS

- ckeditor


FEATURES

- Ability to insert a Qualtrics form into WYSIWYG fields.


INSTALLATION

1- Copy the utexas_qualtrics_filter folder to your modules directory.
2- Go to admin/modules and enable the module.
3- Go to admin/config/content/formats and configure the desired profile.
4- Move a button into the Active toolbar.
5- Check the 'Qualtrics Filter' checkbox in the Enabled filters section and Save.
6- If you have other Filters enabled, make sure that 'Qualtrics filter' is below
  'Limit allowed HTML tags and correct Faulty HTML' and above 'Convert URLS into Links'
  if any of those are present.
7- Clear your browser's cache, and a new button will appear in your toolbar.

USAGE

Qualtrics forms can be added easily to any rich-text (WYSIWYG) area on your site. Typically, you'll add forms to the WYSIWYG A or WYSIWYG B fields on Standard Pages and Landing Pages, but they can be added to Blocks or Basic Pages, as well.

- Method 1, Toolbar: In rich-text areas with the Qualtrics toolbar button, position your cursor at the point in your text where you want the Qualtrics form to appear. Then click on the Qualtrics icon to see a pop-up window where you can set:

0. The URL to enter comes from the path provided by Qualtrics when you "activate" or "preview" the form (see above).
0. The form will expand to fill the width of the region the textarea is located in. The height defaults to 500px, but can be adjusted in the pop-up.
0. The "title" field is optional, and is not displayed. It is used within the page's HTML to provide more semantic meaning to the form.

Once you click "Ok" the shortcode for the Qualtrics form will show in the Rich Text area. When the actual page is viewed, the form will render.

- Method 2, Source Mode: Qualtrics shortcodes can also be manually added and/or edited by switching from rich-text mode into "Source" mode. The shortcode URL, "height," or "title" attributes can be directly manipulated, as shown below.

Sample shortcode:

`[embed]https://utexas.qualtrics.com/SE/?SID=SV_5mRnpkYhq4Qd2At | height:500 | title: Modified title [/embed]`




