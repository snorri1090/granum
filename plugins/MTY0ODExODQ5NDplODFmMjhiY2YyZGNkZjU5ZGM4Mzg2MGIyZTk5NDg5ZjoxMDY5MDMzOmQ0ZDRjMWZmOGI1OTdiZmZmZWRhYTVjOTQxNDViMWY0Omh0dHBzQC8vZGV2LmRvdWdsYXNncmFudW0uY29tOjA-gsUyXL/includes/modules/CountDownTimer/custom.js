(function($) {
    window.dmpro_countdown_destroy = function(clock) {
        clock.off('update.countdown');
        clock.off('finish.countdown');
        clock.off('stop.countdown');
        if (undefined === clock.data("countdown-instance")) { return; }
        clock.countdown('remove');
        clock.empty();
    }

    window.dmpro_countdown = function(clock) {
        let config = JSON.parse(clock.attr("data-config"));
        config = pluralizeLabels(config);
        config = adjustCurrentDate(config);

        if (!config.date || '' === config.date) { return; }

        let counterConfig = {};
        if ('continue' === config.finish_countdown) {
            counterConfig.elapse = true;
        }

        var components = [];

        if (config.show_weeks) {
            components.push("weeks");
        }

        if (config.show_days) {
            components.push("days");
        }

        if (config.show_hours) {
            components.push("hours");
        }

        if (config.show_minutes) {
            components.push("minutes");
        }

        if (config.show_seconds) {
            components.push("seconds");
        }

        config.components = components;

        clock.countdown(config.date, counterConfig);

        switch (config.style) {
            case 'custom_format':
                setupCustomFormat(clock, config);
                break;
            case 'block_clock':
                setupBlockClock(clock, config);
                break;
            case 'flip_clock':
            default:
                setupFlipClock(clock, config);
        }



        function addFlipClockHtml(clock, config) {
            var template = '<div class="face_wrapper">';

            config.components.map((component, index) => {
                var label = config["label_" + component].split(",")[1];
                label = `<div class="label">${label}</div>`;

                template += `<div class="face face_${component}">`;
                if ('above' === config.clock_label_position) {
                    template += label;
                }

                template += '<div class="' + ['time', component].join(' ') + '">';
                template += '<span class="count curr top">00</span>';
                template += '<span class="count next top">00</span>';
                template += '<span class="count next bottom">00</span>';
                template += '<span class="count curr bottom">00</span>';
                template += '</div>';

                if ('below' === config.clock_label_position) {
                    template += label;
                }
                template += '</div>'; 
            });

            template += '</div>'; 

            clock.html(template);
        }

        function addBlockClockHtml(clock, config) {
            var template = '<div class="face_wrapper">';

            config.components.map((component, index) => {
                var label = config["label_" + component].split(",")[1];
                label = `<div class="label">${label}</div>`;

                template += `<div class="face face_${component}">`;
                if ('above' === config.clock_label_position) {
                    template += label;
                }

                template += '<div class="' + ['time', component].join(' ') + '">';
                template += '00';
                template += '</div>';

                if ('below' === config.clock_label_position) {
                    template += label;
                }
                template += '</div>'; 
            });

            template += '</div>';

            clock.html(template);
        }

        function getClockFormat(components) {
            var format = '';

            if (components.includes("weeks")) {
                format += '%w:%d:%H:%M:';
            } else if (components.includes("days")) {
                format += '%D:%H:%M:';
            } else if (components.includes("hours")) {
                format += '%I:%M:';
            } else if (components.includes("minutes")) {
                format += '%N:';
            } else {
                format += '%T';
            }

            if (components.includes("seconds") && components.includes("minutes")) {
                format += '%S';
            }

            return format;
        }

        function setupFlipClock(clock, config) {
            addFlipClockHtml(clock, config);
            var format = getClockFormat(config.components);
            var currDate = '00:00:00:00:00';
            var nextDate = '00:00:00:00:00';


            function strfobj(str) {
                var parsed = str.split(":");
                var obj = {};
                config.components.forEach(function(label, i) {
                    obj[label] = parsed[i]
                });
                return obj;
            }


            function diff(obj1, obj2) {
                var diff = [];
                config.components.forEach(function(key) {
                    if (obj1[key] !== obj2[key]) {
                        diff.push(key);
                    }
                });
                return diff;
            }

            clock.on('update.countdown', function(event) {
                var newDate = event.strftime(format);

                var data;
                if (newDate !== nextDate) {
                    currDate = nextDate;
                    nextDate = newDate;
                    data = {
                        'curr': strfobj(currDate),
                        'next': strfobj(nextDate)
                    };
                    diff(data.curr, data.next).forEach(function(label) {

                        var selector = '.%s'.replace(/%s/, label),
                            $node = clock.find(selector);

                        $node.removeClass('flip');
                        $node.find('.curr').text(data.curr[label]);
                        $node.find('.next').text(data.next[label]);

                        setTimeout(function($the_node) {
                            $the_node.addClass('flip');
                        }, 50, $node);
                    });
                }

                updateClockLabels(clock, config, event);
            });

            setupFinishCountdown(clock, config);
        }

        function setupBlockClock(clock, config) {
            addBlockClockHtml(clock, config);
            var format = getClockFormat(config.components);

            function strfobj(str) {
                var parsed = str.split(":");
                var obj = {};
                config.components.forEach(function(label, i) {
                    obj[label] = parsed[i]
                });
                return obj;
            }

            clock.on('update.countdown', function(event) {
                let date = event.strftime(format);
                let data = strfobj(date);

                config.components.forEach(function(label) {
                    let $node = clock.find(`.${label}`);
                    $node.text(data[label]);
                });

                updateClockLabels(clock, config, event);
            });

            setupFinishCountdown(clock, config);
        }

        function setupCustomFormat(clock, config) {
            if (!config.custom_format) { return; }

            clock.on('update.countdown', function(event) {
                $(this).html(event.strftime(config.custom_format));
            });

            setupFinishCountdown(clock, config);
        }

        function setupFinishCountdown(clock, config) {
            clock.on('finish.countdown', function(event) {
                if (['stop', 'forward', 'script', 'html'].includes(config.finish_countdown)) {
                    $(this).parent().addClass('disabled');

                    switch (config.style) {
                        case 'flip_clock':
                            clock.find(".count").text("00");
                            break;
                        case 'block_clock':
                            clock.find(".time").text("00");
                            break;
                        case 'custom_format':
                            clock.html(event.strftime(config.custom_format));
                            break;
                    }
                }

                if ('forward' === config.finish_countdown && !window.et_builder_version) {
                    window.location.replace(config.forwarding_url);
                }

                if ('script' === config.finish_countdown && !window.et_builder_version) {
                    eval(config.script);
                }

                if ('html' === config.finish_countdown) {
                    clock.html(config.html);
                }
            });
        }

        function updateClockLabels(clock, config, event) {
            let $times = clock.find(".face .time");
            $times.each(function() {
                let $this = $(this);
                var format;
                if ($this.hasClass("weeks")) {
                    format = `%!w:${config["label_weeks"]};`;
                }
                if ($this.hasClass("days")) {
                    format = `%!d:${config["label_days"]};`;
                }
                if ($this.hasClass("hours")) {
                    format = `%!H:${config["label_hours"]};`;
                }
                if ($this.hasClass("minutes")) {
                    format = `%!M:${config["label_minutes"]};`;
                }
                if ($this.hasClass("seconds")) {
                    format = `%!S:${config["label_seconds"]};`;
                }
                $this.siblings(".label").text(event.strftime(format));
            });

        }

        function pluralizeLabels(config) {
            Object.entries(config)
                .forEach(([key, value]) => {
                    if (key.startsWith("label_") && !value.includes(",")) {
                        config[key] = `${value},${value}`;
                    }
                });
            return config;
        }

        function adjustCurrentDate(config) {
            if (config['date'] !== 'now') {
                return config;
            }

            if (config['use_cookie'] === true) {
                let cookie = getCookie(config['cookie_id']);
                if (cookie && '' !== cookie) {
                    config['date'] = cookie;
                    return config;
                }
            }

            var now = new Date();
            now.setTime(now.getTime() + (config['offset'] * 1000));

            let year = now.getFullYear().toString();
            let month = (now.getMonth() + 1).toString().padStart(2, '0');
            let day = (now.getDate()).toString().padStart(2, '0');
            let hour = (now.getHours()).toString().padStart(2, '0');
            let minute = (now.getMinutes()).toString().padStart(2, '0');
            let second = (now.getSeconds()).toString().padStart(2, '0');
            let dateString = `${year}-${month}-${day} ${hour}:${minute}:${second}`;

            config['date'] = dateString;

            if (config['use_cookie'] === true) {
                document.cookie = `${config['cookie_id']}=${dateString}`;
            }

            return config;
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    }
    if (!window.et_builder_version) {
        $(".dmpro_countdown .clock").each(function() {
            window.dmpro_countdown($(this));
        });
    }
})(jQuery);