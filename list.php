<?php

require(__DIR__ . '/../../config.php');

global $PAGE, $DB, $CFG;

date_default_timezone_set("UTC");

$course_id = optional_param('courseid', null, PARAM_INT);

// course context
$title = get_string('course_nav_item', 'local_bbzshowmails');
$course = $DB->get_record('course', array('id' => $course_id));

require_login($course);

$PAGE->set_context(\context_course::instance($course_id));
$PAGE->set_pagelayout('incourse');
$PAGE->set_course($course);

// Load emails
$context = context_course::instance($course_id);
$user_list = get_enrolled_users($context, null, null, 'u.email');
$emails = [];
foreach($user_list as &$user) {
  array_push($emails, $user->email);
}

$PAGE->set_url('/local/bbzshowmails/list.php');
$PAGE->set_title($title);
$PAGE->set_heading($title);

$PAGE->navbar->add($title);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_bbzshowmails/list', $emails);
echo $OUTPUT->footer();
