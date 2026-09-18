<?php
/**
 * Reusable template helpers.
 */

defined( 'ABSPATH' ) || exit;

function verstkadoc_is_russian() {
    $locale = determine_locale();
    return 0 === strpos( strtolower( $locale ), 'ru' );
}

function verstkadoc_text( $key ) {
    $ru = array(
        'brand_tag'        => 'Document DTP',
        'menu_home'        => 'Услуги',
        'menu_agencies'    => 'Для бюро',
        'menu_cases'       => 'Кейсы',
        'menu_about'       => 'Обо мне',
        'menu_knowledge'   => 'База знаний',
        'menu_contact'     => 'Контакты',
        'menu_quote'       => 'Рассчитать стоимость',
        'home_eyebrow'     => 'VERSTKADOC · DTP / DOCUMENT FORMATTING',
        'home_title'       => 'Вёрстка документов для перевода и локализации',
        'home_lead'        => 'Подготовка, восстановление и форматирование документов для переводческих агентств, локализационных компаний и прямых корпоративных заказчиков.',
        'home_cta'         => 'Рассчитать стоимость',
        'home_secondary'   => 'Посмотреть услуги',
        'home_note'        => 'InDesign · Photoshop · Illustrator · CorelDRAW · AutoCAD · КОМПАС · SolidWorks · MicroStation. PDF, сканы и сложная многоязычная вёрстка.',
        'services_eyebrow' => 'Что делаю',
        'services_title'  => 'От PDF до готового многоязычного документа',
        'services_intro'  => 'Сохранить структуру и визуальную логику исходного документа после перевода — даже когда исходник неудобен для редактирования.',
        'process_eyebrow' => 'Рабочий процесс',
        'process_title'   => 'Просто передайте документ',
        'process_intro'   => 'Проектная работа и white-label сотрудничество с переводческими компаниями.',
        'audience_eyebrow'=> 'Кому',
        'audience_title'  => 'Два сценария работы',
        'cases_eyebrow'   => 'Примеры задач',
        'cases_title'     => 'Типичные проекты',
        'cases_all'       => 'Все кейсы →',
        'quote_eyebrow'   => 'Получить оценку',
        'quote_title'     => 'Есть PDF, перевод и дедлайн? Давайте посмотрим на задачу.',
        'quote_text'      => 'Для первичной оценки достаточно описания проекта и, по возможности, примера исходного документа.',
        'quote_cta'       => 'Описать проект',
        'quote_box_title' => 'Что полезно сообщить',
        'quote_box_text'  => 'Тип документа · языки · объём · исходный формат · наличие исходных файлов · срок · требования к макету.',
        'more'            => 'Подробнее →',
    );

    $en = array(
        'brand_tag'        => 'Document DTP',
        'menu_home'        => 'Document DTP',
        'menu_agencies'    => 'For agencies',
        'menu_cases'       => 'Cases',
        'menu_about'       => 'About',
        'menu_knowledge'   => 'Knowledge',
        'menu_contact'     => 'Contact',
        'menu_quote'       => 'Get a quote',
        'home_eyebrow'     => 'VERSTKADOC · DOCUMENT DTP / MULTILINGUAL FORMATTING',
        'home_title'       => 'Document DTP for translation and localization',
        'home_lead'        => 'Document preparation, reconstruction, and multilingual formatting for translation agencies, localization companies, and direct corporate clients.',
        'home_cta'         => 'Get a quote',
        'home_secondary'   => 'View services',
        'home_note'        => 'InDesign · Photoshop · Illustrator · CorelDRAW · AutoCAD · KOMPAS · SolidWorks · MicroStation. PDFs, scans, RTL and complex multilingual layouts.',
        'services_eyebrow' => 'What I do',
        'services_title'  => 'From PDF to a finished multilingual document',
        'services_intro'  => 'Preserving the structure and visual logic of the source document after translation — even when the source is difficult to edit.',
        'process_eyebrow' => 'Workflow',
        'process_title'   => 'Just send the document',
        'process_intro'   => 'Project work and white-label cooperation with translation companies.',
        'audience_eyebrow'=> 'Who it is for',
        'audience_title'  => 'Two ways to work together',
        'cases_eyebrow'   => 'Typical projects',
        'cases_title'     => 'Examples of the work',
        'cases_all'       => 'All cases →',
        'quote_eyebrow'   => 'Get an estimate',
        'quote_title'     => 'Have a PDF, translated text and a deadline? Let’s look at the task.',
        'quote_text'      => 'For an initial estimate, a short project description and, where possible, an example of the source document are enough.',
        'quote_cta'       => 'Describe the project',
        'quote_box_title' => 'Useful information',
        'quote_box_text'  => 'Document type · languages · volume · source format · source files available · deadline · layout requirements.',
        'more'            => 'Read more →',
    );

    $data = verstkadoc_is_russian() ? $ru : $en;
    return isset( $data[ $key ] ) ? $data[ $key ] : '';
}

