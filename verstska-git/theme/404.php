<?php get_header(); ?>
<section class="page-hero error-page">
    <div class="container">
        <div class="eyebrow">404</div>
        <h1><?php echo esc_html( verstkadoc_is_russian() ? 'Страница не найдена' : 'Page not found' ); ?></h1>
        <p class="lead"><?php echo esc_html( verstkadoc_is_russian() ? 'Похоже, такой страницы пока нет или её адрес изменился.' : 'The page may not exist yet or its address may have changed.' ); ?></p>
        <div class="actions">
            <a class="btn primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( verstkadoc_is_russian() ? 'На главную' : 'Back to home' ); ?></a>
        </div>
    </div>
</section>
<?php get_footer(); ?>
