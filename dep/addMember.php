<?php
    $pageTitle = "$mode Member";
    include("../php/headerInc.php");
?>

<div class="pageTitle">
   <?php echo "$mode Member"; ?>
</div>
<div class="textFormat">
	<span>Fields marked with a<span style="color:red;"> * </span>are required.</span>
</div>
<div class="textFormat">
    <div class="memberDetails" style="font-weight:bold;">
        <div>
            First Name:<span style="color:red;"> * </span>
        </div>
        <div>
            Last Name:<span style="color:red;"> * </span>
        </div>
        <div>
            EMail:<span style="color:red;"> * </span>
        </div>
        <div>
            Major:<span style="color:red;"> * </span>
        </div>
        <div>
            Member Type:
        </div>
        <div>
            Nerd Score:<span style="color:red;"> * </span>
        </div>
        <div>
            Game Genre:
        </div>
        <div>
            Member Since:
        </div>
        <div>
            Active Member:
        </div>
    </div>
</div>
<form action="../controller/controller.php?action=processAdd" class="memberDetails" style="margin-top:0px;" method="post" onsubmit="return validateAll()">
	<input type="hidden" name="mode" value="<?php echo $mode ?>" />
	<input type="hidden" name="memberID" value="<?php echo $memberID ?>" />
	<div>
		<input type="text"  name="fName" id="fName" onblur="notBlank('fName')" value="<?php echo htmlspecialchars($fName) ?>" />
	</div>
	<div>
		<input type="text"  name="lName" id="lName" onblur="notBlank('lName')" value="<?php echo htmlspecialchars($lName) ?>" />
	</div>
	<div>
		<input type="text"  name="email" id="email" onblur="validEmail()" value="<?php echo htmlspecialchars($email) ?>" />
	</div>
<!--	<div>
		<input type="text"  name="major" id="major" onblur="notBlank('major')" value="" />
	</div>-->
	<div>
		<select name="major" id="major" style="width:200px;">
			<option value = "<?php echo htmlspecialchars($major) ?>"><?php echo htmlspecialchars($major) ?></option>
			<option value="Anthropology">Anthropology</option>
			<option value="Environmental Geoscience">Environmental Geoscience</option>
			<option value="Geology">Geology</option>
			<option value="Liberal Studies">Liberal Studies</option>
			<option value="Art">Art</option>
			<option value="Biology">Biology</option>
			<option value="Environmental Biology">Environmental Biology</option>
			<option value="Medical Technology">Medical Technology</option>
			<option value="Molecular Biology">Molecular Biology</option>
			<option value="Biology">Biology</option>
			<option value="Chemistry">Chemistry</option>
			<option value="Computer Science">Computer Science</option>
			<option value="Information Systems">Information Systems</option>
			<option value="English">English</option>
			<option value="Liberal Studies">Liberal Studies</option>
			<option value="History">History</option>
			<option value="Arts Sciences">Arts  Sciences</option>
			<option value="Economics A S">Economics A  S</option>
			<option value="Communication">Communication</option>
			<option value="Mass Media Arts, Journalism">Mass Media Arts, Journalism</option>
			<option value="Mathematics">Mathematics</option>
			<option value="French">French</option>
			<option value="">Spanish</option>
			<option value="Criminal Justice">Criminal Justice</option>
			<option value="Philosophy">Philosophy</option>
			<option value="">Political Science</option>
			<option value="Sociology">Sociology</option>
			<option value="Physics">Physics</option>
			<option value="Psychology">Psychology</option>
			<option value="Theatre">Theatre</option>
			<option value="CPA Non-Degree">CPA Non-Degree</option>
			<option value="Industrial Relations">Industrial Relations</option>
			<option value="Management">Management</option>
			<option value="Paralegal Studies">Paralegal Studies</option>
			<option value="Business Administration">Business Administration</option>
			<option value="Business Economics">Business Economics</option>
			<option value="International Business">International Business</option>
			<option value="Finance">Finance</option>
			<option value="Marketing">Marketing</option>
			<option value="Real Estate">Real Estate</option>
			<option value="Administration Technology">Administration Technology</option>
			<option value="Industrial Technology">Industrial Technology</option>
			<option value="Liberal Studies">Liberal Studies</option>
			<option value="Athletic Coaching">Athletic Coaching</option>
			<option value="Speech Pathology Audiology">Speech Pathology Audiology</option>
			<option value="Speech Language Pathology">Speech Language Pathology</option>
			<option value="Early Childhood">Early Childhood</option>
			<option value="Early Childhood Education">Early Childhood Education</option>
			<option value="Library Science">Library Science</option>
			<option value="Middle Level Education">Middle Level Education</option>
			<option value="Environmental Education">Environmental Education</option>
			<option value="Early Childhood Education">Early Childhood Education</option>
			<option value="Education">Education</option>
			<option value="Music Education">Music Education</option>
			<option value="Rehabilitative Services">Rehabilitative Services</option>
			<option value="Special Education">Special Education</option>
			<option value="Respiratory Care">Respiratory Care</option>
			<option value="Medical Imaging Sciences">Medical Imaging Sciences</option>
			<option value="Nursing">Nursing</option>
		</select>
	</div>
	<div>
		<input readonly="readonly" type="text"  name="memberType" id="memberType" value="<?php echo htmlspecialchars($memberType) ?>" />
	</div>
	<div>
		<input type="text"  name="nerdScore" id="nerdScore" onblur="validNum('nerdScore')" value="<?php echo htmlspecialchars($nerdScore) ?>" />
	</div>
	<div>
		<input type="text"  name="gameGenre" id="gameGenre" value="<?php echo htmlspecialchars($gameGenre) ?>" />
	</div>
	<div>
		<input readonly="readonly" type="text"  name="joinDate" id="joinDate" value="<?php echo htmlspecialchars($joinDate) ?>" />
	</div>
	<div>
		<input type="checkbox" name="active" id="active" <?php if ($active == '1') echo "checked=\"checked\""; ?> />
	</div>
	<div>
		<input type="submit" name="SubmitButton" value="Save" />
	</div>
</form>
<script type="text/javascript">
	document.getElementById("fName").focus();
	<?php
		if (isset($errorMessage) && $errorMessage != "" ) {
			echo "alert(\"Please fix the folllowing:  $errorMessage \");";
		}
	?>
	function notBlank(input){
		var name = document.getElementById(input).value;
		if (name == '') {
			//alert(input + 'is required.');
			document.getElementById(input).style.background = "red";
			return false;
		} else {
			document.getElementById(input).style.background = "white";
			return true;
		}
	}
	function validNum(input){
		var num = document.getElementById(input).value;
		if (isNaN(num) || num == "") {
			document.getElementById(input).style.background = "red";
			return false;
		} else {
			document.getElementById(input).style.background = "white";
			return true;
		}
	}
	function validEmail(){
		var em = document.getElementById('email').value;
		if(!validateEmail(em))
			document.getElementById('email').style.background = "red";
		else
			document.getElementById('email').style.background = "white";
	}
	function validateEmail(email) { 
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}
	function validateAll(){
		return validateLastName();
	}
</script>
<?php
    include("../php/footerInc.php");
?>