MOBI Generator
==============

Run Amazon's KindleGen on a web page — no command line — and convert your files into MOBI format so it's ready to upload to Kindle.

Usage
==

Only tested to work on a local host running on Windows.

kindlegen.exe must be downloaded from Amazon (http://amzn.to/12hBwRV) and placed into the other-people folder.

Remember to check your MOBI file in Amazon's Kindle Previewer.

You get an "image is not valid" message even if your image is valid if the file size is too large for upload settings. To change your upload settings, go to your php.ini and increase "upload_max_filesize" to at least 10M.

Credits
==
Thanks to Derek Tor, Eylem Ozaslan, and Randall Frisk from Coding Dojo for their advice.
