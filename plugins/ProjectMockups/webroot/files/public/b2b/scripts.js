/* global b2b */

var mainWindow = {};
var overlay = {};
var paper = {};
var toolBox = {};
var infoBox = {};

(function () {

    $(function () {

        // Add tool box
        toolBox = $('<div>', {
			class: 'toolBox',
            html : '<a href class="turnOnMockupTool"><span class="fa fa-crop sb-icon"></span></a>',
        });
		infoBox = $('<div>', {
			class: 'infoBox',
			css : {
				'display' : 'none',
			},
            html : '<span>Zaznacz obszar, który chcesz skomentowac</span>',
        });
        $('body').append(toolBox);
        $('body').append(infoBox);
    });

    $(function () {
        var _mainFrame = $('iframe#mainFrame');

        _mainFrame.load(function () {

            mainWindow = $(this).contents().find('body');
            overlay = $('<div>', {
                id: 'baseOverlay',
                css: {
                    'position' : 'absolute',
                    'height' : $(this).contents().height(),
                    'width' : $(this).contents().width(),
                }
            });
            // Draw points
			
            setTimeout(function () {
				b2b.getMockupData().done(function (result) {
					b2b.data = result;
					b2b._commentNumber = 1;

					// Draw
					$.each(b2b.data.ProjectMockupNode, function (key, val) {
						if (key === b2b.url) {
							b2b.currentNode = val;
							$.each(val.ProjectMockupComment, function (comments_key, comments_val) {
								b2b.drawCommentHolder
								(
									overlay,
									comments_val.position.top, 
									comments_val.position.left, 
									comments_val.position.width, 
									comments_val.position.height, 
									b2b._commentNumber++,
									comments_val
								);
							});
						}
					});
				});
			}, 200);

            $(this).contents().find('head').append('<link rel="stylesheet" type="text/css" href="../../../public/b2b/styles.css"></link>');
            mainWindow.append(overlay);

            setTimeout(function () {

                /**
                 * Add comment
                 */
                $('iframe#mainFrame').contents().find('.commentMainHolder textarea').keydown(function (e) {
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
                                location.reload();
                            });
                            return false;
                        }
                    });

                    /**
                     * Open/close comment box
                     */
                    $('iframe#mainFrame').contents().find('.commentHolder').click(function () {
                        if ($(this).hasClass('closed')) {
                            // Open
                            b2b.showCommentsList($(this));
                        } else {
                            // Close
                            b2b.hideCommentsList($(this));
                        }
                        return false;
                    });
            }, 500);

            paper = new Paper($('iframe#mainFrame').contents().find('#baseOverlay'), {});
        });
    });

    function mainFrameOnload() {

        $('.commentMainHolder').each(function () {
            $(this).remove();
        });

    };

    $(function () {

        b2b.getUserCredentials().done(function (result) {
            if (result.toolsEnabled) {
                b2b.toolsEnabled = true;
            }
        });

        $axure.page.bind('load.start', mainFrameOnload);

        // Needs to be fired to get this working
        // @todo - find ?$axure function that does the same
        setTimeout(function () {

            // Default url
            b2b.url = window.location.href.split('#p=')[1] + '.html';
            b2b.urlParts = window.location.pathname.split('/');

            // Change html structure
            $('#interfaceControlFrameMinimizeContainer').remove();
            $('#interfaceControlFrameHeaderContainer').remove();
            $('#sitemapToolbar').remove();
            $('#leftPanel').width(400);
            $('#rightPanel').width($(window).width() - $('#leftPanel').width());
            $('#rightPanel').css({left : $('#leftPanel').width() + 'px'});
            $('.vsplitbar').css({left : $('#leftPanel').width() - 3 + 'px'});

            $('#interfaceControlFrame').prepend('<div class="sb-header">\n\
                <div class="pull-left">\n\
                    <a href="#"><img src="b2b/img/logo_feb.png"></a>\n\
                </div>\n\
                <div class="pull-left sb-title">\n\
                    <div>MODUŁ MAKIETOWANIA</div>\n\
                    <div class="pull-left sb-subtitle">\n\
                        <a href="/project_mockups/project_mockups/index/' + b2b.urlParts[4] + '/">powrót do listy makiet</a>\n\
                    </div>\n\
                </div>\n\
                <div class="clearfix"></div>\n\
            </div>');

            b2b.getMockupData().done(function (result) {
                console.log('Done');
                b2b.data = result;

                if (b2b.data.toolsEnabled) {

                    // Find each link
                    $('.sitemapPageLink').each(function () {
                        // Has nodeurl attribute
                        var attribute = $(this).attr('nodeurl');
                        if (attribute) {

                            // Comments
                            var spanCommentToll = $('<span>', {
                                'class' : 'fa fa-comments-o commentMockupToll',
                            });
                            $(this).parent().append(spanCommentToll);

                            // Comments count
                            var spanComments = $('<span>', {
                                'class' : 'commentsCount',
                                'data-mockup-node' : attribute,
                                'text' : b2b.data.ProjectMockupNode[attribute].ProjectMockupComment.length,
                                'title' : 'Liczba komentarzy',
                            });
                            $(this).parent().append(spanComments);

                            // Accept button
                            var spanAccept = $('<span>', {
                                'class' : 'fa fa-thumbs-up acceptThisMockupNode' + (b2b.data.ProjectMockupNode[attribute].accepted ? ' selected' : ''),
                                'data-mockup-node' : attribute,
                                'data-mockup-node-id' : b2b.data.ProjectMockupNode[attribute].id,
                                'data-mockup-accepted' : b2b.data.ProjectMockupNode[attribute].accepted,
                                'title' : 'Akceptuję',
                            });
                            $(this).parent().append(spanAccept);

                            // Reject button
                            var spanReject = $('<span>', {
                                'class' : 'fa fa-thumbs-down rejectThisMockupNode' + (b2b.data.ProjectMockupNode[attribute].accepted ? '' : ' selected'),
                                'data-mockup-node' : attribute,
                                'data-mockup-node-id' : b2b.data.ProjectMockupNode[attribute].id,
                                'data-mockup-accepted' : b2b.data.ProjectMockupNode[attribute].accepted,
                                'title' : 'Odrzucam',
                            });
                            $(this).parent().append(spanReject);

                        }
                    });
                }
                // endif
            });

        }, 200);

        $('body').on('click', '.infoBox', function () {
			$('.infoBox').hide();
		});
		
        $('body').on('click', '.sitemapPageLink', function () {
            var attribute = $(this).attr('nodeurl');
            if (attribute) {
                b2b.url = attribute;
            }
        });

        $('body').on('click', '.turnOnMockupTool', function () {
            if (!b2b.drawingToolsOn) {
                // Trun tools on
                b2b.drawingToolsOn = true;
                $(this).addClass('selected');

                // Hide all opened comments lists
                // $('.commentHolder').each(function () {
                $('.infoBox').show();
				setTimeout(function () {
					$('.infoBox').hide();
				}, 3000);
				
                $('iframe#mainFrame').contents().find('.commentHolder').each(function () {
                    b2b.hideCommentsList($(this));
                });
            } else {
                // Trun tools on
                b2b.drawingToolsOn = false;
                $(this).removeClass('selected');
            }
			return false;
        });

        $('body').on('click', '.acceptThisMockupNode', function () {
            $.ajax({
                context: this,
                url: '/project_mockups/project_mockups/api_accept.json',
                data: {
                    ProjectMockupNode: {
                        id: $(this).attr('data-mockup-node-id'),
                        accepted: 1,
                    }
                }
            }).done(function (result) {
                $(this).addClass('selected');
                $(this).next('.rejectThisMockupNode').removeClass('selected');
				return false;
            }).fail(function () {
                console.log('%cFail', 'background-color: red; color: white; padding: 2px;');
            });
			return false;
        });

        $('body').on('click', '.rejectThisMockupNode', function () {
            $.ajax({
                context: this,
                url: '/project_mockups/project_mockups/api_accept.json',
                data: {
                    ProjectMockupNode: {
                        id: $(this).attr('data-mockup-node-id'),
                        accepted: 0,
                    }
                }
            }).done(function (result) {
                $(this).addClass('selected');
                $(this).prev('.acceptThisMockupNode').removeClass('selected');
				return false;
            }).fail(function () {
                console.log('%cFail', 'background-color: red; color: white; padding: 2px;');
            });
			return false;
        });

    });

})();