function verstkadoc_home_text( $key ) {
    if ( function_exists( 'vd_get_home_text' ) ) {
        $value = vd_get_home_text( $key );
        if ( '' !== $value ) {
            return $value;
        }
    }

    return verstkadoc_text( $key );
}

function verstkadoc_site_option( $key, $default = '' ) {
    if ( function_exists( 'vd_get_site_setting' ) ) {
        $value = vd_get_site_setting( $key, $default );
        if ( '' !== $value && null !== $value ) {
            return $value;
        }
    }

    return $default;
}

function verstkadoc_get_services() {
    if ( function_exists( 'vd_get_services' ) ) {
        $items = vd_get_services();
        if ( ! empty( $items ) ) {
            return $items;
        }
    }

    if ( verstkadoc_is_russian() ) {
        $items = array(
            array( 'number' => 1, 'title' => 'Вёрстка после перевода', 'summary' => 'Перенос переведённого текста в существующую структуру документа.', 'url' => verstkadoc_page_url( 'uslugi/verstka-posle-perevoda' ) ),
            array( 'number' => 2, 'title' => 'Восстановление PDF', 'summary' => 'Редактируемая реконструкция сложного PDF и сканов с сохранением исходного вида.', 'url' => verstkadoc_page_url( 'uslugi/vosstanovlenie-pdf' ) ),
            array( 'number' => 3, 'title' => 'Техническая документация', 'summary' => 'Руководства, инструкции, каталоги, отчёты и инженерные документы.', 'url' => verstkadoc_page_url( 'uslugi/tehnicheskaya-dokumentatsiya' ) ),
            array( 'number' => 4, 'title' => 'CAD и чертежи', 'summary' => 'Локализация больших комплектов AutoCAD, КОМПАС, SolidWorks и MicroStation.', 'url' => verstkadoc_page_url( 'uslugi/lokalizatsiya-chertezhey-autocad' ) ),
            array( 'number' => 5, 'title' => 'Arabic / RTL', 'summary' => 'Арабский, фарси, иврит и смешанные RTL/LTR-документы.', 'url' => verstkadoc_page_url( 'uslugi/arabskaya-vertska-rtl' ) ),
            array( 'number' => 6, 'title' => 'Корпоративные документы', 'summary' => 'Финансовая и корпоративная отчётность и деловые публикации.', 'url' => verstkadoc_page_url( 'uslugi/korporativnaya-finansovaya-dokumentatsiya' ) ),
            array( 'number' => 7, 'title' => 'Книги и каталоги', 'summary' => 'Каталоги, брошюры и большие публикации до 500+ страниц.', 'url' => verstkadoc_page_url( 'uslugi/knigi-katalogi-broshury' ) ),
            array( 'number' => 8, 'title' => 'Нестандартные задачи', 'summary' => 'Когда типовой конвертер не справляется и макет приходится восстанавливать вручную.', 'url' => verstkadoc_page_url( 'uslugi' ) ),
        );
    } else {
        $items = array(
            array( 'number' => 1, 'title' => 'DTP after translation', 'summary' => 'Placing translated text back into an existing document structure.', 'url' => verstkadoc_page_url( 'services/dtp-after-translation', 'services/dtp-after-translation' ) ),
            array( 'number' => 2, 'title' => 'PDF reconstruction', 'summary' => 'Editable reconstruction of complex PDFs and scans while preserving the source appearance.', 'url' => verstkadoc_page_url( 'services/pdf-reconstruction', 'services/pdf-reconstruction' ) ),
            array( 'number' => 3, 'title' => 'Technical documentation', 'summary' => 'Manuals, instructions, catalogs, reports and engineering documents.', 'url' => verstkadoc_page_url( 'services/technical-documentation', 'services/technical-documentation' ) ),
            array( 'number' => 4, 'title' => 'CAD drawing localization', 'summary' => 'Large AutoCAD, KOMPAS, SolidWorks and MicroStation drawing sets.', 'url' => verstkadoc_page_url( 'services/cad-drawing-localization', 'services/cad-drawing-localization' ) ),
            array( 'number' => 5, 'title' => 'Arabic / RTL', 'summary' => 'Arabic, Persian, Hebrew and mixed RTL/LTR documents.', 'url' => verstkadoc_page_url( 'services/arabic-rtl-dtp', 'services/arabic-rtl-dtp' ) ),
            array( 'number' => 6, 'title' => 'Corporate documents', 'summary' => 'Financial, corporate and business documentation.', 'url' => verstkadoc_page_url( 'services/corporate-financial-medical-dtp', 'services/corporate-financial-medical-dtp' ) ),
            array( 'number' => 7, 'title' => 'Books and catalogs', 'summary' => 'Catalogs, brochures and long-form publications.', 'url' => verstkadoc_page_url( 'services/books-catalogs-brochures', 'services/books-catalogs-brochures' ) ),
            array( 'number' => 8, 'title' => 'Non-standard jobs', 'summary' => 'When an automated converter is not enough and the layout needs manual reconstruction.', 'url' => verstkadoc_page_url( 'services', 'services' ) ),
        );
    }

    return $items;
}

