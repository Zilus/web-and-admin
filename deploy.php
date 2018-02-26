<?php
namespace Deployer;

require 'recipe/symfony3.php';

// Project name
set('application', 'My Proyect');

//HTTP User
set('http_user', 'cpanel-user');

// Project repository
set('repository', 'git@github.com:zilus/repo.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
inventory('hosts.yml');

// Tasks
task('deploy:shared', function() {
    $files = get('shared_files');

    foreach ($files as $file)
    {
        upload($file, "{{deploy_path}}/release/".$file);
    }
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

after('deploy:update_code', 'deploy:shared');

