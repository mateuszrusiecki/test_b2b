/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global can, b2b */

var Paper = can.Control(
    {
        defaults: {
            rect: {
                minWidth: 5,
                minHeight: 5
            }
        }
    },
    {
    /**
     * Initialize
     */
    init: function () {

        // Bind event handlers
        this.element.on('mousedown.paper', $.proxy(this.startDrawRect, this));
    },
    /**
     * Start drawing a rectangle
     *
     * @param   e
     */
    startDrawRect: function (e) {

        // Get canvas offset
        var offset = this.element.offset();
        this.canvasOffsetLeft = offset.left;
        this.canvasOffsetTop = offset.top;

        // Save start positions
        this.drawStartX = e.pageX - this.canvasOffsetLeft;
        this.drawStartY = e.pageY - this.canvasOffsetTop;

        // Create the rectangle
        this.drawingRect = this.createRect(this.drawStartX, this.drawStartY, 0, 0);

        // Bind event handlers
        this.element.on('mousemove.paper', $.proxy(this.drawRect, this));
        this.element.on('mouseup.paper', $.proxy(this.endDrawRect, this));
    },
    /**
     * Draw the rectangle
     *
     * @param   e
     */
    drawRect: function (e) {

        var currentX = e.pageX - this.canvasOffsetLeft;
        var currentY = e.pageY - this.canvasOffsetTop;

        // Calculate the position and size of the rectangle we are drawing
        var position = this.calculateRectPos(this.drawStartX, this.drawStartY, currentX, currentY);

        // Set position and size
        if (typeof this.drawingRect !== 'undefined') {
            this.drawingRect.css(position);
        }
    },
    /**
     * Finish drawing the rectangle
     *
     * @param   e
     */
    endDrawRect: function (e) {

        var currentX = e.pageX - this.canvasOffsetLeft;
        var currentY = e.pageY - this.canvasOffsetTop;

        // Calculate the position and size of the rectangle we are drawing
        var position = this.calculateRectPos(this.drawStartX, this.drawStartY, currentX, currentY);

        if (position.width < this.options.rect.minWidth || position.height < this.options.rect.minHeight) {

            // The drawn rectangle is too small, remove it
            if (typeof this.drawingRect !== 'undefined') {
                this.drawingRect.remove();
            } else {
                return false;
            }
            
            return false;
        }
        else {
            if (typeof this.drawingRect !== 'undefined') {
                // Set position and size
                this.drawingRect.css(position);

                // The rectangle is big enough, select it
                this.selectRect(this.drawingRect);
            } else {
                return false;
            }
        }

        // Unbind event handlers
        this.element.off('mousemove.paper');
        this.element.off('mouseup.paper');

        //
        console.log('Add comment');

        var commentBox = $('<div>', {
            'class' : 'addCommentBox',
            'css' : {
                'width' : '400px',
                'height' : '30px',
                'position' : 'relative',
                'left' : (position.width) + 'px',
            }
        })
        .append($('<input>', {
            'name' : 'comment'
        }))
        .append($('<input>', {
            'type' : 'hidden',
            'name' : 'position',
            'value' : JSON.stringify(position)
        }));

		// keydown
		commentBox.find('input').bind('keydown', function (e) {
			if (e.keyCode === 13) {
				var data = {
					position : $(this).next().val(),
					comment : $(this).val(),
					project_mockup_node_id : b2b.currentNode.id
				};
				b2b.addComment(data).success(function (response) {
					location.reload();
				});
				return false;
			}
		});
		//console.log(commentBox.find('textarea'));
		//console.log('commentBox');
		//console.log(commentBox);
		//console.log('commentBox');

        if (typeof this.drawingRect !== 'undefined') {
            this.drawingRect.html('');
            this.drawingRect.append(commentBox);
            b2b.drawingToolsOn = false;
        }
    },
    /**
     * Create a rectangle
     *
     * @param   x
     * @param   y
     * @param   w
     * @param   h
     */
    createRect: function (x, y, w, h) {

        if (!b2b.drawingToolsOn) {
            console.log('Cannot draw');
        } else {
            console.log('Can draw');

            return $('<div/>').addClass('rect').css({
				'background-color' : 'rgba(125, 125, 125, 0.15)',
                left: x,
                top: y,
                width: w,
                height: h
            }).appendTo(this.element);
        }
    },
    /**
     * Select the given rectangle
     *
     * @param   rect
     */
    selectRect: function (rect) {

        // Deselect the previous selected rectangle
        this.selectedRect && this.selectedRect.removeClass('selected');

        // Select the given rectangle
        this.selectedRect = rect;
        this.selectedRect.addClass('selected');
    },
    /**
     * Calculate the start position and size of the rectangle by the mouse coordinates
     *
     * @param   startX
     * @param   startY
     * @param   endX
     * @param   endY
     * @returns {*}
     */
    calculateRectPos: function (startX, startY, endX, endY) {

        var width = endX - startX;
        var height = endY - startY;
        var posX = startX;
        var posY = startY;

        if (width < 0) {
            width = Math.abs(width);
            posX -= width;
        }

        if (height < 0) {
            height = Math.abs(height);
            posY -= height;
        }

        return {
            left: posX,
            top: posY,
            width: width,
            height: height
        };
    }
});
