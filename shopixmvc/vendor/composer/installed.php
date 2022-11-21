<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '018956e887112cf6bee167d3c91c881c71bffc58',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '018956e887112cf6bee167d3c91c881c71bffc58',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'roave/security-advisories' => array(
            'pretty_version' => 'dev-latest',
            'version' => 'dev-latest',
            'reference' => '964c5d9ca40d0ec72db203b3dd6382a30abef616',
            'type' => 'metapackage',
            'install_path' => NULL,
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'dev_requirement' => true,
        ),
        'smarty/smarty' => array(
            'pretty_version' => 'v4.2.1',
            'version' => '4.2.1.0',
            'reference' => 'ffa2b81a8e354a49fd8a2f24742dc9dc399e8007',
            'type' => 'library',
            'install_path' => __DIR__ . '/../smarty/smarty',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
