<?php
	namespace WolfNet_Computing\MD_Reader;

	class Parser {
		private $FindMDNewline = "/\s+/";
		private $OriginalFileContent;

		function __construct($file, $OutputType) {
			$mdfile = fopen($file, 'r') or die('Unable to open file!');
			$this->OriginalFileContent = fread($mdfile, filesize($file));
			fclose($mdfile);
			clearstatcache();
			if ($OutputType == 'HTML') {
				return $this->ParseHTML($this->OriginalFileContent);
			} else {
				die('Unrecognised output format!');
			}
		}

		# Returns the HTML formatted array of lines contained in the $HtmlFormattedMarkdown array.
		function ParseHTML($HtmlString) {
			# First to split the string by the markdown double space newline and append the HTML newline to the end of each of the strings in the resulting array.
			$array = preg_split($this->FindMDNewline, $HtmlString);
			for ($i = 0; $i < count($array); ++$i) {
				$array[$i] .= '<br>';
			}
			return $array;
		}
	}
?>