<?php
/**
 * Plugin Name: VERSTKADOC Content
 * Plugin URI: https://verstkadoc.com/
 * Description: Content layer for the VERSTKADOC custom theme: homepage fields, Services, Cases and editable site settings.
 * Version: 0.1.0
 * Author: VERSTKADOC
 * License: GPL-2.0-or-later
 * Text Domain: verstkadoc-content
 */

defined( 'ABSPATH' ) || exit;

define( 'VD_CONTENT_VERSION', '0.1.0' );

if ( ! function_exists( 'vd_is_russian' ) ) {
    function vd_is_russian() {
        $locale = determine_locale();
        return 0 === strpos( strtolower( $locale ), 'ru' );
    }
}

function vd_register_post_types() {
    $service_slug = vd_is_russian() ? 'uslugi' : 'services';
    $case_slug    = vd_is_russian() ? 'portfolio' : 'cases';

    register_post_type(
        'vd_service',
        array(
            'labels' => array(
                'name'               => vd_is_russian() ? 'Услуги' : 'Services',
                'singular_name'      => vd_is_russian() ? 'Услуга' : 'Service',
                'add_new'            => vd_is_russian() ? 'Добавить услугу' : 'Add service',
                'add_new_item'       => vd_is_russian() ? 'Добавить услугу' : 'Add service',
                'edit_item'          => vd_is_russian() ? 'Редактировать услугу' : 'Edit service',
                'new_item'           => vd_is_russian() ? 'Новая услуга' : 'New service',
                'view_item'          => vd_is_russian() ? 'Просмотреть услугу' : 'View service',
                'search_items'       => vd_is_russian() ? 'Искать услуги' : 'Search services',
                'not_found'          => vd_is_russian() ? 'Услуги не найдены' : 'No services found',
                'menu_name'          => vd_is_russian() ? 'Услуги' : 'Services',
            ),
            'public'              => true,
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-media-document',
            'has_archive'         => true,
            'rewrite'             => array( 'slug' => $service_slug, 'with_front' => false ),
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
            'show_in_nav_menus'   => true,
        )
    );

    register_post_type(
        'vd_case',
        array(
            'labels' => array(
                'name'               => vd_is_russian() ? 'Кейсы' : 'Cases',
                'singular_name'      => vd_is_russian() ? 'Кейс' : 'Case',
                'add_new'            => vd_is_russian() ? 'Добавить кейс' : 'Add case',
                'add_new_item'       => vd_is_russian() ? 'Добавить кейс' : 'Add case',
                'edit_item'          => vd_is_russian() ? 'Редактировать кейс' : 'Edit case',
                'new_item'           => vd_is_russian() ? 'Новый кейс' : 'New case',
                'view_item'          => vd_is_russian() ? 'Просмотреть кейс' : 'View case',
                'search_items'       => vd_is_russian() ? 'Искать кейсы' : 'Search cases',
                'not_found'          => vd_is_russian() ? 'Кейсы не найдены' : 'No cases found',
                'menu_name'          => vd_is_russian() ? 'Кейсы' : 'Cases',
            ),
            'public'              => true,
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-portfolio',
            'has_archive'         => true,
            'rewrite'             => array( 'slug' => $case_slug, 'with_front' => false ),
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
            'show_in_nav_menus'   => true,
        )
    );
}
add_action( 'init', 'vd_register_post_types' );

function vd_get_site_settings() {
    $defaults = vd_is_russian()
        ? array(
            'brand_tag'            => 'Document DTP',
            'footer_description'   => 'DTP / document formatting для переводческих и локализационных компаний. Вёрстка, восстановление документов и мультиязычное форматирование.',
            'footer_sections_title'=> 'Разделы',
            'footer_work_title'    => 'Работа',
            'contact_email'        => '',
        )
        : array(
            'brand_tag'            => 'Document DTP',
            'footer_description'   => 'DTP / document formatting for translation and localization companies. Layout, document reconstruction and multilingual formatting.',
            'footer_sections_title'=> 'Sections',
            'footer_work_title'    => 'Work',
            'contact_email'        => '',
        );

    $saved = get_option( 'vd_site_settings', array() );
    return wp_parse_args( is_array( $saved ) ? $saved : array(), $defaults );
}

function vd_get_site_setting( $key, $default = '' ) {
    $settings = vd_get_site_settings();
    return isset( $settings[ $key ] ) && '' !== $settings[ $key ] ? $settings[ $key ] : $default;
}

