# La-kenak V.5.0
Energy calculations in Greece (K.EN.A.K. legislation)

14/1/2018 - Right now the code is being uploaded in pieces. Keep up for the few more days. 
20/1/2018 - Crusial update of chapter study (pdf). Fewer errors and warnings. Rewrite some calculations

Introduction
============

**La-kenak** -- is an open-source php,js,mysql software helping engineers build a construction only by the dimensions of its external elements (walls, windows, floors, roofs) 
to help in many ways:

- xml file that is used in energy calculations through the software TEE-KENAK (based on EPA-NR) in Greece.
- 3d dxf file to represent the structure in 3d space in cad software.
- jpg floorplan with area measurement and obstacles table to be used in the energy certificate process. 
- WebGL 3d floorplan in the browser for the engineer to analyze the structure (especially for passive building analysis). 
- Html and PDF export of the energy study to be used in text processors as a template for the actual study for civil offices. 
- Calculations during the energy studies that without the software depend on many data and take a lot of time. 
- Viewing 600-700 pages of data from the Greek legislation that otherwise require a lot of reading and effort. 

!["La-kenak v.5.0"](http://www.chem-lab.gr/lakenak/images/lakenak5.png "La-kenak v.5.0")

### Used libraries
- **[AdminLTE.IO](https://adminlte.io)** Higly responsive template based on Bootstrap 3 without any changes in the core of the template.
- The original components (bower_components) used in AdminLTE.IO template with no changes (just the libraries).
- **[Bootstrap 3](https://github.com/twbs/bootstrap)** as the base template framework with some changes in colors. 
- Bootstrap 3 enhancements like bootstrap-editable, bootstrap-slider, bootstrap-wysihtml5 and some more for making life easier with the interface. 
- **[Medoo PDO Library](https://github.com/catfan/Medoo)** for quering to the mysql database. 
- **[Jquery](https://github.com/jquery/jquery)** and **[Jquery UI](https://github.com/jquery/jquery-ui)** for easing out some javascript. 
- **[ckeditor](https://github.com/ckeditor/ckeditor-dev)** as the main text-editor. 
- **[phpword](https://github.com/PHPOffice/PHPWord)** and **[phpexcel](https://github.com/PHPOffice/PHPExcel)** to export to editable formats. 
- **[tcpdf](https://github.com/PHPOffice/PHPWord)** and **[fpdi](https://github.com/Setasign/FPDI)** to export to non-editable formats (but more stylish). 
- **[PDFMerger](https://github.com/myokyawhtun/PDFMerger)** created by Jarrod Nettles for reducing the payload to the server in producing PDFs. 
- **[html to docx](http://sourceforge.net/projects/simplehtmldom/)** for fast phpword export.
- **[pchart 2.0](http://www.pchart.net)** for some small climate charts.
- **[filemanager](https://github.com/simogeo/Filemanager)** to give control over files to the user.
- **[three.js](https://github.com/mrdoob/three.js)** with **[csg.js](https://github.com/jscad/csg.js)** and [ThreeCSG.js](https://github.com/chandlerprall/ThreeCSG)** to show the building model in 3d.
- **[dxfclass](https://www.phpclasses.org/package/7954-PHP-Generate-CAD-files-in-the-AutoCAD-DXF-format.html)** to produce the 3d dxf.
- **[phpmathpublisher](https://github.com/Tux-oid/phpmathpublisher)** to produce some equation images.
- **[jQuery-File-Upload Widget](https://github.com/blueimp/jQuery-File-Upload)** to help in user images.
- **[suncalc js library](https://github.com/mourner/suncalc)** by mourner as the js library for sun position.
- **[suncalc php library](https://github.com/gregseth/suncalc-php)** as the js library for sun position.
- **[iconarchive](http://www.iconarchive.com/)** as an icon library for the user interface.
- **[class upload php](https://www.verot.net/php_class_upload.htm)** for uploading and resizing the user image.
- Various and long list articles and documentation about all the above. 
- Google Login Auth for helping creating an account. 
- Google maps api (this software is free for everyone to use).
- OpenStreetMaps **[OSM](https://www.openstreetmap.org/)** as a free mapping service.
- **[Open Layers](https://openlayers.org/)** with OSM, Ktimatologio base-layers. 

**A working example is available in [www.chem-lab.gr/lakenak](http://www.chem-lab.gr/lakenak)**


## Installation Guide
Visit [WIKI](https://github.com/ks1f14s/la-kenak/wiki) for the most updated guide regarding installing the software.


### Contribution
Contribution are **welcome and recommended**! Here is how:

- Forking the repo and contributing ([here is the guide](https://help.github.com/articles/fork-a-repo/)).
- Using the issues menu here in github ([Issues](https://github.com/ks1f14s/la-kenak/issues)).
- Contacting the creator ([Chem-lab Contact](http://www.chem-lab.gr/nafplio/index.php?option=com_contact&view=contact&id=3&Itemid=292)).
- For non-coding issues (technical stuff) use the forum of Michanikos ([Michanikos post](http://www.michanikos.gr/topic/26135-kenak-freeware/)).


### License
La-kenak is an open source project that is licensed under GPLv3 Lisence (the files and calculations). All the libraries keep their lisencing. 

### Ready to use release - Dependancies on install
Keep in mind that this is written in a server side language (php) with a mysql database behind so this has to be inside a websserver environment with PHP. 
Also Apache is a good option and phpmydmin makes life easier for mysql entries. So under windows install it using xampp or mampp or any other web server. 

A ready to use version (out of the box for ex. in a usb stick) will be provided soon.  
For a web-server implementation several changes have to be made mainly in the text production and saving to mysql 
(right now LARGETEXT is used to store the text chapters in the database which incresses the DB dramatically). Some limits have been implemented for this reason. 
You can change those limits by the administration interface for every user or the main user. 

- PHP version >5.4 (as PDO was used in medoo)
- mysql
- javascript enabled browsers (all browsers are supported exept old explorer)
- webgl capable browser for the 3d building menu
- Google maps api for the google maps implementations (used geocoder, elevation data)
- Google auth api (if users will be login in through google accounts)

### Image Credits
- [Iconarchive](http://www.iconarchive.com/)
- [Pixeden](http://www.pixeden.com/psd-web-elements/flat-responsive-showcase-psd)
- [Graphicsfuel](http://www.graphicsfuel.com/2013/02/13-high-resolution-blur-backgrounds/)
- [Pickaface](http://pickaface.net/)
- [Unsplash](https://unsplash.com/)
- [Uifaces](http://uifaces.com/)

### Donations
Donations are **greatly appreciated!** and welcome by contacting the author. Remember: This is a 6 year old project taking a lot of time and effort. 