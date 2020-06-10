<?php
//moodleform is defined in formslib.php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/login/lib.php');

class simplehtml_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!
        $buttonarray=array();
        $buttonarray[] = $mform->createElement('html','<button class="btn btn-secondary" type="submit" formaction="blocks/resetpass/user.php">Reset Password</button>');
        $mform->addGroup($buttonarray, 'buttonarr', '', ' ', false);
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}


function core_login_process_password_reset_requests() {
    global $OUTPUT, $PAGE, $DB;
    $userid=required_param('id',PARAM_INT);
    // $mform = new login_forgot_password_form();

    // if ($mform->is_cancelled()) {
    //     redirect(get_login_url());

    // } else
      $data = new login_forgot_password_form();

      $username = $email = '';
      if (!empty($data->username)) {
          $username = $data->username;

      } else {
          $user=$DB->get_record('user', array('id' => $userid));


          $email=$user->email;


      }
      list($status, $notice, $url) = core_login_process_password_reset($username, $email);

      // set url so it continues to reset more passwords
      $url = 'user.php';

      // Plugins can perform post forgot password actions once data has been validated.
      // core_login_post_forgot_password_requests($data);

      // Any email has now been sent.
      // Next display results to requesting user if settings permit.
      redirect('user.php');
      echo $OUTPUT->header();
      notice($notice, $url);
      die; // Never reached.

    // }

    // DISPLAY FORM.

    echo $OUTPUT->header();
    echo $OUTPUT->box(get_string('passwordforgotteninstructions2'), 'generalbox boxwidthnormal boxaligncenter');
    $mform->display();

    echo $OUTPUT->footer();
}