function vd_home_page_id() {
    $page_id = absint( get_option( 'page_on_front' ) );
    return $page_id > 0 ? $page_id : 0;
}

function vd_get_home_text( $key, $default = '' ) {
    $page_id = vd_home_page_id();
    if ( ! $page_id ) {
        return $default;
    }

    $value = get_post_meta( $page_id, '_vd_home_' . sanitize_key( $key ), true );
    return '' !== $value ? $value : $default;
}

function vd_get_home_steps() {
    $defaults = vd_is_russian()
        ? array(
            array( 'number' => '01', 'title' => 'Исходник', 'summary' => 'PDF, Word, InDesign, графика или CAD.' ),
            array( 'number' => '02', 'title' => 'Перевод', 'summary' => 'Перевод готовит Ваш переводчик или LSP.' ),
            array( 'number' => '03', 'title' => 'DTP', 'summary' => 'Восстанавливаю и адаптирую макет.' ),
            array( 'number' => '04', 'title' => 'Проверка', 'summary' => 'Проверяю страницы, таблицы, графику и текст.' ),
            array( 'number' => '05', 'title' => 'Результат', 'summary' => 'Готовый документ в согласованном формате.' ),
        )
        : array(
            array( 'number' => '01', 'title' => 'Source', 'summary' => 'PDF, Word, InDesign, graphics or CAD.' ),
            array( 'number' => '02', 'title' => 'Translation', 'summary' => 'Translation is prepared by your translator or LSP.' ),
            array( 'number' => '03', 'title' => 'DTP', 'summary' => 'I reconstruct and adapt the layout.' ),
            array( 'number' => '04', 'title' => 'QA', 'summary' => 'I check pages, tables, graphics and text.' ),
            array( 'number' => '05', 'title' => 'Result', 'summary' => 'Finished document in the agreed format.' ),
        );

    $page_id = vd_home_page_id();
    $saved   = $page_id ? get_post_meta( $page_id, '_vd_home_steps', true ) : array();
    return is_array( $saved ) && ! empty( $saved ) ? $saved : $defaults;
}

function vd_get_home_audiences() {
    $defaults = vd_is_russian()
        ? array(
            array( 'eyebrow' => '01 · B2B / LSP', 'title' => 'Для бюро переводов и локализации', 'summary' => 'White-label DTP как часть производственного процесса. Вы передаёте задачу — я возвращаю готовый документ.', 'button' => 'Как это работает', 'url' => '' ),
            array( 'eyebrow' => '02 · Direct', 'title' => 'Для прямых заказчиков', 'summary' => 'Вы ставите задачу по документу, а перевод выполняет Ваш переводчик или переводческое агентство.', 'button' => 'Для прямых заказчиков', 'url' => '' ),
        )
        : array(
            array( 'eyebrow' => '01 · B2B / LSP', 'title' => 'For translation and localization agencies', 'summary' => 'White-label DTP as part of your production workflow. You send the task — I return the finished document.', 'button' => 'How it works', 'url' => '' ),
            array( 'eyebrow' => '02 · Direct', 'title' => 'For direct clients', 'summary' => 'You commission the document work while translation is handled by your translator or translation agency.', 'button' => 'For direct clients', 'url' => '' ),
        );

    $page_id = vd_home_page_id();
    $saved   = $page_id ? get_post_meta( $page_id, '_vd_home_audiences', true ) : array();
    if ( ! is_array( $saved ) || empty( $saved ) ) {
        $saved = $defaults;
    }

    foreach ( $saved as $index => $item ) {
        if ( empty( $item['url'] ) ) {
            $saved[ $index ]['url'] = 0 === $index
                ? vd_find_page_url( vd_is_russian() ? 'dlya-byuro-perevodov' : 'for-translation-agencies' )
                : vd_find_page_url( vd_is_russian() ? 'dlya-pryamyh-zakazchikov' : 'for-direct-clients' );
        }
    }

    return $saved;
}

function vd_get_summary( $post_id, $default = '' ) {
    $value = get_post_meta( $post_id, '_vd_summary', true );
    if ( '' !== $value ) {
        return $value;
    }

    $excerpt = get_post_field( 'post_excerpt', $post_id );
    return '' !== $excerpt ? $excerpt : $default;
}

function vd_get_case_meta( $post_id, $default = '' ) {
    $value = get_post_meta( $post_id, '_vd_case_meta', true );
    return '' !== $value ? $value : $default;
}

