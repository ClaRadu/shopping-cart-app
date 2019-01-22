<?php
// class that handles data export
include 'gvars.php';

class exportData extends Connection
{
	private $file, $name, $root, $node;
	
	function create($fname) {
		$this->name = $fname;
		$this->file = new DOMDocument();
	}

	public function setRoot($new) { $this->root = $new; }
	public function setNode($new) { $this->node = $new; }
	
	// loop trough items in the database and store them to an external file
	function export($sql, $elem) {
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) { // if data found
			if ($this->file) {
				$rt = $this->file->createElement($this->root);
			
				// output data, row by row
				while($row = $result->fetch_assoc()) {
					$nd = $this->file->createElement($this->node);
					foreach ($elem as $e) {
						$val = $this->file->createElement($e, $row[$e]);
						$nd->appendChild($val); // store value
					}
					// store node
					$rt->appendChild($nd);
				}
				// store root
				$this->file->appendChild($rt);
				// save to file
				echo 'Data successfully exported to file: ' . $this->name . ' ';
				$this->file->save($this->name);
			}
		}
	}
}

?>
