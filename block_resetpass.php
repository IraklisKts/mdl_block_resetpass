<?php
require_once('lib.php');
class block_resetpass extends block_base {
    public function init() {
        $this->title = get_string('resetbutton', 'block_resetpass');
    }
    // The PHP tag and the curly bracket for the class definition
    // will only be closed after there is another function added in the next section.
	public function get_content() {
		global $CFG;
	 	$mform = new simplehtml_form();
	    $this->content         =  new stdClass;
	    $this->content->text   =  $mform->render() ;
	    $this->content->footer = '';
	    return $this->content;
	}
}
