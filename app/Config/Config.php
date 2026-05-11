<?php
use Webrium\Session;
use Webrium\Directory;
use Webrium\View\Engine;

// sessions save directory
Session::setSavePath(Directory::path('sessions'));



Directory::set('compiled_views', 'storage/Framework/CompiledViews');
Directory::set('static_views', 'storage/Framework/StaticViews');


Engine::setViewDir(Directory::path('views'));
Engine::setCompiledDir(Directory::path('compiled_views'));
Engine::setStaticDir(Directory::path('static_views'));