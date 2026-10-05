(function() {
    'use strict';

    CKEDITOR.plugins.add('youtube', {
        lang: 'en,vi',
        icons: 'youtube',
        init: function(editor) {
            var pluginPath = this.path;

            editor.addCommand('youtube', new CKEDITOR.dialogCommand('youtubeDialog', {
                allowedContent: 'div{*}(*); iframe[*]{*}; p'
            }));

            editor.ui.addButton('Youtube', {
                label: (editor.lang.youtube && editor.lang.youtube.button) || 'Chèn video YouTube',
                command: 'youtube',
                toolbar: 'insert,99',
                icon: pluginPath + 'images/icon.svg'
            });

            CKEDITOR.dialog.add('youtubeDialog', pluginPath + 'dialogs/youtube.js');

            // Context menu & double click support
            if (editor.addMenuItems) {
                editor.addMenuGroup('youtubeGroup');
                editor.addMenuItem('youtubeItem', {
                    label: (editor.lang.youtube && editor.lang.youtube.title) || 'Chỉnh sửa Video YouTube',
                    command: 'youtube',
                    group: 'youtubeGroup',
                    icon: pluginPath + 'images/icon.svg'
                });
            }

            if (editor.contextMenu) {
                editor.contextMenu.addListener(function(element) {
                    if (!element) return null;
                    if (element.is('iframe') && element.getAttribute('src') && element.getAttribute('src').indexOf('youtube') !== -1) {
                        return { youtubeItem: CKEDITOR.TRISTATE_OFF };
                    }
                    if (element.is('div') && (element.hasClass('video-responsive') || element.hasClass('youtube-embed-wrapper'))) {
                        return { youtubeItem: CKEDITOR.TRISTATE_OFF };
                    }
                    var pIframe = element.getAscendant('iframe', true);
                    if (pIframe && pIframe.getAttribute('src') && pIframe.getAttribute('src').indexOf('youtube') !== -1) {
                        return { youtubeItem: CKEDITOR.TRISTATE_OFF };
                    }
                });
            }

            editor.on('doubleclick', function(evt) {
                var element = evt.data.element;
                if (!element) return;
                if ((element.is('iframe') && element.getAttribute('src') && element.getAttribute('src').indexOf('youtube') !== -1) ||
                    (element.is('div') && (element.hasClass('video-responsive') || element.hasClass('youtube-embed-wrapper')))) {
                    evt.data.dialog = 'youtubeDialog';
                }
            });
        }
    });
})();
