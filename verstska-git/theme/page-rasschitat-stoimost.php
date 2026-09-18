<?php
get_header();
?>
<div class="container page-wrap">
    <?php verstkadoc_breadcrumbs(); ?>
    <article class="page-article quote-page">
        <div class="eyebrow">VERSTKADOC</div>
        <?php the_title( '<h1>', '</h1>' ); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php if ( trim( get_the_content() ) ) : ?>
                <div class="lead entry-content"><?php the_content(); ?></div>
            <?php else : ?>
                <p class="lead"><?php echo esc_html( verstkadoc_is_russian() ? 'Опишите документ, языки, объём и срок. Для первичной оценки можно приложить небольшой пример исходника.' : 'Describe the document, languages, volume and deadline. For an initial estimate, a small source sample is useful.' ); ?></p>
            <?php endif; ?>
        <?php endwhile; endif; ?>

        <div class="notice"><?php echo esc_html( verstkadoc_is_russian() ? 'Форма подготовлена как часть темы. Отправку писем и защиту от спама подключим отдельным компонентом, чтобы логика формы не зависела от темы.' : 'The form layout is included in the theme. Email delivery and anti-spam will be a separate component so the business logic stays independent of the theme.' ); ?></div>

        <form class="quote-form" action="#" method="post">
            <div class="form-grid">
                <div><label for="vd-name">Имя</label><input id="vd-name" name="name" type="text" autocomplete="name"></div>
                <div><label for="vd-email">E-mail</label><input id="vd-email" name="email" type="email" autocomplete="email"></div>
            </div>
            <div><label for="vd-type">Тип документа</label><select id="vd-type" name="type"><option>PDF</option><option>InDesign</option><option>Word</option><option>CAD</option><option>Скан</option><option>Другое</option></select></div>
            <div><label for="vd-volume">Объём</label><input id="vd-volume" name="volume" type="text"></div>
            <div><label for="vd-languages">Языки</label><input id="vd-languages" name="languages" type="text"></div>
            <div><label for="vd-message">Описание задачи</label><textarea id="vd-message" name="message" rows="6"></textarea></div>
            <button class="btn primary" type="submit">Отправить запрос</button>
        </form>
    </article>
</div>
<?php get_footer(); ?>
