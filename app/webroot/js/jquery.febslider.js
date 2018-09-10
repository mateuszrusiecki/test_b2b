/*!
 * jQuery FebSlider Widget
 * Copyright (c) 2012 Sławomir Jach
 * Version: 1.0
 * Requires: jQuery v1.3.2 or later, jQueryUI Slider
 */
$.widget( "ui.febslider", {
    options: {
        slider: {
            range: true,
            min: 0,
            max: 100,
            values: [6, 19],
            selfRange: [null, null]
        },
        inFrom: {
        },
        inTo: {
        }
    },

    _create: function() {
        var $widget = this;
        var $slider = $widget.element.slider($widget.options.slider);

        $widget.options.slider.values[0] = $widget.options.slider.selfRange[0] || $widget.options.slider.values[0];
        $widget.options.slider.values[1] = $widget.options.slider.selfRange[1] || $widget.options.slider.values[1];
        $widget.options.inFrom.value = $widget.options.slider.values[0];
        $widget.from = $('<input></input>').attr($widget.options.inFrom);
        $widget.from.data('cacheValue', $widget.options.inFrom.value);
        
        $widget.from.bind('change', function(e){
            var val = parseFloat($(this).attr('value'));
            var _min = $widget.options.slider.selfRange[0] || $widget.options.slider.min;
            var _max = $widget.options.slider.selfRange[1] || $widget.options.slider.max;
            
            if (val > _max || val < _min) {
                $(this).attr('value', $(this).data('cacheValue'));
                e.preventDefault(); 
                return false;
            }
            if (val > $slider.slider('values', 1)) {
                $(this).attr('value', $(this).data('cacheValue'));
                e.preventDefault(); 
                return false;
            }         
            
            $(this).data('cacheValue', val);
            $slider.slider('values', 0, val);
        });
        
        $widget.element.after($widget.from);
        $widget.options.inTo.value = $widget.options.slider.values[1];
        $widget.to = $('<input></input>').attr($widget.options.inTo);
        $widget.to.data('cacheValue', $widget.options.inTo.value);
        
        $widget.to.bind('change', function(e){
            var val = parseFloat($(this).attr('value'));
            
            var _min = $widget.options.slider.selfRange[0] || $widget.options.slider.min;
            var _max = $widget.options.slider.selfRange[1] || $widget.options.slider.max;
            
            if (val > _max || val < _min) {
                $(this).attr('value', $(this).data('cacheValue'));
                e.preventDefault(); 
                return false;
            }
            
            if (val < $slider.slider('values', 0)) {
                $(this).attr('value', $(this).data('cacheValue'));
                e.preventDefault(); 
                return false;
            }
            
            $(this).data('cacheValue', val);
            $slider.slider('values', 1, val);
        });
        
        $widget.from.after($widget.to);
        $slider.bind("slide", function(event, ui) {
            
            var _min = $widget.options.slider.selfRange[0] || $widget.options.slider.min;

            if (ui.values[0] < _min) {
                event.preventDefault();
                return false;
            }
            
            var _max = $widget.options.slider.selfRange[1] || $widget.options.slider.max;
            
            if (ui.values[1] > _max) {
                event.preventDefault();
                return false;
            }
            
            $widget.from.attr('value', ui.values[0]);
            $widget.to.attr('value', ui.values[1]);
        });
    },
    
    values: function( values ) {
        var $widget = this;
        $slider = $widget.element;
        $widget.from.attr('value', values[0]);
        $widget.to.attr('value', values[1]);
        $slider.slider('values', values);
    },
    
    destroy: function() {
        var $widget = this;
        $slider = $widget.element;
        $slider.slider('destroy');
        $widget.from.remove();
        $widget.to.remove();
    },
    
    _setOptions: function() {
        $.Widget.prototype._setOptions.apply( this, arguments );
    },
    
    _setOption: function( key, value ) {
        $.Widget.prototype._setOption.call( this, key, value );
    }
});