function vd_find_page_url( $slug ) {
    $page = get_page_by_path( trim( $slug, '/' ), OBJECT, 'page' );
    if ( $page instanceof WP_Post ) {
        $url = get_permalink( $page );
        if ( $url ) {
            return $url;
        }
    }

    return home_url( '/' . trim( $slug, '/' ) . '/' );
}

function vd_get_services() {
    $query = new WP_Query(
        array(
            'post_type'      => 'vd_service',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
            'no_found_rows'  => true,
        )
    );

    $items = array();
    $number = 1;
    foreach ( $query->posts as $post ) {
        $number_value = get_post_meta( $post->ID, '_vd_number', true );
        $items[] = array(
            'number'  => $number_value ? $number_value : $number,
            'title'   => get_the_title( $post ),
            'summary' => vd_get_summary( $post->ID ),
            'url'     => get_permalink( $post ),
        );
        $number++;
    }

    wp_reset_postdata();
    return $items;
}

function vd_get_cases() {
    $query = new WP_Query(
        array(
            'post_type'      => 'vd_case',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
            'no_found_rows'  => true,
        )
    );

    $items = array();
    foreach ( $query->posts as $post ) {
        $items[] = array(
            'meta'    => vd_get_case_meta( $post->ID, vd_is_russian() ? 'Кейс' : 'Case' ),
            'title'   => get_the_title( $post ),
            'summary' => vd_get_summary( $post->ID ),
            'url'     => get_permalink( $post ),
        );
    }

    wp_reset_postdata();
    return $items;
}

function vd_home_meta_defaults() {
    if ( vd_is_russian() ) {
        return array(
            'home_eyebrow'        => 'VERSTKADOC · DTP / DOCUMENT FORMATTING',
            'home_title'          => 'Вёрстка документов для перевода и локализации',
            'home_lead'           => 'Подготовка, восстановление и форматирование документов для переводческих агентств, локализационных компаний и прямых корпоративных заказчиков.',
            'home_cta'            => 'Рассчитать стоимость',
            'home_secondary'      => 'Посмотреть услуги',
            'home_note'           => 'InDesign · Photoshop · Illustrator · CorelDRAW · AutoCAD · КОМПАС · SolidWorks · MicroStation. PDF, сканы и сложная многоязычная вёрстка.',
            'doc_kicker'          => 'Multilingual technical document',
            'doc_title'           => "Document layout\nafter translation",
            'services_eyebrow'    => 'Что делаю',
            'services_title'     => 'От PDF до готового многоязычного документа',
            'services_intro'      => 'Сохранить структуру и визуальную логику исходного документа после перевода — даже когда исходник неудобен для редактирования.',
            'process_eyebrow'    => 'Рабочий процесс',
            'process_title'      => 'Просто передайте документ',
            'process_intro'      => 'Проектная работа и white-label сотрудничество с переводческими компаниями.',
            'audience_eyebrow'   => 'Кому',
            'audience_title'     => 'Два сценария работы',
            'cases_eyebrow'      => 'Примеры задач',
            'cases_title'        => 'Типичные проекты',
            'cases_all'          => 'Все кейсы →',
            'quote_eyebrow'      => 'Получить оценку',
            'quote_title'        => 'Есть PDF, перевод и дедлайн? Давайте посмотрим на задачу.',
            'quote_text'         => 'Для первичной оценки достаточно описания проекта и, по возможности, примера исходного документа.',
            'quote_cta'          => 'Описать проект',
            'quote_box_title'    => 'Что полезно сообщить',
            'quote_box_text'     => 'Тип документа · языки · объём · исходный формат · наличие исходных файлов · срок · требования к макету.',
            'more'               => 'Подробнее →',
            'direct_clients_label'=> 'Для прямых заказчиков',
        );
    }

    return array(
        'home_eyebrow'        => 'VERSTKADOC · DOCUMENT DTP / MULTILINGUAL FORMATTING',
        'home_title'          => 'Document DTP for translation and localization',
        'home_lead'           => 'Document preparation, reconstruction, and multilingual formatting for translation agencies, localization companies, and direct corporate clients.',
        'home_cta'            => 'Get a quote',
        'home_secondary'      => 'View services',
        'home_note'           => 'InDesign · Photoshop · Illustrator · CorelDRAW · AutoCAD · KOMPAS · SolidWorks · MicroStation. PDFs, scans, RTL and complex multilingual layouts.',
        'doc_kicker'          => 'Multilingual technical document',
        'doc_title'           => "Document layout\nafter translation",
        'services_eyebrow'    => 'What I do',
        'services_title'     => 'From PDF to a finished multilingual document',
        'services_intro'      => 'Preserving the structure and visual logic of the source document after translation — even when the source is difficult to edit.',
        'process_eyebrow'    => 'Workflow',
        'process_title'      => 'Just send the document',
        'process_intro'      => 'Project work and white-label cooperation with translation companies.',
        'audience_eyebrow'   => 'Who it is for',
        'audience_title'     => 'Two ways to work together',
        'cases_eyebrow'      => 'Typical projects',
        'cases_title'        => 'Examples of the work',
        'cases_all'          => 'All cases →',
        'quote_eyebrow'      => 'Get an estimate',
        'quote_title'        => 'Have a PDF, translated text and a deadline? Let’s look at the task.',
        'quote_text'         => 'For an initial estimate, a short project description and, where possible, an example of the source document are enough.',
        'quote_cta'          => 'Describe the project',
        'quote_box_title'    => 'Useful information',
        'quote_box_text'     => 'Document type · languages · volume · source format · source files available · deadline · layout requirements.',
        'more'               => 'Read more →',
        'direct_clients_label'=> 'For direct clients',
    );
}