function verstkadoc_get_steps() {
    if ( function_exists( 'vd_get_home_steps' ) ) {
        $items = vd_get_home_steps();
        if ( ! empty( $items ) ) {
            return $items;
        }
    }

    return verstkadoc_is_russian()
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
}

function verstkadoc_get_audiences() {
    if ( function_exists( 'vd_get_home_audiences' ) ) {
        $items = vd_get_home_audiences();
        if ( ! empty( $items ) ) {
            return $items;
        }
    }

    return verstkadoc_is_russian()
        ? array(
            array( 'eyebrow' => '01 · B2B / LSP', 'title' => 'Для бюро переводов и локализации', 'summary' => 'White-label DTP как часть производственного процесса. Вы передаёте задачу — я возвращаю готовый документ.', 'button' => 'Как это работает', 'url' => verstkadoc_page_url( 'dlya-byuro-perevodov', 'for-translation-agencies' ) ),
            array( 'eyebrow' => '02 · Direct', 'title' => 'Для прямых заказчиков', 'summary' => 'Вы ставите задачу по документу, а перевод выполняет Ваш переводчик или переводческое агентство.', 'button' => 'Для прямых заказчиков', 'url' => verstkadoc_page_url( 'dlya-pryamyh-zakazchikov', 'for-direct-clients' ) ),
        )
        : array(
            array( 'eyebrow' => '01 · B2B / LSP', 'title' => 'For translation and localization agencies', 'summary' => 'White-label DTP as part of your production workflow. You send the task — I return the finished document.', 'button' => 'How it works', 'url' => verstkadoc_page_url( 'dlya-byuro-perevodov', 'for-translation-agencies' ) ),
            array( 'eyebrow' => '02 · Direct', 'title' => 'For direct clients', 'summary' => 'You commission the document work while translation is handled by your translator or translation agency.', 'button' => 'For direct clients', 'url' => verstkadoc_page_url( 'dlya-pryamyh-zakazchikov', 'for-direct-clients' ) ),
        );
}

function verstkadoc_get_cases() {
    if ( function_exists( 'vd_get_cases' ) ) {
        $items = vd_get_cases();
        if ( ! empty( $items ) ) {
            return $items;
        }
    }

    return verstkadoc_is_russian()
        ? array(
            array( 'meta' => 'Large publication', 'title' => 'Книга 500+ страниц', 'summary' => 'Восстановление и многоязычная вёрстка большого документа.', 'url' => '' ),
            array( 'meta' => 'Engineering', 'title' => 'До 300 чертежей', 'summary' => 'Массовая локализация комплектов технических чертежей.', 'url' => '' ),
            array( 'meta' => 'RTL', 'title' => 'Arabic / Persian / Hebrew', 'summary' => 'Документы с RTL, смешанными направлениями и таблицами.', 'url' => '' ),
        )
        : array(
            array( 'meta' => 'Large publication', 'title' => '500+ page book', 'summary' => 'Reconstruction and multilingual DTP of a large document.', 'url' => '' ),
            array( 'meta' => 'Engineering', 'title' => 'Up to 300 drawings', 'summary' => 'Mass localization of technical drawing sets.', 'url' => '' ),
            array( 'meta' => 'RTL', 'title' => 'Arabic / Persian / Hebrew', 'summary' => 'Documents with RTL, mixed directionality and tables.', 'url' => '' ),
        );
}

