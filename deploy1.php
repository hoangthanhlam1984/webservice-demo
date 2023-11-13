<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/hoangthanhlam1984/webservice-demo.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('68.183.232.113')
    ->set('remote_user', 'project')
    ->set('deploy_path', '~/webservice-demo');

// Hooks

after('deploy:failed', 'deploy:unlock');
