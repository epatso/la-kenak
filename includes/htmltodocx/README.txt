Adding HTML to Word Documents using PHPWord and SimpleHTMLDom
==============================================================

Current Version: 0.5.1_alpha

These functions enable you to add HTML into a Word document using PHPWord.

The purpose of this software is to add HTML to Word documents in a form that is familiar to most people who use Word documents. The aim is not to give a faithful representation of web page layout, but rather to have an easy-to-use version, which people can easily edit for themselves.

It supports a core set of HTML elements (see h2d_html_allowed_children() in h2d_htmlconverter.php for a list), if it finds an element it doesn't know about, it simply pulls out the html from that element, strips the tags, and inserts what's left into the document.

Change list
===========

0.5.1_alpha
===========

* Corrected h2d_clean_text() to support UTF-8 correctly. PHPWord itself does require updating to support UTF-8 - with this correction (e.g. removal of utf8_encode functions), html with UTF-8 text can now be used to create Word documents without creating errors.

0.5.0_alpha
===========

Initial release.