function vd_seed_home_content() {
    $page_id = vd_home_page_id();
    if ( ! $page_id ) {
        return;
    }

    $defaults = vd_home_meta_defaults();
    foreach ( $defaults as $key => $value ) {
        $meta_key = '_vd_home_' . $key;
        if ( '' === get_post_meta( $page_id, $meta_key, true ) ) {
            update_post_meta( $page_id, $meta_key, $value );
        }
    }

    if ( ! get_post_meta( $page_id, '_vd_home_steps', true ) ) {
        update_post_meta( $page_id, '_vd_home_steps', vd_is_russian() ? array(
            array( 'number' => '01', 'title' => 'Исходник', 'summary' => 'PDF, Word, InDesign, графика или CAD.' ),
            array( 'number' => '02', 'title' => 'Перевод', 'summary' => 'Перевод готовит Ваш переводчик или LSP.' ),
            array( 'number' => '03', 'title' => 'DTP', 'summary' => 'Восстанавливаю и адаптирую макет.' ),
            array( 'number' => '04', 'title' => 'Проверка', 'summary' => 'Проверяю страницы, таблицы, графику и текст.' ),
            array( 'number' => '05', 'title' => 'Результат', 'summary' => 'Готовый документ в согласованном формате.' ),
        ) : array(
            array( 'number' => '01', 'title' => 'Source', 'summary' => 'PDF, Word, InDesign, graphics or CAD.' ),
            array( 'number' => '02', 'title' => 'Translation', 'summary' => 'Translation is prepared by your translator or LSP.' ),
            array( 'number' => '03', 'title' => 'DTP', 'summary' => 'I reconstruct and adapt the layout.' ),
            array( 'number' => '04', 'title' => 'QA', 'summary' => 'I check pages, tables, graphics and text.' ),
            array( 'number' => '05', 'title' => 'Result', 'summary' => 'Finished document in the agreed format.' ),
        ) );
    }

    if ( ! get_post_meta( $page_id, '_vd_home_audiences', true ) ) {
        update_post_meta( $page_id, '_vd_home_audiences', vd_is_russian() ? array(
            array( 'eyebrow' => '01 · B2B / LSP', 'title' => 'Для бюро переводов и локализации', 'summary' => 'White-label DTP как часть производственного процесса. Вы передаёте задачу — я возвращаю готовый документ.', 'button' => 'Как это работает', 'url' => '' ),
            array( 'eyebrow' => '02 · Direct', 'title' => 'Для прямых заказчиков', 'summary' => 'Вы ставите задачу по документу, а перевод выполняет Ваш переводчик или переводческое агентство.', 'button' => 'Для прямых заказчиков', 'url' => '' ),
        ) : array(
            array( 'eyebrow' => '01 · B2B / LSP', 'title' => 'For translation and localization agencies', 'summary' => 'White-label DTP as part of your production workflow. You send the task — I return the finished document.', 'button' => 'How it works', 'url' => '' ),
            array( 'eyebrow' => '02 · Direct', 'title' => 'For direct clients', 'summary' => 'You commission the document work while translation is handled by your translator or translation agency.', 'button' => 'For direct clients', 'url' => '' ),
        ) );
    }
}

