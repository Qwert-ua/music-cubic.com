var HBPlayer = function(selector, options) {

    this.$volumeValue = 1.0;
    this.$bufVolumeValue = this.$volumeValue;


    var	self = this;
    var defaults = {
        volume: this.$volumeValue
    };
    this.options = $.extend(true, {}, defaults, options);
    this.$volumeSpriteOffset = (self.options.volumeSliderStatements - 1) * self.options.volumeSpriteHeight;
    this.cssSelector = {
        play: '.player-play',
        pause: '.player-pause',
        repeat: '.player-repeat i',
        random: '.player-random i',
        next: '.player-next i',
        prev: '.player-prev i',
        tphProgress: '.tph-progress-bar',
        tphLoading: '.tph-progress-bar-loading',
        tphStatement: '.tph-progress-bar-statement',
        tphCurrentTime: '.tph-current-time',
        tphTotalTime: '.tph-total-time',
        playerVolumeSlider: '.player-volume-level',
        playerVolumeIcon: '.player-volume i',
        songName: '.tpd-song-name',
        songPerformer: '.tpd-song-performer',
        songTags: '.tpd-song-tags',

        bufferHolder: ".top-player-buffer-holder",
        buffer1: ".top-player-buffer-1",
        buffer2: ".top-player-buffer-2",
        progressHolder: ".top-player-progress-holder",
        progress1: ".top-player-progress-1",
        progress2: ".top-player-progress-2",
        circleControl: ".top-player-control"

    };
    this.cssClass = {
        gt50: "hb-player-gt50",
        fallback: "cp-fallback"
    };
    this.spritePitch = 104;
    this.spriteRatio = 0.24; // Number of steps / 100

    this.player = $(selector);
   
    this.dragging = false; 

    this.eventNamespace = ".CirclePlayer"; 


    this.$volumeMD = false;
    this.$progressMD = false;


    this._initSolution();
    this._initPlayer();

};

