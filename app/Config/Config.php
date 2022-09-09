<?php
use Webrium\Session;
use Webrium\Directory;

// sessions save directory
Session::set_path(Directory::path('sessions'));