function verstkadoc_page_url( $ru_slug, $en_slug = '' ) {
    $slug = verstkadoc_is_russian() ? $ru_slug : ( $en_slug ? $en_slug : $ru_slug );
    $page = get_page_by_path( $slug, OBJECT, 'page' );

    if ( $page instanceof WP_Post ) {
        $url = get_permalink( $page );
        return $url ? $url : home_url( '/' );
    }

    return home_url( '/' . trim( $slug, '/' ) . '/' );
}

function verstkadoc_fallback_primary_menu() {
    $items = array(
        array( 'label' => verstkadoc_text( 'menu_home' ),      'url' => verstkadoc_is_russian() ? home_url( '/' ) : home_url( '/' ) ),
        array( 'label' => verstkadoc_text( 'menu_agencies' ),  'url' => verstkadoc_page_url( 'dlya-byuro-perevodov', 'for-translation-agencies' ) ),
        array( 'label' => verstkadoc_text( 'menu_cases' ),     'url' => verstkadoc_page_url( 'portfolio' ) ),
        array( 'label' => verstkadoc_text( 'menu_about' ),     'url' => verstkadoc_page_url( 'o-nas', 'about' ) ),
        array( 'label' => verstkadoc_text( 'menu_knowledge' ), 'url' => verstkadoc_page_url( 'blog' ) ),
        array( 'label' => verstkadoc_text( 'menu_contact' ),   'url' => verstkadoc_page_url( 'kontakty', 'contact' ) ),
        array( 'label' => verstkadoc_text( 'menu_quote' ),     'url' => verstkadoc_page_url( 'rasschitat-stoimost', 'get-a-quote' ), 'cta' => true ),
    );

    echo '<ul id="primary-menu" class="primary-menu">';
    foreach ( $items as $item ) {
        $class = ! empty( $item['cta'] ) ? ' class="menu-item menu-item-cta"' : ' class="menu-item"';
        printf(
            '<li%s><a href="%s">%s</a></li>',
            $class,
            esc_url( $item['url'] ),
            esc_html( $item['label'] )
        );
    }
    echo '</ul>';
}

function verstkadoc_language_links() {
    $ru_url = get_theme_mod( 'verstkadoc_ru_url', 'https://verstkadoc.ru/' );
    $en_url = get_theme_mod( 'verstkadoc_en_url', 'https://verstkadoc.com/' );
    $active = verstkadoc_is_russian() ? 'RU' : 'EN';

    echo '<div class="lang-switcher" aria-label="' . esc_attr__( 'Language', 'verstkadoc' ) . '">';
    printf( '<a class="%s" href="%s">RU</a>', 'RU' === $active ? 'active' : '', esc_url( $ru_url ) );
    printf( '<a class="%s" href="%s">EN</a>', 'EN' === $active ? 'active' : '', esc_url( $en_url ) );
    echo '</div>';
}

function verstkadoc_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    $home_label = verstkadoc_is_russian() ? 'Главная' : 'Home';
    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'verstkadoc' ) . '">';
    printf( '<a href="%s">%s</a><span aria-hidden="true">/</span>', esc_url( home_url( '/' ) ), esc_html( $home_label ) );

    if ( is_singular() ) {
        $title = get_the_title();
        printf( '<span class="current">%s</span>', esc_html( $title ) );
    } elseif ( is_archive() ) {
        $title = post_type_archive_title( '', false );
        if ( ! $title ) {
            $title = single_cat_title( '', false );
        }
        printf( '<span class="current">%s</span>', esc_html( $title ) );
    } elseif ( is_search() ) {
        $label = verstkadoc_is_russian() ? 'Поиск' : 'Search';
        printf( '<span class="current">%s</span>', esc_html( $label ) );
    } else {
        printf( '<span class="current">%s</span>', esc_html( wp_get_document_title() ) );
    }

    echo '</nav>';
}

function verstkadoc_posted_on() {
    printf(
        '<time datetime="%s">%s</time>',
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() )
    );
}
