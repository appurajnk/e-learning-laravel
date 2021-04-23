<template>
    <div class="video-js-responsive-containerx vjs-hdx video-border vjs-16-9">
        <video autoplay ref="videoPlayer" class="video-js"></video>
    </div>
</template>

<script>
import videojs from 'video.js';
import youtube from 'videojs-youtube';
require('../../resolution-switcher')
export default {
    name: "VideoPlayer",
    
    props: {
        poster: { type: String, required: false },
        sources: {
            type: Array,
            default() {
                return [];
            }
        },
        next_url: { type: String, required: false },
        content_type: { type: String, default: 'youtube' }
    },

    data(){
        return {
            player: null,
            playerOptions:{
                muted: false,
                autoplay: false,
                language: 'en',
                fluid: true,
                responsive: true,
                techOrder: ['html5', 'youtube'],
                playbackRates: [0.5, 1, 1.5, 2],
                sources: [],
                poster: "",
                controls: false,
                youtube: {
                    ytControls: 2,
                    customVars: { 
                        wmode: 'transparent' 
                    }
                },

                plugins:{
                    videoJsResolutionSwitcher: {
                        default: 'low',
                        dynamicLabel: true
                    }
                }
            }
        }
    },

    methods: {
        
    },


    beforeMount(){
        if(this.content_type !== 'youtube') {
            this.playerOptions.controls=true
            this.playerOptions.autoplay=true
        }
        this.playerOptions.poster = this.poster
        this.playerOptions.sources = this.sources

    },

    async mounted() {
        this.player = await videojs(this.$refs.videoPlayer, this.playerOptions, function onPlayerReady() {
            //console.log('ready')
            //this.player.play()
        }).on('ended', () => {
            if(this.next_url){
                setTimeout(() => {
                    window.location.href= this.next_url
                }, 2000)
            }
        })

        this.$bus.$on('video:stop', () => {
            if(this.player){
                this.player.dispose()
            }
        })
    },

    beforeDestroy() {
        if (this.player) {
            this.player.dispose()
        }
    }

}
</script>

<style>
    .video-border{
        border: 5px solid #6c757d85;
    }

    .vjs-resolution-button .vjs-resolution-button:before {
        content: '\f110';
        font-family: VideoJS;
        font-weight: normal;
        font-style: normal;
        font-size: 1.8em;
        line-height: 1.67em;
    }

    /* .vjs-resolution-button .vjs-resolution-button-label {
        font-size: 1em;
        line-height: 3em;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        text-align: center;
        box-sizing: inherit;
    }  */

    /* 
    .vjs-resolution-button .vjs-menu .vjs-menu-content {
        width: 4em;
        left: 50%;
        margin-left: -2em; 
    }

    .vjs-resolution-button .vjs-menu li {
        text-transform: none;
        font-size: 1em;
    } */
</style>
