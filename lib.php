<?php

defined('MOODLE_INTERNAL') || die();

function local_bbzshowmails_extend_navigation_course(navigation_node $navigation) {
  global $PAGE;

  $course_id = $PAGE->course->id;

  $course_showmail_item = navigation_node::create(
    get_string('course_nav_item', 'local_bbzshowmails'),
    new moodle_url('/local/bbzshowmails/list.php?courseid=' . $course_id),
    null,
    'showmails',
    'showmails',
    new pix_icon('i/calendar', '')
  );
  // https://moodle.org/mod/forum/discuss.php?d=445503
  $navigation->add_node($course_showmail_item, 'grades');
}
