<?php
$domain = 'wwdev.systems';

$apacheConfigFile = '/usr/local/etc/apache24/sites-enabled';
$configLine = "Use VHostSSL $domain\n";


if (strpos(file_get_contents($apacheConfigFile), $configLine) === false) {
    // Append the new domain configuration
    file_put_contents($apacheConfigFile, $configLine, FILE_APPEND);

    // Reload Apache to apply changes
    exec("sudo synoservicecfg --restart apache2");
    echo "Domain $domain added and Apache restarted.";
} else {
    echo "Domain $domain is already present in the configuration.";
}
?>