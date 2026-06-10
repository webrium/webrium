<?php
use Webrium\Session;
use Webrium\Directory;
use Webrium\View\Engine;

// sessions save directory
Session::setSavePath(Directory::path('sessions'));

Engine::setViewDir(Directory::path('views'));
Engine::setCompiledDir(Directory::path('render_views'));
Engine::setStaticDir(Directory::path('static_views'));