function vd_seed_services() {
    if ( get_posts( array( 'post_type' => 'vd_service', 'post_status' => 'any', 'numberposts' => 1, 'fields' => 'ids' ) ) ) {
        return;
    }

    $items = vd_is_russian()
        ? array(
            array( 'Вёрстка после перевода', 'Перенос переведённого текста в существующую структуру документа.', 'verstka-posle-perevoda' ),
            array( 'Восстановление PDF', 'Редактируемая реконструкция сложного PDF и сканов с сохранением исходного вида.', 'vosstanovlenie-pdf' ),
            array( 'Техническая документация', 'Руководства, инструкции, каталоги, отчёты и инженерные документы.', 'tehnicheskaya-dokumentatsiya' ),
            array( 'CAD и чертежи', 'Локализация больших комплектов AutoCAD, КОМПАС, SolidWorks и MicroStation.', 'lokalizatsiya-chertezhey-autocad' ),
            array( 'Arabic / RTL', 'Арабский, фарси, иврит и смешанные RTL/LTR-документы.', 'arabskaya-vertska-rtl' ),
            array( 'Корпоративные документы', 'Финансовая и корпоративная отчётность и деловые публикации.', 'korporativnaya-finansovaya-dokumentatsiya' ),
            array( 'Книги и каталоги', 'Каталоги, брошюры и большие публикации до 500+ страниц.', 'knigi-katalogi-broshury' ),
            array( 'Нестандартные задачи', 'Когда типовой конвертер не справляется и макет приходится восстанавливать вручную.', 'nestandartnye-zadachi' ),
        )
        : array(
            array( 'DTP after translation', 'Placing translated text back into an existing document structure.', 'dtp-after-translation' ),
            array( 'PDF reconstruction', 'Editable reconstruction of complex PDFs and scans while preserving the source appearance.', 'pdf-reconstruction' ),
            array( 'Technical documentation', 'Manuals, instructions, catalogs, reports and engineering documents.', 'technical-documentation' ),
            array( 'CAD drawing localization', 'Large AutoCAD, KOMPAS, SolidWorks and MicroStation drawing sets.', 'cad-drawing-localization' ),
            array( 'Arabic / RTL', 'Arabic, Persian, Hebrew and mixed RTL/LTR documents.', 'arabic-rtl-dtp' ),
            array( 'Corporate documents', 'Financial, corporate and business documentation.', 'corporate-documents' ),
            array( 'Books and catalogs', 'Catalogs, brochures and long-form publications.', 'books-catalogs-brochures' ),
            array( 'Non-standard jobs', 'When an automated converter is not enough and the layout needs manual reconstruction.', 'non-standard-jobs' ),
        );

    foreach ( $items as $index => $item ) {
        $post_id = wp_insert_post( array(
            'post_type'   => 'vd_service',
            'post_status' => 'publish',
            'post_title'  => $item[0],
            'post_name'   => $item[2],
            'post_excerpt'=> $item[1],
            'menu_order'  => $index + 1,
        ), true );
        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_vd_number', $index + 1 );
            update_post_meta( $post_id, '_vd_summary', $item[1] );
        }
    }
}

function vd_seed_cases() {
    if ( get_posts( array( 'post_type' => 'vd_case', 'post_status' => 'any', 'numberposts' => 1, 'fields' => 'ids' ) ) ) {
        return;
    }

    $items = vd_is_russian()
        ? array(
            array( 'Large publication', 'Книга 500+ страниц', 'Восстановление и многоязычная вёрстка большого документа.' ),
            array( 'Engineering', 'До 300 чертежей', 'Массовая локализация комплектов технических чертежей.' ),
            array( 'RTL', 'Arabic / Persian / Hebrew', 'Документы с RTL, смешанными направлениями и таблицами.' ),
        )
        : array(
            array( 'Large publication', '500+ page book', 'Reconstruction and multilingual DTP of a large document.' ),
            array( 'Engineering', 'Up to 300 drawings', 'Mass localization of technical drawing sets.' ),
            array( 'RTL', 'Arabic / Persian / Hebrew', 'Documents with RTL, mixed directionality and tables.' ),
        );

    foreach ( $items as $index => $item ) {
        $post_id = wp_insert_post( array(
            'post_type'   => 'vd_case',
            'post_status' => 'publish',
            'post_title'  => $item[1],
            'post_name'   => sanitize_title( $item[1] ),
            'post_excerpt'=> $item[2],
            'menu_order'  => $index + 1,
        ), true );
        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_vd_case_meta', $item[0] );
            update_post_meta( $post_id, '_vd_summary', $item[2] );
        }
    }
}

