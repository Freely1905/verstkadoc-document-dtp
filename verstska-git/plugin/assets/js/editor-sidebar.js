/* global VDContentEditor */
(function (wp) {
    'use strict';

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var registerPlugin = wp.plugins.registerPlugin;
    var PluginSidebar = wp.editor.PluginSidebar;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var useSelect = wp.data.useSelect;
    var useDispatch = wp.data.useDispatch;

    var textFields = [
        ['home_eyebrow', 'Eyebrow', false],
        ['home_title', 'Заголовок', false],
        ['home_lead', 'Описание', true],
        ['home_cta', 'Основная кнопка', false],
        ['home_secondary', 'Вторая кнопка', false],
        ['home_note', 'Примечание', true],
        ['doc_kicker', 'Надпись на документе', false],
        ['doc_title', 'Заголовок на документе', true],
        ['services_eyebrow', 'Услуги — надзаголовок', false],
        ['services_title', 'Услуги — заголовок', false],
        ['services_intro', 'Услуги — описание', true],
        ['process_eyebrow', 'Процесс — надзаголовок', false],
        ['process_title', 'Процесс — заголовок', false],
        ['process_intro', 'Процесс — описание', true],
        ['audience_eyebrow', 'Кому — надзаголовок', false],
        ['audience_title', 'Кому — заголовок', false],
        ['cases_eyebrow', 'Кейсы — надзаголовок', false],
        ['cases_title', 'Кейсы — заголовок', false],
        ['cases_all', 'Ссылка «Все кейсы»', false],
        ['quote_eyebrow', 'Заявка — надзаголовок', false],
        ['quote_title', 'Заявка — заголовок', true],
        ['quote_text', 'Заявка — описание', true],
        ['quote_cta', 'Заявка — кнопка', false],
        ['quote_box_title', 'Блок «Что полезно сообщить» — заголовок', false],
        ['quote_box_text', 'Блок «Что полезно сообщить» — текст', true],
        ['more', 'Ссылка «Подробнее»', false]
    ];

    function cloneMeta(meta) {
        return Object.assign({}, meta || {});
    }

    function updateMeta(editPost, meta, key, value) {
        var next = cloneMeta(meta);
        next[key] = value;
        editPost({ meta: next });
    }

    function StepEditor(props) {
        var steps = Array.isArray(props.steps) ? props.steps : [];
        return el(
            PanelBody,
            { title: 'Рабочий процесс', initialOpen: false },
            steps.map(function (step, index) {
                return el(
                    'div',
                    { key: index, style: { borderTop: index ? '1px solid #ddd' : '0', paddingTop: index ? '12px' : '0', marginTop: index ? '12px' : '0' } },
                    el(TextControl, {
                        label: 'Шаг ' + (index + 1),
                        value: step.number || '',
                        onChange: function (value) {
                            var next = steps.slice();
                            next[index] = Object.assign({}, next[index], { number: value });
                            props.onChange(next);
                        }
                    }),
                    el(TextControl, {
                        label: 'Заголовок',
                        value: step.title || '',
                        onChange: function (value) {
                            var next = steps.slice();
                            next[index] = Object.assign({}, next[index], { title: value });
                            props.onChange(next);
                        }
                    }),
                    el(TextareaControl, {
                        label: 'Описание',
                        value: step.summary || '',
                        onChange: function (value) {
                            var next = steps.slice();
                            next[index] = Object.assign({}, next[index], { summary: value });
                            props.onChange(next);
                        }
                    })
                );
            })
        );
    }

    function AudienceEditor(props) {
        var items = Array.isArray(props.items) ? props.items : [];
        return el(
            PanelBody,
            { title: 'Кому', initialOpen: false },
            items.map(function (item, index) {
                return el(
                    'div',
                    { key: index, style: { borderTop: index ? '1px solid #ddd' : '0', paddingTop: index ? '12px' : '0', marginTop: index ? '12px' : '0' } },
                    el(TextControl, {
                        label: 'Надзаголовок',
                        value: item.eyebrow || '',
                        onChange: function (value) {
                            var next = items.slice();
                            next[index] = Object.assign({}, next[index], { eyebrow: value });
                            props.onChange(next);
                        }
                    }),
                    el(TextControl, {
                        label: 'Заголовок',
                        value: item.title || '',
                        onChange: function (value) {
                            var next = items.slice();
                            next[index] = Object.assign({}, next[index], { title: value });
                            props.onChange(next);
                        }
                    }),
                    el(TextareaControl, {
                        label: 'Описание',
                        value: item.summary || '',
                        onChange: function (value) {
                            var next = items.slice();
                            next[index] = Object.assign({}, next[index], { summary: value });
                            props.onChange(next);
                        }
                    }),
                    el(TextControl, {
                        label: 'Кнопка',
                        value: item.button || '',
                        onChange: function (value) {
                            var next = items.slice();
                            next[index] = Object.assign({}, next[index], { button: value });
                            props.onChange(next);
                        }
                    }),
                    el(TextControl, {
                        label: 'URL',
                        value: item.url || '',
                        onChange: function (value) {
                            var next = items.slice();
                            next[index] = Object.assign({}, next[index], { url: value });
                            props.onChange(next);
                        }
                    })
                );
            })
        );
    }

    function Sidebar() {
        var postId = useSelect(function (select) {
            return select('core/editor').getCurrentPostId();
        }, []);

        var meta = useSelect(function (select) {
            return select('core/editor').getEditedPostAttribute('meta') || {};
        }, []);

        var editPost = useDispatch('core/editor').editPost;

        if (!window.VDContentEditor || String(postId) !== String(window.VDContentEditor.homePageId)) {
            return null;
        }

        return el(
            PluginSidebar,
            {
                name: 'verstkadoc-content',
                title: 'VERSTKADOC',
                icon: 'media-document'
            },
            el(
                PanelBody,
                { title: 'Содержимое главной', initialOpen: true },
                textFields.map(function (field) {
                    var key = '_vd_home_' + field[0];
                    var value = meta[key] !== undefined ? meta[key] : '';
                    var props = {
                        label: field[1],
                        value: value,
                        onChange: function (nextValue) {
                            updateMeta(editPost, meta, key, nextValue);
                        }
                    };
                    if (field[2]) {
                        props.rows = 4;
                        return el(TextareaControl, Object.assign({ key: field[0] }, props));
                    }
                    return el(TextControl, Object.assign({ key: field[0] }, props));
                })
            ),
            el(StepEditor, {
                steps: meta['_vd_home_steps'] || [],
                onChange: function (value) {
                    updateMeta(editPost, meta, '_vd_home_steps', value);
                }
            }),
            el(AudienceEditor, {
                items: meta['_vd_home_audiences'] || [],
                onChange: function (value) {
                    updateMeta(editPost, meta, '_vd_home_audiences', value);
                }
            })
        );
    }

    registerPlugin('verstkadoc-content', { render: Sidebar });
})(window.wp);
