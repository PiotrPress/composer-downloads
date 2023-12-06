<?php declare( strict_types = 1 );

namespace PiotrPress\Composer\Downloads;

use Composer\Plugin\PluginInterface;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginEvents;
use Composer\Plugin\PreFileDownloadEvent;

class Plugin implements PluginInterface, EventSubscriberInterface {
    public function activate( Composer $composer, IOInterface $io ) : void {}
    public function deactivate( Composer $composer, IOInterface $io ) : void {}
    public function uninstall( Composer $composer, IOInterface $io ) : void {}

    public static function getSubscribedEvents() : array {
        return [ PluginEvents::PRE_FILE_DOWNLOAD => 'preFileDownload' ];
    }

    public function preFileDownload( PreFileDownloadEvent $event ) : void {
        if ( 'package' !== $event->getType() ) return;
        $package = $event->getContext();

        $url = \parse_ini_string( 'URL=' . \str_replace(
            [ '${VENDOR}', '${NAME}', '${VERSION}' ],
            [ \dirname( $package->getName() ), \basename( $package->getName() ), $package->getPrettyVersion() ],
            $event->getProcessedUrl() ) );

        $event->setProcessedUrl( \reset( $url ) );
    }
}