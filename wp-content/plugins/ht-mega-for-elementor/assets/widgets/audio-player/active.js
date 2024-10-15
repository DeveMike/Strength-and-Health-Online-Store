(function ($) {
    "use strict";
    var HTMegaAudioPlayer = function ( $scope, $ ){
        var container_elem = $scope.find('.htmega-audio-player-wrapper').eq(0);
        if ( container_elem.length > 0 ) {
            container_elem[0].style.display='flex';
            var settings = container_elem.data('audio-settings');
            var activeUniqClass = container_elem.find('.htmega-audio-player');
            activeUniqClass.mediaelementplayer({
                 shimScriptAccess: "always",
                 alwaysShowControls: true,
                features: settings['features'],
                 hideVolumeOnTouchDevices: true,
                 startVolume: parseFloat( settings['startVolume'] ),
                 audioVolume: settings['audioVolume'],
                 //loop: false,
                 autoRewind: true,
                 enableAutosize: true,
                 stretching: 'auto',
                 classPrefix: 'mejs-',
                 enableKeyboard: true,
                 pauseOtherPlayers: true,
                 duration: -1,
                 success: function (mediaElement, originalNode, instance) {
                     mediaElement.setCurrentTime( parseFloat( settings['restrictTime'] ) );
         
                     mediaElement.addEventListener('progress', function() {
                         const duration = mediaElement.duration;
                         const durationContainer = $(mediaElement).siblings('.mejs__time-total').find('.mejs__duration');
                         if (durationContainer.length > 0) {
                             durationContainer.text(mediaElement.formatTime(duration));
                         }
                     });
         
                     if (mediaElement) {
                        mediaElement.load();
                    }
                 }
             });
            //  pro fearrues
             if( settings?.playerIcons ){
                let playPauseButton = container_elem.find(".mejs-playpause-button button"),
                volumeButtion = container_elem.find(".mejs-volume-button button");
                playPauseButton.html(
                `<i aria-hidden="true" class="htmega-audio-play ${settings.playerIcons.play}"></i><i aria-hidden="true" class="htmega-audio-pause ${settings.playerIcons.pause}"></i><i aria-hidden="true" class="htmega-audio-replay ${settings.playerIcons.replay}"></i>`
                ),
                volumeButtion.html(`<i aria-hidden="true" class="htmega-audio-unmute ${settings.playerIcons.unmute}"></i><i aria-hidden="true" class="htmega-audio-mute ${settings.playerIcons.mute}"></i>`);
             }
       }
 
    }
    // Run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/htmega-audio-player-addons.default', HTMegaAudioPlayer);
    });      


})(jQuery);