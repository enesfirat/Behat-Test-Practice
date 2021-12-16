<?php
use Evenement\EventEmitterInterface;
use Peridot\Console\Environment;
use Peridot\Plugin\Prophecy\ProphecyPlugin;
use Peridot\Plugin\Watcher\WatcherPlugin;
use Peridot\Reporter\CodeCoverage\AbstractCodeCoverageReporter;
use Peridot\Reporter\CodeCoverageReporters;
use Peridot\Reporter\Dot\DotReporterPlugin;
use Peridot\Reporter\ListReporter\ListReporterPlugin;
use Peridot\Concurrency\ConcurrencyPlugin;
use Symfony\Component\Console\Input\InputInterface;

return function(EventEmitterInterface $emitter) {
    $watcher = new WatcherPlugin($emitter);
    $dot = new DotReporterPlugin($emitter);
    $list = new ListReporterPlugin($emitter);
    $concurrency = new ConcurrencyPlugin($emitter);
    $prophecy = new ProphecyPlugin($emitter);

    if (getenv('FULLSUITE')) {
        //running the entire suite with integration tests eats computers
        ini_set('memory_limit', '512M');
    }

    $emitter->on('peridot.start', function (Environment $env) {
        $definition = $env->getDefinition();
        $definition->getArgument('path')->setDefault('specs');
    });

    // disable watcher for concurrency workers
    $emitter->on('peridot.execute', function (InputInterface $input) {
        $token = getenv('PERIDOT_TEST_TOKEN');
        if ($token) {
            $input->setOption('watch', false);
        }
    });

    $coverage = new CodeCoverageReporters($emitter);
    $coverage->register();

    $emitter->on('code-coverage.start', function (AbstractCodeCoverageReporter $reporter) {
        $reporter->addDirectoryToWhitelist(__DIR__ . '/src');
    });
};
