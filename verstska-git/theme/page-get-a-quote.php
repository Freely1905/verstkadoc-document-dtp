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
                <p class="lead">Describe the document, languages, volume and deadline. For an initial estimate, a small source sample is useful.</p>
            <?php endif; ?>
        <?php endwhile; endif; ?>

        <div class="notice"><?php echo esc_html( 'The form layout is included in the theme. Email delivery and anti-spam will be a separate component so the business logic stays independent of the theme.' ); ?></div>

        <form class="quote-form" action="#" method="post">
            <div class="form-grid">
                <div><label for="vd-name">Name</label><input id="vd-name" name="name" type="text" autocomplete="name"></div>
                <div><label for="vd-email">E-mail</label><input id="vd-email" name="email" type="email" autocomplete="email"></div>
            </div>
            <div><label for="vd-type">Document type</label><select id="vd-type" name="type"><option>PDF</option><option>InDesign</option><option>Word</option><option>CAD</option><option>Scan</option><option>Other</option></select></div>
            <div><label for="vd-volume">Volume</label><input id="vd-volume" name="volume" type="text"></div>
            <div><label for="vd-languages">Languages</label><input id="vd-languages" name="languages" type="text"></div>
            <div><label for="vd-message">Project description</label><textarea id="vd-message" name="message" rows="6"></textarea></div>
            <button class="btn primary" type="submit">Send request</button>
        </form>
    </article>
</div>
<?php get_footer(); ?>
