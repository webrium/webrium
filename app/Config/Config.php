<?php
use Webrium\Session;
use Webrium\Directory;
use Zog\Zog;

// sessions save directory
Session::setSavePath(Directory::path('sessions'));



Directory::set('compiled_views', 'storage/Framework/CompiledViews');
Directory::set('static_views', 'storage/Framework/StaticViews');


Zog::setViewDir(Directory::path('views'));
Zog::setCompiledDir(Directory::path('compiled_views'));
Zog::setStaticDir(Directory::path('static_views'));