(function() {
    'use strict';

    function extractVideoId(urlOrCode) {
        if (!urlOrCode) return '';
        var text = urlOrCode.trim();

        // Check if full iframe code is pasted
        var iframeMatch = text.match(/<iframe.*?src=["'](.*?)["']/i);
        if (iframeMatch && iframeMatch[1]) {
            text = iframeMatch[1];
        }

        // Standard patterns
        var regExp = /(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?|shorts)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i;
        var match = text.match(regExp);
        if (match && match[1]) {
            return match[1];
        }

        // If user entered just the 11-char ID
        if (/^[a-zA-Z0-9_-]{11}$/.test(text)) {
            return text;
        }

        return '';
    }

    function parseTime(timeStr) {
        if (!timeStr) return 0;
        var str = ('' + timeStr).trim().toLowerCase();

        // Format: 1h20m30s or 1m30s or 90s
        var h = 0, m = 0, s = 0;
        var hMatch = str.match(/(\d+)h/);
        var mMatch = str.match(/(\d+)m/);
        var sMatch = str.match(/(\d+)s/);

        if (hMatch || mMatch || sMatch) {
            if (hMatch) h = parseInt(hMatch[1], 10) || 0;
            if (mMatch) m = parseInt(mMatch[1], 10) || 0;
            if (sMatch) s = parseInt(sMatch[1], 10) || 0;
            return (h * 3600) + (m * 60) + s;
        }

        // Format: mm:ss or hh:mm:ss
        if (str.indexOf(':') !== -1) {
            var parts = str.split(':');
            if (parts.length === 2) {
                return (parseInt(parts[0], 10) || 0) * 60 + (parseInt(parts[1], 10) || 0);
            } else if (parts.length === 3) {
                return (parseInt(parts[0], 10) || 0) * 3600 + (parseInt(parts[1], 10) || 0) * 60 + (parseInt(parts[2], 10) || 0);
            }
        }

        return parseInt(str, 10) || 0;
    }

    function formatTime(seconds) {
        if (!seconds || seconds <= 0) return '';
        var m = Math.floor(seconds / 60);
        var s = seconds % 60;
        if (m === 0) return s + 's';
        return m + ':' + (s < 10 ? '0' : '') + s;
    }

    CKEDITOR.dialog.add('youtubeDialog', function(editor) {
        var lang = editor.lang.youtube || {};

        function updatePreview(dialog) {
            var url = dialog.getValueOf('general', 'txtUrl');
            var videoId = extractVideoId(url);
            var previewEl = document.getElementById('cke_youtube_preview_frame');
            var msgEl = document.getElementById('cke_youtube_preview_empty');

            if (videoId) {
                var previewSrc = 'https://www.youtube.com/embed/' + videoId + '?rel=0';
                if (previewEl) {
                    previewEl.src = previewSrc;
                    previewEl.style.display = 'block';
                }
                if (msgEl) {
                    msgEl.style.display = 'none';
                }
            } else {
                if (previewEl) {
                    previewEl.src = 'about:blank';
                    previewEl.style.display = 'none';
                }
                if (msgEl) {
                    msgEl.style.display = 'block';
                }
            }
        }

        return {
            title: lang.title || 'Chèn / Chỉnh sửa Video YouTube',
            minWidth: 500,
            minHeight: 400,
            contents: [
                {
                    id: 'general',
                    label: 'YouTube Video',
                    elements: [
                        {
                            type: 'text',
                            id: 'txtUrl',
                            label: lang.txtUrl || 'Đường dẫn (URL) hoặc mã nhúng Video YouTube:',
                            required: true,
                            validate: function() {
                                var val = this.getValue();
                                if (!val || !extractVideoId(val)) {
                                    alert(lang.invalidUrl || 'Đường dẫn YouTube không hợp lệ!');
                                    return false;
                                }
                                return true;
                            },
                            onKeyUp: function() {
                                updatePreview(this.getDialog());
                            },
                            onChange: function() {
                                updatePreview(this.getDialog());
                            }
                        },
                        {
                            type: 'checkbox',
                            id: 'chkResponsive',
                            label: lang.chkResponsive || 'Tự co giãn Responsive 16:9 (Đẹp trên mọi màn hình)',
                            'default': true,
                            onChange: function() {
                                var isResp = this.getValue();
                                var dialog = this.getDialog();
                                var wField = dialog.getContentElement('general', 'txtWidth');
                                var hField = dialog.getContentElement('general', 'txtHeight');
                                if (wField && hField) {
                                    if (isResp) {
                                        wField.disable();
                                        hField.disable();
                                    } else {
                                        wField.enable();
                                        hField.enable();
                                    }
                                }
                            }
                        },
                        {
                            type: 'hbox',
                            widths: ['33%', '33%', '34%'],
                            children: [
                                {
                                    type: 'text',
                                    id: 'txtWidth',
                                    label: lang.txtWidth || 'Chiều rộng (px):',
                                    'default': '640',
                                    onChange: function() {
                                        var val = parseInt(this.getValue(), 10);
                                        var hField = this.getDialog().getContentElement('general', 'txtHeight');
                                        if (val && hField && !isNaN(val)) {
                                            hField.setValue(Math.round(val * 9 / 16));
                                        }
                                    }
                                },
                                {
                                    type: 'text',
                                    id: 'txtHeight',
                                    label: lang.txtHeight || 'Chiều cao (px):',
                                    'default': '360'
                                },
                                {
                                    type: 'select',
                                    id: 'cmbAlign',
                                    label: lang.align || 'Căn lề:',
                                    'default': 'center',
                                    items: [
                                        [lang.alignCenter || 'Căn giữa', 'center'],
                                        [lang.alignLeft || 'Căn trái', 'left'],
                                        [lang.alignRight || 'Căn phải', 'right'],
                                        [lang.alignNone || 'Mặc định', 'none']
                                    ]
                                }
                            ]
                        },
                        {
                            type: 'hbox',
                            widths: ['50%', '50%'],
                            children: [
                                {
                                    type: 'checkbox',
                                    id: 'chkAutoplay',
                                    label: lang.chkAutoplay || 'Tự động phát (Autoplay)',
                                    'default': false
                                },
                                {
                                    type: 'checkbox',
                                    id: 'chkRel',
                                    label: lang.chkRel || 'Ẩn video liên quan từ kênh khác (rel=0)',
                                    'default': true
                                }
                            ]
                        },
                        {
                            type: 'hbox',
                            widths: ['50%', '50%'],
                            children: [
                                {
                                    type: 'checkbox',
                                    id: 'chkControls',
                                    label: lang.chkControls || 'Hiện thanh điều khiển video',
                                    'default': true
                                },
                                {
                                    type: 'text',
                                    id: 'txtStart',
                                    label: lang.txtStart || 'Bắt đầu từ (ví dụ: 01:30 hoặc 90):',
                                    'default': ''
                                }
                            ]
                        },
                        {
                            type: 'html',
                            id: 'htmlPreview',
                            html: '<div style="margin-top:12px;border:1px solid #ddd;border-radius:6px;background:#f9f9f9;padding:10px;text-align:center;">' +
                                  '  <div style="font-weight:600;margin-bottom:8px;color:#444;font-size:12px;text-align:left;">' + (lang.preview || 'Xem trước video:') + '</div>' +
                                  '  <div style="position:relative;width:100%;max-width:440px;height:248px;margin:0 auto;background:#000;border-radius:4px;overflow:hidden;display:flex;align-items:center;justify-content:center;">' +
                                  '    <iframe id="cke_youtube_preview_frame" style="width:100%;height:100%;border:0;display:none;" frameborder="0" allowfullscreen></iframe>' +
                                  '    <div id="cke_youtube_preview_empty" style="color:#aaa;font-size:12px;padding:20px;">' + (lang.noPreview || 'Dán đường dẫn YouTube ở trên để xem trước video tại đây') + '</div>' +
                                  '  </div>' +
                                  '</div>'
                        }
                    ]
                }
            ],
            onShow: function() {
                var dialog = this;
                dialog.selectedElement = null;
                var sel = editor.getSelection();
                var el = sel ? sel.getSelectedElement() : null;

                if (!el && sel) {
                    var range = sel.getRanges()[0];
                    if (range) {
                        el = range.getEnclosedNode();
                    }
                }

                var iframe = null;
                var wrapper = null;

                if (el) {
                    if (el.is('iframe') && el.getAttribute('src') && el.getAttribute('src').indexOf('youtube') !== -1) {
                        iframe = el;
                        wrapper = el.getParent();
                    } else if (el.is('div') && (el.hasClass('video-responsive') || el.hasClass('youtube-embed-wrapper'))) {
                        wrapper = el;
                        iframe = el.findOne('iframe');
                    } else {
                        var parentIframe = el.getAscendant('iframe', true);
                        if (parentIframe && parentIframe.getAttribute('src') && parentIframe.getAttribute('src').indexOf('youtube') !== -1) {
                            iframe = parentIframe;
                            wrapper = parentIframe.getParent();
                        }
                    }
                }

                if (iframe) {
                    dialog.selectedElement = wrapper || iframe;
                    var src = iframe.getAttribute('src') || '';
                    dialog.setValueOf('general', 'txtUrl', src);

                    var isResp = (wrapper && wrapper.hasClass('video-responsive')) || (!iframe.getAttribute('width') && iframe.getStyle('position') === 'absolute');
                    dialog.setValueOf('general', 'chkResponsive', isResp);

                    var w = iframe.getAttribute('width') || parseInt(iframe.getStyle('width'), 10) || 640;
                    var h = iframe.getAttribute('height') || parseInt(iframe.getStyle('height'), 10) || 360;
                    dialog.setValueOf('general', 'txtWidth', '' + w);
                    dialog.setValueOf('general', 'txtHeight', '' + h);

                    var align = 'center';
                    if (wrapper) {
                        var margin = wrapper.getStyle('margin') || '';
                        var textAlign = wrapper.getStyle('text-align') || '';
                        if (margin.indexOf('auto') !== -1 || textAlign === 'center') {
                            align = 'center';
                        } else if (textAlign === 'left' || margin.indexOf('0 auto 0 0') !== -1) {
                            align = 'left';
                        } else if (textAlign === 'right' || margin.indexOf('0 0 0 auto') !== -1) {
                            align = 'right';
                        }
                    }
                    dialog.setValueOf('general', 'cmbAlign', align);

                    // Parse query params
                    var hasAutoplay = src.indexOf('autoplay=1') !== -1;
                    var hasRel = src.indexOf('rel=0') !== -1 || src.indexOf('rel=') === -1;
                    var hasControls = src.indexOf('controls=0') === -1;
                    var startMatch = src.match(/[?&]start=(\d+)/);

                    dialog.setValueOf('general', 'chkAutoplay', hasAutoplay);
                    dialog.setValueOf('general', 'chkRel', hasRel);
                    dialog.setValueOf('general', 'chkControls', hasControls);
                    dialog.setValueOf('general', 'txtStart', startMatch ? formatTime(parseInt(startMatch[1], 10)) : '');
                } else {
                    dialog.setValueOf('general', 'txtUrl', '');
                    dialog.setValueOf('general', 'chkResponsive', true);
                    dialog.setValueOf('general', 'txtWidth', '640');
                    dialog.setValueOf('general', 'txtHeight', '360');
                    dialog.setValueOf('general', 'cmbAlign', 'center');
                    dialog.setValueOf('general', 'chkAutoplay', false);
                    dialog.setValueOf('general', 'chkRel', true);
                    dialog.setValueOf('general', 'chkControls', true);
                    dialog.setValueOf('general', 'txtStart', '');
                }

                var isRespNow = dialog.getValueOf('general', 'chkResponsive');
                var wField = dialog.getContentElement('general', 'txtWidth');
                var hField = dialog.getContentElement('general', 'txtHeight');
                if (wField && hField) {
                    if (isRespNow) {
                        wField.disable();
                        hField.disable();
                    } else {
                        wField.enable();
                        hField.enable();
                    }
                }

                setTimeout(function() {
                    updatePreview(dialog);
                }, 50);
            },
            onOk: function() {
                var dialog = this;
                var rawUrl = dialog.getValueOf('general', 'txtUrl');
                var videoId = extractVideoId(rawUrl);
                if (!videoId) return false;

                var isResp = dialog.getValueOf('general', 'chkResponsive');
                var width = parseInt(dialog.getValueOf('general', 'txtWidth'), 10) || 640;
                var height = parseInt(dialog.getValueOf('general', 'txtHeight'), 10) || 360;
                var align = dialog.getValueOf('general', 'cmbAlign') || 'center';
                var autoplay = dialog.getValueOf('general', 'chkAutoplay');
                var rel = dialog.getValueOf('general', 'chkRel');
                var controls = dialog.getValueOf('general', 'chkControls');
                var startVal = dialog.getValueOf('general', 'txtStart');
                var startSec = parseTime(startVal);

                var params = [];
                if (autoplay) {
                    params.push('autoplay=1');
                    params.push('mute=1'); // Modern browsers block unmuted autoplay
                }
                if (rel) {
                    params.push('rel=0');
                }
                if (!controls) {
                    params.push('controls=0');
                }
                if (startSec > 0) {
                    params.push('start=' + startSec);
                }
                params.push('enablejsapi=1');

                var embedSrc = 'https://www.youtube.com/embed/' + videoId + (params.length ? '?' + params.join('&') : '');

                var marginStyle = '15px auto';
                var alignStyle = 'text-align:center;';
                if (align === 'left') {
                    marginStyle = '15px auto 15px 0';
                    alignStyle = 'text-align:left;';
                } else if (align === 'right') {
                    marginStyle = '15px 0 15px auto';
                    alignStyle = 'text-align:right;';
                } else if (align === 'none') {
                    marginStyle = '15px 0';
                    alignStyle = '';
                }

                var html = '';
                if (isResp) {
                    html = '<div class="video-responsive youtube-embed-wrapper" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%;margin:' + marginStyle + ';' + alignStyle + '">' +
                           '  <iframe src="' + embedSrc + '" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="allowfullscreen"></iframe>' +
                           '</div>';
                } else {
                    html = '<div class="youtube-embed-wrapper" style="margin:' + marginStyle + ';' + alignStyle + '">' +
                           '  <iframe width="' + width + '" height="' + height + '" src="' + embedSrc + '" frameborder="0" style="border:0;max-width:100%;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="allowfullscreen"></iframe>' +
                           '</div>';
                }

                if (dialog.selectedElement) {
                    var newEl = CKEDITOR.dom.element.createFromHtml(html, editor.document);
                    newEl.replace(dialog.selectedElement);
                } else {
                    editor.insertHtml(html + '<p>&nbsp;</p>');
                }
            }
        };
    });
})();
