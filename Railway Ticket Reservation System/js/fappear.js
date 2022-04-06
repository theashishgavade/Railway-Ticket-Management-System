/*
 * jQuery.fappear
 * https://github.com/bas2k/jquery.fappear/
 * http://code.google.com/p/jquery-fappear/
 *
 * Copyright (c) 2009 Michael Hixson
 * Copyright (c) 2012 Alexander Brovikov
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
 */
(function ($) {
    $.fn.fappear = function (fn, options) {

        var settings = $.extend({

            //arbitrary data to pass to fn
            data: undefined,

            //call fn only on the first fappear?
            one: true,

            // X & Y accuracy
            accX: 0,
            accY: 0

        }, options);

        return this.each(function () {

            var t = $(this);

            //whether the element is currently visible
            t.fappeared = false;

            if (!fn) {

                //trigger the custom event
                t.trigger('fappear', settings.data);
                return;
            }

            var w = $(window);

            //fires the fappear event when appropriate
            var check = function () {

                //is the element hidden?
                if (!t.is(':visible')) {

                    //it became hidden
                    t.fappeared = false;
                    return;
                }

                //is the element inside the visible window?
                var a = w.scrollLeft();
                var b = w.scrollTop();
                var o = t.offset();
                var x = o.left;
                var y = o.top;

                var ax = settings.accX;
                var ay = settings.accY;
                var th = t.height();
                var wh = w.height();
                var tw = t.width();
                var ww = w.width();

                if (y + th + ay >= b &&
                    y <= b + wh + ay &&
                    x + tw + ax >= a &&
                    x <= a + ww + ax) {

                    //trigger the custom event
                    if (!t.fappeared) t.trigger('fappear', settings.data);

                } else {

                    //it scrolled out of view
                    t.fappeared = false;
                }
            };

            //create a modified fn with some additional logic
            var modifiedFn = function () {

                //mark the element as visible
                t.fappeared = true;

                //is this supposed to happen only once?
                if (settings.one) {

                    //remove the check
                    w.unbind('scroll', check);
                    var i = $.inArray(check, $.fn.fappear.checks);
                    if (i >= 0) $.fn.fappear.checks.splice(i, 1);
                }

                //trigger the original fn
                fn.apply(this, arguments);
            };

            //bind the modified fn to the element
            if (settings.one) t.one('fappear', settings.data, modifiedFn);
            else t.bind('fappear', settings.data, modifiedFn);

            //check whenever the window scrolls
            w.scroll(check);

            //check whenever the dom changes
            $.fn.fappear.checks.push(check);

            //check now
            (check)();
        });
    };

    //keep a queue of fappearance checks
    $.extend($.fn.fappear, {

        checks: [],
        timeout: null,

        //process the queue
        checkAll: function () {
            var length = $.fn.fappear.checks.length;
            if (length > 0) while (length--) ($.fn.fappear.checks[length])();
        },

        //check the queue asynchronously
        run: function () {
            if ($.fn.fappear.timeout) clearTimeout($.fn.fappear.timeout);
            $.fn.fappear.timeout = setTimeout($.fn.fappear.checkAll, 20);
        }
    });

    //run checks when these methods are called
    $.each(['append', 'prepend', 'after', 'before', 'attr',
        'removeAttr', 'addClass', 'removeClass', 'toggleClass',
        'remove', 'css', 'show', 'hide'], function (i, n) {
        var old = $.fn[n];
        if (old) {
            $.fn[n] = function () {
                var r = old.apply(this, arguments);
                $.fn.fappear.run();
                return r;
            }
        }
    });

})(jQuery);


(function ($) {
    $.fn.countTo = function (options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function () {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null,  // callback method for when the element finishes updating
    };
})(jQuery);	