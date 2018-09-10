/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Global variables
var b2b = {
    url : '',
    urlParts : [],
    toolsEnabled : false,
    _commentNumber : 1,
    drawingToolsOn : false,
    canDraw : false,
    currentNode : {
        
    },
    result : {
        
    },
    data : {
        
    },
    draw : {
        startX : 0,
        startY : 0,
        endX : 0,
        endY : 0
    }
};

b2b.drawCommentHolder = function (rootElement, x, y, w, h, number, json) {

    var element = '';
    element = $('<div>', {
        class : 'commentMainHolder',
        css : {
            'top': x + 'px',
            'left': y + 'px',
            'position': 'absolute',
            'z-index' : 20000,
        }
    });
    
    // Holder
    element.append($('<span>', {
        class : 'commentHolder closed',
        css : {
            'cursor': 'pointer',
            'display': 'inline-block',
            'text-align': 'center',
            'line-height': '26px',
            'font-size': '18px',
            'font-weight': '700',
            '-webkit-border-radius': '18px',
            '-moz-border-radius': '18px',
            'border-radius': '18px',
            'width': '26px',
            'height': '26px',
            'position': 'relative',
            'top': '-18px',
            'left': '-18px',
            'border': '5px solid rgb(255, 184, 72)',
        },
        'text' : number
    }));
    
    // Rect
    element.append($('<div>', {
        class : 'rect',
        css : {
            'border': 0,
			/**
            'pointer-events': 'none',
            'top': 0,
            'left': 0,
			*/
            'width': w + 'px',
            'height': h + 'px',
            'position': 'relative',
            'top': '-35px',
        }
    }));

    // Comments
    var commentHolder = $('<div>');
    var parentComment = $('<div>');
    parentComment.append('\
        <div class="commentDeetailsHead">\n\
            <div class="pullLeft">' + json.User.Profile.firstname + ' ' + json.User.Profile.surname + '</div>\n\
            <div class="pullRight">' + json.created + '</div>\n\
            <div class="clearfix"></div>\n\
        </div>\n\
        <p>' + json.comment + '</p>\n\
    ');
    commentHolder.append(parentComment);

    if (typeof json.ProjectMockupComment !== 'undefined') {
        $.each(json.ProjectMockupComment, function (key, val) {
            var subComment = $('<div>');
            subComment.append('\
                <div class="commentDeetailsHead">\n\
					<div class="pullLeft">' + json.User.Profile.firstname + ' ' + json.User.Profile.surname + '</div>\n\
                    <div class="pullRight">' + val.created + '</div>\n\
                    <div class="clearfix"></div>\n\
                </div>\n\
                <p>' + val.comment + '</p>\n\
            ');
            commentHolder.append(subComment);
        });
    }
    commentHolder.append($('<div>', {
        html : $('<textarea>', {
            'data-parent-id' : json.id,
            'class' : 'sendSubComment'
        })
    }));

    element.append($('<div>', {
        class : 'commentsList',
        css : {
            'display': 'none',
            'border': '1px solid #CCC',
            'background-color' : '#FFF',
            'padding': '10px',
            'top': '-' + (h + 36) + 'px',
            'left': (w + 5) + 'px',
            'position': 'relative'
        },
        html : commentHolder
    }));
    rootElement.append(element);
};

b2b.getMockupDetails = function () {
    return $.ajax({
        url: '/project_mockups/project_mockups/api_get.json',
        data: {
            ProjectMockup: {
                client_project_id: b2b.urlParts[4],
                version: b2b.urlParts[5]
            }
        }
    });
};

b2b.addComment = function (data) {
    return $.ajax({
        url: '/project_mockups/project_mockup_comments/api_add.json',
        data: data
    });
};

b2b.getMockupData = function () {
    return $.ajax({
        url: '/project_mockups/project_mockups/api_get_data.json',
        data: {
            ProjectMockup: {
                client_project_id: b2b.urlParts[4],
                version: b2b.urlParts[5]
            }
        }
    });
};

b2b.getUserCredentials = function () {
    return $.ajax({
        url: '/project_mockups/project_mockups/api_get_user_credentials.json',
    });
};

b2b.showCommentsList = function (elem) {
	elem.removeClass('closed');
	elem.addClass('opened');
    elem.parent().find('.rect').css({'border' : '1px solid rgba(125, 125, 125, 0.3)'});
    elem.parent().find('.rect').css({'background-color' : 'rgba(125, 125, 125, 0.15)'});
    elem.parent().find('.commentsList').show();
};

b2b.hideCommentsList = function (elem) {
	elem.removeClass('opened');
	elem.addClass('closed');
    elem.parent().find('.rect').css({'border' : '0'});
    elem.parent().find('.rect').css({'background-color' : 'transparent'});
    elem.parent().find('.commentsList').hide();
};

$(function () {

    $(document).on('keydown', 'textarea', function (e) {
        if (e.keyCode === 13) {
            if ($(this).attr('data-parent-id')) {
                var data = {
                    comment : $(this).val(),
                    parent_id : $(this).attr('data-parent-id')
                };
            } else {
                var data = {
                    position : $(this).next().val(),
                    comment : $(this).val(),
                    project_mockup_node_id : b2b.currentNode.id
                };
            }
            b2b.addComment(data).success(function (response) {
                console.log('--------------------------');
                console.log('Comment added');
                console.log(response);
                console.log('--------------------------');
                location.reload();
            });
            return false;
        }
    });

    $(document).on('click', '.commentHolder', function () {
    //$('#mainFrame').on('click', '.commentHolder', function () {
		if ($(this).hasClass('closed')) {
			// Open
			b2b.showCommentsList($(this));
		} else {
			// Close
			b2b.hideCommentsList($(this));
		}
        //b2b.showCommentsList($(this));
        return false;
    });

});
