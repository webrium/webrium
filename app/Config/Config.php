<?php
use webrium\core\Session;
use webrium\core\Directory;

// sessions save directory
Session::set_path(Directory::path('sessions'));