HBPlayer.prototype = {
    _initPlayer: function() {
        var self = this;
        this.player.jPlayer(this.options);
        this.player.bind($.jPlayer.event.ready + this.eventNamespace, function(event) {
            if(event.jPlayer.html.used && event.jPlayer.html.audio.available) {
                self.audio = $(this).data("jPlayer").htmlElement.audio;
            }
            self._initCircleControl();
        });
        this.player.bind($.jPlayer.event.canplay  + this.eventNamespace, function(event) {
            $(self.cssSelector.tphTotalTime).text($.jPlayer.convertTime(self.player.data().jPlayer.status.duration));
        });
        
        this.player.bind($.jPlayer.event.timeupdate + this.eventNamespace, function(event) {
            self._timeupdateHorizontal(event.jPlayer.status.currentTime, event.jPlayer.status.duration);
            self._timeupdateCircle(event.jPlayer.status.currentPercentAbsolute);
        });

        this.player.bind($.jPlayer.event.progress + this.eventNamespace, function(event) {
            var percent = 0;
            if((typeof self.audio.buffered === "object") && (self.audio.buffered.length > 0)) {
                if(self.audio.duration > 0) {
                    var bufferTime = 0;
                    for(var i = 0; i < self.audio.buffered.length; i++) {
                        bufferTime += self.audio.buffered.end(i) - self.audio.buffered.start(i);
                    }
                    percent = 100 * bufferTime / self.audio.duration;
                }
            } else {
                percent = 0;
            }
            self._progressHorizontal(percent);
            self._progressCircle(percent);
        });
        this.player.bind($.jPlayer.event.ended + this.eventNamespace, function(event) {
            self._resetSolution();
            if(!$(self.cssSelector.repeat).hasClass('active') && !$(self.cssSelector.random).hasClass('active')) {
                self.stop();
                self.setMedia(self.options.helper.getNextSong());
                self.play();
            }
        });



        $(self.cssSelector.play).bind('click', function() {
            $(self.cssSelector.play).hide();
            $(self.cssSelector.pause).show();
            if(!self.srcSet()) {
                var index = self.options.helper.getSongIndex();
                self.options.helper.setActive(index);
                self.setMedia(self.options.helper.getSong(index));
            }
            self.play();
        });
        $(self.cssSelector.pause).click(function() {
            $(self.cssSelector.pause).hide();
            $(self.cssSelector.play).show();
            self.pause();
        });




        $(self.cssSelector.repeat).bind('click', function() {
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
                self.player.unbind($.jPlayer.event.ended + self.cssSelector.repeat);
            } else {
                $(this).addClass('active');
                self.player.bind($.jPlayer.event.ended + self.cssSelector.repeat, function(event) {
                    self.play();
                    return false;
                });
            }

            return false;
        });
        $(self.cssSelector.random).bind('click', function() {
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
                self.player.unbind($.jPlayer.event.ended + self.cssSelector.random);
            } else {
                $(this).addClass('active');
                self.player.bind($.jPlayer.event.ended + self.cssSelector.random, function(event) {
                    self.setMedia(self.options.helper.random());
                    self.options.helper.setActive(self.options.helper.getSongIndex());
                    self.play();
                    return false;
                });
            }

            return false;
        });
        $(self.cssSelector.next).bind('click', function() {
            if(self.srcSet()) {
                self.stop();
                self.setMedia(self.options.helper.getNextSong());
                self.play();
            }
        });
        $(self.cssSelector.prev).bind('click', function() {
            if(self.srcSet()) {
                self.stop();
                self.setMedia(self.options.helper.getPrevSong());

                self.play();
            }

        });

        $(self.cssSelector.playerVolumeSlider).bind('mousedown', function() {
            self.$volumeMD = true;
        }).bind('mouseup', function() {
            self.$volumeMD = false;
        }).bind('mousemove', function(e) {
            if(self.$volumeMD) {
                var $width = $(this).width();
                var $step = parseInt($width / self.options.volumeSliderStatements);
				var eOff = (e.offsetX || e.clientX - $(e.target).offset().left);
				
                var $offset = (parseInt(eOff / $step) * self.options.volumeSpriteHeight);
                self.$volumeSpriteOffset = $offset;
                if($offset >= self.options.volumeSliderStatements * self.options.volumeSpriteHeight) return;
                $(this).css({'background-position': '0 -' + $offset  + 'px'});
                self.volume($offset / 100);
            }
        }).bind('click', function(e) {
            var $width = $(this).width();
            var $step = parseInt($width / self.options.volumeSliderStatements);
			var eOff = (e.offsetX || e.clientX - $(e.target).offset().left);
            var $offset = (parseInt(eOff / $step) * self.options.volumeSpriteHeight);
            self.$volumeSpriteOffset = $offset;
            if($offset >= self.options.volumeSliderStatements * self.options.volumeSpriteHeight) return;
            $(this).css({'background-position': '0 -' + $offset  + 'px'});
            self.volume($offset / 100);
        }).bind('mouseout', function() {
            self.$volumeMD = false;
        });


        $(self.cssSelector.tphProgress).bind('mousedown', function() {
            self.$progressMD = true;
        }).bind('mouseup', function() {
            if(self.$progressMD && self.srcSet()) {
                self.$progressMD = false;
                $(self.cssSelector.play).hide();
                $(self.cssSelector.pause).show();
            }
        }).bind('mousemove', function(e) {
            if(self.$progressMD && self.srcSet()) {
                var $width = $(this).width();
                var $pos = (e.offsetX == undefined) ? e.originalEvent.layerX : e.offsetX;
                var $percents = $pos * 100 / $width;
                var time = self.player.data().jPlayer.status.duration * $percents / 100;
                self.toTime(time);
            }
        }).bind('click', function(e) {
            if(self.srcSet()) {
                var $width = $(this).width();
                var $pos = e.offsetX;
                var $percents = $pos * 100 / $width;
                var time = self.player.data().jPlayer.status.duration * $percents / 100;
                self.toTime(time);
            }
        }).bind('mouseout', function() {
            if(self.$progressMD && self.srcSet()) {
                self.$progressMD = false;
                $(self.cssSelector.play).hide();
                $(self.cssSelector.pause).show();
            }
        });
    },
    _initSolution: function() {
        $(this.cssSelector.progressHolder).show();
        $(this.cssSelector.bufferHolder).show();
        this._resetSolution();
    },
    _resetSolution: function() {
        $(this.cssSelector.progressHolder).removeClass(this.cssClass.gt50);
        $(this.cssSelector.progress1).css({'transform': 'rotate(0deg)'});
        $(this.cssSelector.progress2).css({'transform': 'rotate(0deg)'}).hide();
    },

    _timeupdateHorizontal: function(time, duration) {
        var percent = 100 * time / duration;
        if(percent > 100) percent = 100;
        $(this.cssSelector.tphStatement).css({width: percent + '%'});
        $(this.cssSelector.tphCurrentTime).text($.jPlayer.convertTime(time));
    },
    _timeupdateCircle: function(percent) {
        var degs = percent * 3.6+"deg";
        if (percent <= 50) {
            $(this.cssSelector.progressHolder).removeClass(this.cssClass.gt50);
            $(this.cssSelector.progress1).css({'transform': 'rotate(' + degs + ')'});
            $(this.cssSelector.progress2).hide();
        } else if (percent <= 100) {
            $(this.cssSelector.progressHolder).addClass(this.cssClass.gt50);
            $(this.cssSelector.progress1).css({'transform': 'rotate(180deg)'});
            $(this.cssSelector.progress2).css({'transform': 'rotate(' + degs + ')'});
            $(this.cssSelector.progress2).show();
        }
    },

    _progressHorizontal: function(percent) {
        if(percent > 100) percent = 100;
        $(this.cssSelector.tphLoading).css({width: percent + '%'});

    },
    _progressCircle: function(percent) {
        var degs = percent * 3.6+"deg";
        if (percent <= 50) {
            $(this.cssSelector.bufferHolder).removeClass(this.cssClass.gt50);
            $(this.cssSelector.buffer1).css({'transform': 'rotate(' + degs + ')'});
            $(this.cssSelector.buffer2).hide();
        } else if (percent <= 100) {
            $(this.cssSelector.bufferHolder).addClass(this.cssClass.gt50);
            $(this.cssSelector.buffer1).css({'transform': 'rotate(180deg)'});
            $(this.cssSelector.buffer2).show();
            $(this.cssSelector.buffer2).css({'transform': 'rotate(' + degs + ')'});
        }

    },
    _initCircleControl: function() {
        var self = this;
        $(this.cssSelector.circleControl).grab({
            onstart: function(){
                self.pause();
                self.options.helper.showPlay();
            }, onmove: function(event){
                var pc = self._getArcPercent(event.position.x, event.position.y);
                self.player.jPlayer("playHead", pc).jPlayer("play");
                self._timeupdateCircle(pc);
            }, onfinish: function(event){
                var pc = self._getArcPercent(event.position.x, event.position.y);
                self.player.jPlayer("playHead", pc).jPlayer("play");
                self.options.helper.hidePlay();
            }
        });
    },
    _getArcPercent: function(pageX, pageY) {
        var	offset = $(this.cssSelector.circleControl).offset(),
            x	= pageX - offset.left - $(this.cssSelector.circleControl).width()/2,
            y	= pageY - offset.top - $(this.cssSelector.circleControl).height()/2,
            theta	= Math.atan2(y,x);

        if (theta > -1 * Math.PI && theta < -0.5 * Math.PI) {
            theta = 2 * Math.PI + theta;
        }
        return (theta + Math.PI / 2) / 2 * Math.PI * 10;
    },

    setMedia: function(media) {
        $(this.cssSelector.songName).text(media.author + '-' + media.name);
        $(this.cssSelector.songPerformer).text(media.author);
        this.options.helper.generateTags([media.author, media.name, media.album], $(this.cssSelector.songTags));
        this.media = $.extend({}, media);
        this.player.jPlayer("setMedia", this.media);
    },
    play: function() {
        this.player.jPlayer("play", this.player.data().jPlayer.status.currentTime);
    },
    pause: function() {
        this.player.jPlayer("pause", this.player.data().jPlayer.status.currentTime);
    },
    stop: function() {
        this.player.jPlayer("stop");
    },
    destroy: function() {
        this.player.unbind(this.eventNamespace);
        this.player.jPlayer("destroy");
    },
    volume: function(vol) {
        if(vol > 1) vol = 1.0;
        if(vol < 0) vol = 0.0;
        this.player.jPlayer("volume", vol);
    },
    srcSet: function() {
        return this.player.data().jPlayer.status.srcSet;
    },
    mute: function(mute) {
        if(!mute) {
            $(this.cssSelector.playerVolumeSlider).css({'background-position': '0 -' + this.$volumeSpriteOffset  + 'px'});
            $(this.cssSelector.playerVolumeIcon).removeClass('fa-volume-off').addClass('fa-volume-up');

        } else {
            $(this.cssSelector.playerVolumeSlider).css({'background-position': '0 0'});
            $(this.cssSelector.playerVolumeIcon).removeClass('fa-volume-up').addClass('fa-volume-off');
        }
        this.player.jPlayer("mute", mute);
    },
    toTime: function(time) {
        this.player.jPlayer("pause", time);
        this.player.jPlayer("play", time);
    }
};
var Helper = function($songs) {
    this.$songs = $songs;
    this.$songIndex = 0;

};
Helper.prototype = {
    initHTML: function() {
        $.each(this.$songs, function(index, value) {
            var $html = $(document).find('#list_item_template').html();
            $('.tpd-list').append($html
                .replace('+id+', index)
                .replace('+index+', index + 1)
                .replace('+author+', value.author)
                .replace('+name+', value.name)
                .replace('+duration+', value.duration));
        });
		 $('[data-toggle="tooltip"]').tooltip()
    },
    getSong: function(index) {
        var $song = this.$songs[index];
        var $songObj = $.extend({}, $song);
        $songObj[$song.mimeType] = $song.path;
        return $songObj;
    },
    getNextSong: function() {
        this.$songIndex++;
        if (typeof this.$songs[this.$songIndex] == 'undefined') {
            this.$songIndex = 0;
        }
        var $song = this.getSong(this.$songIndex);
        this.setActive(this.$songIndex);

        return $song;
    },
    getPrevSong: function() {
        this.$songIndex--;
        if (typeof this.$songs[this.$songIndex] == 'undefined') {
            this.$songIndex = this.$songs.length - 1;
        }
        this.setActive(this.$songIndex);
        return this.getSong(this.$songIndex);
    },
    getSongIndex: function() {
        return this.$songIndex;
    },
    setActive: function(index) {
        $('.tpd-list').find('.tpd-list-item').removeClass('tpd-list-item-active').eq(index).addClass('tpd-list-item-active');
    },
    random: function() {
        this.$songIndex = Math.floor(Math.random() * this.$songs.length);
        var $song = this.$songs[this.$songIndex];
        var $songObj = $.extend({}, $song);
        $songObj[$song.mimeType] = $song.path;
        return $songObj;
    },
    generateTags: function(tags, $wrapper) {
        $wrapper.html('<i class="fa fa-tags"></i> ');
        for(var i = 0; i < tags.length; i++) {
            $wrapper.append('<a href="">#' + tags[i] + ' </a>');
        }
    },
    hidePlay: function() {
        $('.player-play').hide();
        $('.player-pause').show();
    },
    showPlay: function() {
        $('.player-pause').hide();
        $('.player-play').show();
    }
};
$(document).ready(function() {
    var $songs = [
        {
            album: 'la',
            author: 'Ray Band',
            name: 'Крыла',
            path: './uploads/ray_band_kryla.mp3',
            duration: '33:11',
            mimeType: 'mp3' 
        },
        {
            album: 'lalalaal',
            author: 'Miaow',
            name: 'Bubble',
            path: 'http://www.jplayer.org/audio/mp3/Miaow-07-Bubble.mp3',
            duration: '00:52',
            mimeType: 'mp3'
        }
    ];
    var helper = new Helper($songs);
    helper.initHTML();
    var playerOptions = {
        volumeSpriteHeight: 16,
        volumeSliderStatements: 7,
        helper: helper
    };
    var hbPlayer = new HBPlayer("#top_player_handler", playerOptions);
    $('.player-volume').click(function() {
        var $i = $('.player-volume').find('i');
        if($i.hasClass('fa-volume-off')) {
            hbPlayer.mute(false);
        } else {
            hbPlayer.mute(true);
        }
    });

    $('.tpd-list-item-name').click(function() {
        var index = $(this).data('index');
        helper.setActive(index);
        helper.hidePlay();
        hbPlayer.setMedia(helper.getSong(index));
        hbPlayer.play();
    });
	
    $('.top-player-wrapper').hover(function() {
        $('.top-player-dropdown').stop(true, true).delay(1000).fadeToggle('fast');
    })
});
