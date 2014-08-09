<?php
include_once "common/connection.php";
$pageTitle = "HOME";
include_once "common/header.php";
?>

<div id="main">
	
<div>
<?php
if(isset($_SESSION['LoggedIn']) && isset($_SESSION['UserID'])):
	include_once "inc/class.questPapers.inc.php";
	$questPaper = new QuestionPapers($db);
	if(($result = $questPaper->getQuestionPapers()) != FALSE):
?>
<table>
	<thead>
	<tr>
		<th>Exam Name</th>
		<th>Department</th>
		<th>Subject code</th>
		<th>Subject</th>
		<th>Semester</th>
		<th>Total Marks</th>
		<th>Date</th>
	</tr>
	</thead>
	<tbody>
<?php
	$semesters =  array(
						"1" => "I",
						"2" => "II",
						"3" => "III",
						"4" => "IV",
						"5" => "V",
						"6" => "VI",
						"7" => "VII",
						"8" => "VIII"
					);
	foreach($result as $row)
	{
		echo "<tr>";
		echo "<td>".$row['examName']."</td>";
		echo "<td>".$row['department']."</td>";
		echo "<td>".$row['subjectcode']."</td>";
		echo "<td>".$row['subject']."</td>";
		echo "<td>".$semesters[$row['semester']]."</td>";
		echo "<td>".$row['totalmarks']."</td>";
		echo "<td>".date("d-m-Y", strtotime($row['date']))."</td>";
		echo "<tr/>";
	}
?>
</tbody>
</table>
<?php
	else:
		echo "<p>You have not added any question papers yet.</p>";
	endif;
	echo "</div>";
else:
	header("Location: login.php");
	exit;
endif;
?>


