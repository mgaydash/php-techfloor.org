<?php
    $pageTitle = "Check Sheet";
    include("../php/headerInc.php");
?>

<div class="pageTitle">
    Check Sheet
</div>

<table border="1" bordercolor="black" cellpadding="3" cellspacing="0" rules="all" hframe="void" class="tableGeneral">
    <tr> 
        <th>CIS 370 Assignment 3 Specific Requirement</td>s
        <th>How to test this feature.</th>
        <th>Works Completely<br />
        (Yes/No)</th>
    </tr>
    <tr> 
        <td>1. Create a database using phpMyAdmin.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1"><p> a. Include at least 6 columns (or fields) with a 
            variety of data types including at least one of each of the following: 
            character string, date, integer, decimal, and Yes/No values.<br>
        </p></td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1"><p>b. Add at least 15 rows of data into that table.</p></td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td>2. All source files organized into proper MVC folders.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td>3. Create a simple PHP page that will display a list of the most important 
        columns for all rows in your table.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1">a. Use an HTML table to show your column headings and 
        data values.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1">b. Add formatting where appropriate for dates, phone 
        numbers, SSNs, Y/N values, etc...</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td>4. Make a page that allows the user to Search for subsets of your records.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1">a. Search using a Selection box with values pre-loaded 
        in a logical order (like a dropdown of names).</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1">b. A general search that searches all character fields 
        for any subset of characters.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1">c. Links to show natural subsets of the data (like &quot;Clearance 
        Items&quot; or &quot;New Listings&quot;).</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
        <td class="indent1">d. Never show a list of only one item - automatically 
        proceed to the details view if only one item is found.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td>5. Make a page that shows a Details view of a single row of your data.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1">a. Listing screen should automatically link to this 
        screen passing primary key as a querystring parameter.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td>6. Use PHP Data Objects instead of the mysql or mysqli interfaces to 
        access your data.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1">a. Use prepared statements to execute your parameterized 
        queries to avoid SQL injection.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td>7. This sheet linked in to your site under the Help menu and filled 
        out properly so I can grade it.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td>8. Complete site published to cisprod public_html folder (including 
        redirection to this assignment).</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td class="indent1">a. All source code also in course folder in Assignment
            3 directory.</td>
        <td>&nbsp;</td>
        <td><span style="color:green; margin-left:40px;">YES</span></td>
    </tr>
    <tr> 
        <td></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
        <td colspan="3" bgcolor="#CCCCCC"> <div align="center"><strong><font size="+1">Extra 
            Credit</font></strong></div></td>
    </tr>
    <tr> 
        <td></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
        <td>9. Include a mechanism to choose a sort order for the list entries whenever 
        you search your records.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
        <td class="indent1">a. The sort order should default to a natural (or common) 
        value.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
        <td class="indent1">b. The sort order should affect the results regardless 
        of which mechanism they used to create the list.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
        <td class="indent1">c. Avoid SQL Injection attacks in implementing your 
        sort order selection.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
        <td>10. Allow the user to click any of the column headers to sort the data 
        shown and redisplay it</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
        <td class="indent1">a. Avoid SQL Injection attacks in implementing your 
        sort order selection.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>

<?php
    include("../php/footerInc.php");
?>