function vd_migrate_theme_settings() {
    $settings = get_option( 'vd_site_settings', array() );
    $legacy_email = get_theme_mod( 'verstkadoc_email', '' );
    if ( empty( $settings['contact_email'] ) && $legacy_email ) {
        $settings['contact_email'] = sanitize_email( $legacy_email );
    }

    if ( empty( $settings['brand_tag'] ) ) {
        $settings['brand_tag'] = 'Document DTP';
    }

    update_option( 'vd_site_settings', $settings, false );
}

function vd_seed_starter_content() {
    vd_seed_home_content();
    vd_seed_services();
    vd_seed_cases();
    vd_migrate_theme_settings();
}

function vd_activate() {
    vd_register_post_types();
    vd_seed_starter_content();
    update_option( 'vd_content_seeded', 1, false );
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'vd_activate' );

function vd_maybe_seed_after_activation() {
    if ( get_option( 'vd_content_seeded', 0 ) ) {
        return;
    }

    vd_seed_starter_content();
    update_option( 'vd_content_seeded', 1, false );
}
add_action( 'admin_init', 'vd_maybe_seed_after_activation' );

function vd_home_meta_box() {
    $page_id = vd_home_page_id();
    if ( ! $page_id ) {
        return;
    }

    add_meta_box(
        'vd_home_content',
        vd_is_russian() ? 'VERSTKADOC — содержимое главной' : 'VERSTKADOC — Home Content',
        'vd_render_home_meta_box',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes_page', 'vd_home_meta_box' );

function vd_text_input( $name, $value, $label, $textarea = false, $rows = 3 ) {
    echo '<p><label for="' . esc_attr( $name ) . '"><strong>' . esc_html( $label ) . '</strong></label><br>';
    if ( $textarea ) {
        echo '<textarea class="widefat" rows="' . esc_attr( $rows ) . '" id="' . esc_attr( $name ) . '" name="vd_home[' . esc_attr( $name ) . ']">' . esc_textarea( $value ) . '</textarea>';
    } else {
        echo '<input class="widefat" type="text" id="' . esc_attr( $name ) . '" name="vd_home[' . esc_attr( $name ) . ']" value="' . esc_attr( $value ) . '">';
    }
    echo '</p>';
}

function vd_render_home_meta_box( $post ) {
    wp_nonce_field( 'vd_home_save', 'vd_home_nonce' );
    $defaults = vd_home_meta_defaults();
    echo '<p>' . esc_html( vd_is_russian() ? 'Эти поля относятся только к главной странице. Они хранятся в базе данных и не исчезнут при обновлении темы.' : 'These fields belong to the front page. They are stored in the database and will survive theme updates.' ) . '</p>';

    echo '<hr><h3>' . esc_html( vd_is_russian() ? 'Первый экран' : 'Hero' ) . '</h3>';
    foreach ( array( 'home_eyebrow', 'home_title', 'home_lead', 'home_cta', 'home_secondary', 'home_note', 'doc_kicker', 'doc_title' ) as $key ) {
        $value = get_post_meta( $post->ID, '_vd_home_' . $key, true );
        $value = '' !== $value ? $value : $defaults[ $key ];
        vd_text_input( $key, $value, $key === 'home_eyebrow' ? 'Eyebrow' : ucwords( str_replace( '_', ' ', $key ) ), in_array( $key, array( 'home_lead', 'home_note', 'doc_title' ), true ), $key === 'home_note' ? 4 : 3 );
    }

    echo '<hr><h3>' . esc_html( vd_is_russian() ? 'Услуги' : 'Services' ) . '</h3>';
    foreach ( array( 'services_eyebrow', 'services_title', 'services_intro' ) as $key ) {
        $value = get_post_meta( $post->ID, '_vd_home_' . $key, true );
        $value = '' !== $value ? $value : $defaults[ $key ];
        vd_text_input( $key, $value, ucwords( str_replace( '_', ' ', $key ) ), 'services_intro' === $key, 3 );
    }

    echo '<hr><h3>' . esc_html( vd_is_russian() ? 'Процесс' : 'Workflow' ) . '</h3>';
    foreach ( array( 'process_eyebrow', 'process_title', 'process_intro' ) as $key ) {
        $value = get_post_meta( $post->ID, '_vd_home_' . $key, true );
        $value = '' !== $value ? $value : $defaults[ $key ];
        vd_text_input( $key, $value, ucwords( str_replace( '_', ' ', $key ) ), 'process_intro' === $key, 3 );
    }

    $steps = get_post_meta( $post->ID, '_vd_home_steps', true );
    if ( ! is_array( $steps ) || empty( $steps ) ) {
        $steps = vd_get_home_steps();
    }
    echo '<h4>' . esc_html( vd_is_russian() ? 'Пять шагов' : 'Five steps' ) . '</h4>';
    echo '<table class="widefat striped"><thead><tr><th>№</th><th>' . esc_html( vd_is_russian() ? 'Заголовок' : 'Title' ) . '</th><th>' . esc_html( vd_is_russian() ? 'Описание' : 'Description' ) . '</th></tr></thead><tbody>';
    foreach ( $steps as $i => $step ) {
        echo '<tr><td><input type="text" name="vd_steps[' . esc_attr( $i ) . '][number]" value="' . esc_attr( $step['number'] ) . '" class="small-text"></td><td><input type="text" name="vd_steps[' . esc_attr( $i ) . '][title]" value="' . esc_attr( $step['title'] ) . '" class="widefat"></td><td><input type="text" name="vd_steps[' . esc_attr( $i ) . '][summary]" value="' . esc_attr( $step['summary'] ) . '" class="widefat"></td></tr>';
    }
    echo '</tbody></table>';

    echo '<hr><h3>' . esc_html( vd_is_russian() ? 'Кому' : 'Audience' ) . '</h3>';
    foreach ( vd_get_home_audiences() as $i => $item ) {
        echo '<h4>' . sprintf( esc_html( vd_is_russian() ? 'Блок %d' : 'Block %d' ), $i + 1 ) . '</h4>';
        foreach ( array( 'eyebrow', 'title', 'summary', 'button', 'url' ) as $field ) {
            $label = ucwords( str_replace( '_', ' ', $field ) );
            $value = isset( $item[ $field ] ) ? $item[ $field ] : '';
            echo '<p><label><strong>' . esc_html( $label ) . '</strong></label><br><input class="widefat" type="text" name="vd_audiences[' . esc_attr( $i ) . '][' . esc_attr( $field ) . ']" value="' . esc_attr( $value ) . '"></p>';
        }
    }

    echo '<hr><h3>' . esc_html( vd_is_russian() ? 'Кейсы и заявка' : 'Cases and quote' ) . '</h3>';
    foreach ( array( 'audience_eyebrow', 'audience_title', 'cases_eyebrow', 'cases_title', 'cases_all', 'quote_eyebrow', 'quote_title', 'quote_text', 'quote_cta', 'quote_box_title', 'quote_box_text', 'more', 'direct_clients_label' ) as $key ) {
        $value = get_post_meta( $post->ID, '_vd_home_' . $key, true );
        $value = '' !== $value ? $value : $defaults[ $key ];
        vd_text_input( $key, $value, ucwords( str_replace( '_', ' ', $key ) ), in_array( $key, array( 'quote_title', 'quote_text', 'quote_box_text' ), true ), 3 );
    }
}

function vd_save_home_meta( $post_id ) {
    if ( ! isset( $_POST['vd_home_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['vd_home_nonce'] ) ), 'vd_home_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }
    if ( absint( get_option( 'page_on_front' ) ) !== absint( $post_id ) ) {
        return;
    }

    if ( isset( $_POST['vd_home'] ) && is_array( $_POST['vd_home'] ) ) {
        foreach ( $_POST['vd_home'] as $key => $value ) {
            update_post_meta( $post_id, '_vd_home_' . sanitize_key( $key ), sanitize_textarea_field( wp_unslash( $value ) ) );
        }
    }

    if ( isset( $_POST['vd_steps'] ) && is_array( $_POST['vd_steps'] ) ) {
        $steps = array();
        foreach ( $_POST['vd_steps'] as $step ) {
            $steps[] = array(
                'number'  => isset( $step['number'] ) ? sanitize_text_field( wp_unslash( $step['number'] ) ) : '',
                'title'   => isset( $step['title'] ) ? sanitize_text_field( wp_unslash( $step['title'] ) ) : '',
                'summary' => isset( $step['summary'] ) ? sanitize_textarea_field( wp_unslash( $step['summary'] ) ) : '',
            );
        }
        update_post_meta( $post_id, '_vd_home_steps', $steps );
    }

    if ( isset( $_POST['vd_audiences'] ) && is_array( $_POST['vd_audiences'] ) ) {
        $audiences = array();
        foreach ( $_POST['vd_audiences'] as $item ) {
            $audiences[] = array(
                'eyebrow' => isset( $item['eyebrow'] ) ? sanitize_text_field( wp_unslash( $item['eyebrow'] ) ) : '',
                'title'   => isset( $item['title'] ) ? sanitize_text_field( wp_unslash( $item['title'] ) ) : '',
                'summary' => isset( $item['summary'] ) ? sanitize_textarea_field( wp_unslash( $item['summary'] ) ) : '',
                'button'  => isset( $item['button'] ) ? sanitize_text_field( wp_unslash( $item['button'] ) ) : '',
                'url'     => isset( $item['url'] ) ? esc_url_raw( wp_unslash( $item['url'] ) ) : '',
            );
        }
        update_post_meta( $post_id, '_vd_home_audiences', $audiences );
    }
}
add_action( 'save_post_page', 'vd_save_home_meta' );

function vd_admin_menu() {
    add_options_page(
        vd_is_russian() ? 'VERSTKADOC — Контент' : 'VERSTKADOC — Content',
        'VERSTKADOC',
        'manage_options',
        'vd-content-settings',
        'vd_render_settings_page'
    );
}
add_action( 'admin_menu', 'vd_admin_menu' );

function vd_register_settings() {
    register_setting( 'vd_content_settings', 'vd_site_settings', array( 'sanitize_callback' => 'vd_sanitize_settings' ) );
}
add_action( 'admin_init', 'vd_register_settings' );

function vd_sanitize_settings( $input ) {
    $input = is_array( $input ) ? $input : array();
    return array(
        'brand_tag'             => isset( $input['brand_tag'] ) ? sanitize_text_field( $input['brand_tag'] ) : '',
        'footer_description'    => isset( $input['footer_description'] ) ? sanitize_textarea_field( $input['footer_description'] ) : '',
        'footer_sections_title' => isset( $input['footer_sections_title'] ) ? sanitize_text_field( $input['footer_sections_title'] ) : '',
        'footer_work_title'     => isset( $input['footer_work_title'] ) ? sanitize_text_field( $input['footer_work_title'] ) : '',
        'contact_email'         => isset( $input['contact_email'] ) ? sanitize_email( $input['contact_email'] ) : '',
    );
}

function vd_render_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    $settings = vd_get_site_settings();
    ?>
    <div class="wrap">
        <h1>VERSTKADOC</h1>
        <p><?php echo esc_html( vd_is_russian() ? 'Глобальные редактируемые данные сайта. Эти значения хранятся в базе WordPress и не зависят от темы.' : 'Global editable site data. These values live in the WordPress database and are independent of the theme.' ); ?></p>
        <form method="post" action="options.php">
            <?php settings_fields( 'vd_content_settings' ); ?>
            <table class="form-table" role="presentation">
                <tr><th scope="row"><label for="vd-brand-tag">Brand tag</label></th><td><input id="vd-brand-tag" class="regular-text" type="text" name="vd_site_settings[brand_tag]" value="<?php echo esc_attr( $settings['brand_tag'] ); ?>"></td></tr>
                <tr><th scope="row"><label for="vd-footer-description">Footer description</label></th><td><textarea id="vd-footer-description" class="large-text" rows="4" name="vd_site_settings[footer_description]"><?php echo esc_textarea( $settings['footer_description'] ); ?></textarea></td></tr>
                <tr><th scope="row"><label for="vd-footer-sections">Footer — Sections</label></th><td><input id="vd-footer-sections" class="regular-text" type="text" name="vd_site_settings[footer_sections_title]" value="<?php echo esc_attr( $settings['footer_sections_title'] ); ?>"></td></tr>
                <tr><th scope="row"><label for="vd-footer-work">Footer — Work</label></th><td><input id="vd-footer-work" class="regular-text" type="text" name="vd_site_settings[footer_work_title]" value="<?php echo esc_attr( $settings['footer_work_title'] ); ?>"></td></tr>
                <tr><th scope="row"><label for="vd-contact-email">Contact e-mail</label></th><td><input id="vd-contact-email" class="regular-text" type="email" name="vd_site_settings[contact_email]" value="<?php echo esc_attr( $settings['contact_email'] ); ?>"></td></tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function vd_settings_link( $links ) {
    $url = admin_url( 'options-general.php?page=vd-content-settings' );
    array_unshift( $links, '<a href="' . esc_url( $url ) . '">' . esc_html( vd_is_russian() ? 'Настройки' : 'Settings' ) . '</a>' );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'vd_settings_link' );
