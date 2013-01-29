<?php
    $pageTitle = "Check Sheet";
    include("../php/headerInc.php");
?>

<div class="pageTitle">
    Check Sheet
</div>

<!--     <span style="color:green; margin-left:50px;">YES</span>      --> 

<table width="100%" border="1">
    <tr><th>Specific Requirement</td><th>Works Completely<br />(Yes/No)</th></tr>
    <tr><td>1.	Header, Footer, and Nav included via PHP.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;a.	Footer includes date/time main content portion of page last modified.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;b.	Footer includes mini-nav.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;c.	Footer includes page validation icons.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td>2.	All source files organized into proper MVC folders.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td>3.	Automatic redirection from top of your web space to proper location for this assignment.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td>4.	Email sign-up link in main navigation.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;a.	Validate e-mail before saving.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;b.	New addresses successfully added.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;c.	Success page responds when appropriate.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td>5.	File Management link in Admin menu.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;a.	Newsletter-Type File Upload Mechanism</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i.	HTML self-contained file with fonts and colors.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii.	File can be seen via link on home page.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iii.	Upload gives error if not an HTML file.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;b.	Quote File Upload Mechanism</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i.	Text file with one line per quote.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii.	Upload gives error if not a text file.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iii.	Link on File Management page to see the current Quote File.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;c.	Image File Uploads</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i.	Allow additional image files to upload.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii.	Only allow jpeg, gif, and png formats.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iii.	On successful upload list all files.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iv.	New images may appear in header.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td>6.	Sending of Bulk E-Mails</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;a.	Newsletter-Type file is body of the message.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;b.	E-Mail is sent to all recipients that have signed up.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;c.	No recipient should be able to see the email address of others.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;d.	Confirmation page shows all addresses who received a message.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;e.	E-Mail is properly addressed so it does not go to SPAM folders.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td>7.	This sheet linked in to your site under the Help menu.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td>8.	All pages pass the validation checks for the specified version of HTML and CSS</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;a.	CSS image in footer that calls validator.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;b.	XHTML image in footer unless HTML5 was used.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td>9.	Complete site published to cisprod public_html folder (including redirection).</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;a.	All source code also in course folder in Assignment 2 directory.</td><td><span style="color:green; margin-left:50px;">YES</span></td></tr>
    <tr><td></td><td>&nbsp;</td></tr>
    <tr><th colspan="2">Extra Credit</th></tr>
    <tr><td></td><td>&nbsp;</td></tr>
    <tr><td>10.	Provide a mechanism to delete unwanted image files.</td><td>&nbsp;</td></tr>
    <tr><td>11.	Show a random quote from current Quote file in the footer on each page load.</td><td>&nbsp;</td></tr>
    <tr><td>12.	Include a "Remember Me" checkbox on e-mail signup page.</td><td>&nbsp;</td></tr>
    <tr><td class="indent1">&nbsp;&nbsp;&nbsp;a.	Include a "Welcome First Name" in header if they wanted to be remembered on that machine.</td><td>&nbsp;</td></tr>
</table>

<?php
    include("../php/footerInc.php");
?>