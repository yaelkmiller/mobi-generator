<?php session_start(); ?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>MOBI Generator</title>
		<link rel="stylesheet" href="style.css">
		<script src="jquery-1.11.3.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#add-image1-row").hide();
				$("#add-image2-row").hide();
				$("#add-image-button").click(function() {
					$("#add-image1-row").show();
					$("#add-image2-row").show();
				});
				var error1 = <?php if(isset($_SESSION["errors"]["add-image1"])){
					echo "true";
				}
				else {
					echo "false";
				} ?>;
				if( error1 == true)
				{
					$("#add-image1-row").show();
					$("#add-image2-row").show();
				}
				var error2 = <?php if(isset($_SESSION["errors"]["add-image2"])){
					echo "true";
				}
				else {
					echo "false";
				} ?>;
				if( error1 == true){
					$("#add-image1-row").show();
					$("#add-image2-row").show();
				}
				var temp = <?php if(isset($_SESSION['console'])){
						echo "true";
					} 
					else { 
						echo "false";
					} ?>;
				if( temp == true) {
					$(".hide-stuff").hide();
				}
			});
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div>
					<h1 id="page-title">MOBI Generator</h1>
				</div> <!-- title span -->
			</div> <!-- title row -->
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<p class="logline">Run Amazon's KindleGen right here &mdash; no command line &mdash; and convert your files into MOBI format so it's ready to upload to Kindle.</p>
				</div> <!-- intro span -->
			</div> <!-- intro row -->
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<p>Remember to check your MOBI file in Amazon's Kindle Previewer. <a href="#legal" class="legal-link">Legal Notices</a></p>
				</div> <!-- Kindle Previewer span -->
			</div> <!-- Kindle Previewer row -->
			<div class="hide-stuff">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<h3>Upload your files below so they can be converted:</h3>
					</div> <!-- upload text span -->
				</div> <!-- upload text row -->
				<div class="col-md-4 col-md-offset-1">
					<?php if (isset($_SESSION["errors"])) {
	             			foreach ($_SESSION["errors"] as $error) {
	                			echo $error;
	            			}
	          			} ?>
				</div>
				<div id="upload-form" class="col-md-6 col-md-offset-4">
					<form action="process.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="action" value="upload" />
						<input type="hidden" name="time" value="<?php echo date('Y-m-d-H-i-s'); ?>" />
						<?php if (isset($_SESSION["errors"]["ebook-html"])) {
	              			echo "<div class='row fix'>";
	            		}
	            		else {
	              			echo "<div class='row'>";
	            		} ?>
									<label for="ebook-html">Main ebook .html file:</label>
									<input name="userfile[]" type="file" class="upload-file" id="ebook-html" /><br />
						</div> <!-- main file row --><br/>
						<?php if (isset($_SESSION["errors"]["toc-html"])) {
	              			echo "<div class='row fix'>";
	            		}
	            		else {
	              			echo "<div class='row'>";
	            		} ?>
									<label for="toc-html">Table of Contents .html file:</label>
									<input name="userfile[]" type="file" class="upload-file" id="toc-html" /><br />
						</div> <!-- toc html file row --><br/>
						<?php if (isset($_SESSION["errors"]["toc-ncx"])) {
	              			echo "<div class='row fix'>";
	            		}
	            		else {
	              			echo "<div class='row'>";
	            		} ?>
									<label for="toc-ncx">Table of Contents .ncx file:</label>
									<input name="userfile[]" type="file" class="upload-file" id="toc-ncx" /><br />
						</div> <!-- toc ncx file row --><br/>
						<?php if (isset($_SESSION["errors"]["ebook-opf"])) {
	              			echo "<div class='row fix'>";
	            		}
	            		else {
	              			echo "<div class='row'>";
	            		} ?>
									<label for="ebook-opf">Ebook .opf file:</label>
									<input name="userfile[]" type="file" class="upload-file" id="ebook-opf" /><br />
						</div> <!-- opf file row --><br/>
						<div class="row">
							
						</div> <!-- more images -->
						<?php if (isset($_SESSION["errors"]["cover-image"])) {
	              			echo "<div class='row fix'>";
	            		}
	            		else {
	              			echo "<div class='row'>";
	            		} ?>
									<label for="cover-image">Book cover image:</label>
									<input name="userfile[]" type="file" class="upload-file" id="cover-image" /><br /><br/>
						</div> <!-- cover image file row -->
						<div class="row">
							<button class="btn btn-primary" id="add-image-button" type="button">Add More Images</button>
						</div> <!-- add button row -->
						<?php if (isset($_SESSION["errors"]["add-image1"])) {
	              			echo "<div class='row fix' id='add-image1-row'>";
	            		}
	            		else {
	              			echo "<div class='row'id='add-image1-row'>";
	            		} ?>
							<label for="add-image1" id="add-image1-label">Additional Image:</label>
							<input name="userfile[]" type="file" class="upload-file" id="add-image1" />
						</div> <!-- additional image 1 -->
						<?php if (isset($_SESSION["errors"]["add-image2"])) {
	              			echo "<div class='row fix' id='add-image2-row'>";
	            		}
	            		else {
	              			echo "<div class='row'id='add-image2-row'>";
	            		} ?>
							<label for="add-image2" id="add-image2-label">Additional Image:</label>
							<input name="userfile[]" type="file" class="upload-file" id="add-image2" />
						</div> <!-- additional image 1 -->
						<br/><div class="row">
						<input type="submit" value="Upload" class="btn btn-success btn-large" multiple="multiple" />
					</div> <!-- upload button -->
					</form>
			</div> <!-- form div -->
	</div> <!-- stuff that will be hidden -->
		<div class="row">
				<?php 
				if (isset($_SESSION["console"])) {
					echo "<div class='span10 offset1 console'><pre>".$_SESSION["console"]."</pre>";
				}
				else {
					echo "<div class='span10 offset1'>";
				}
				 ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php
				if(isset($_SESSION["mobi"])) {
					$new_mobi = str_replace('\\', '/', $_SESSION['mobi']);
					echo "<a href='{$new_mobi}' class='btn btn-success btn-large'>Download MOBI file</a>";
				}
				?>
			</div> <!-- console span -->
		</div> <!-- console row -->
		<hr>
		<footer id="legal" class="col-md-10 col-md-offset-1">
			<p><a href="#page-title" class="up-carrot">&#94;</a>&nbsp;KindleGen and Kindle Previewer are copyrighted by Amazon.</p>
			<p>We have no affiliation with Amazon beyond being self-published authors on KDP and customers of Amazon.</p>
			<p>We make no guarantees that Amazon will accept MOBI files produced by this tool.</p>
			<p>In no way does the use of this tool transfer the copyright of the uploaded files and the subsequent MOBI file to the creator(s) of the tool, the owner of this website, or anyone else.</p>
			<p>THE TOOL IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO ANY WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF COPYRIGHT, PATENT, TRADEMARK, OR OTHER RIGHT. IN NO EVENT SHALL THE CREATOR(S) BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, INCLUDING ANY GENERAL, SPECIAL, INDIRECT, INCIDENTAL, OR CONSEQUENTIAL DAMAGES, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF THE USE OR INABILITY TO USE THE TOOL OR FROM OTHER DEALINGS IN THE TOOL.</p>
		</footer>
	</div> <!-- container -->
	</body>
</html>
<?php 
unset($_SESSION["errors"]);
unset($_SESSION["console"]);
unset($_SESSION["mobi"]);
?>