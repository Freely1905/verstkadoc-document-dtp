<?php
get_header();

$quote_url     = verstkadoc_page_url( 'rasschitat-stoimost', 'get-a-quote' );
$services_url  = verstkadoc_page_url( 'uslugi', 'services' );
$portfolio_url = verstkadoc_page_url( 'portfolio', 'cases' );
$services      = verstkadoc_get_services();
$steps         = verstkadoc_get_steps();
$audiences     = verstkadoc_get_audiences();
$cases         = verstkadoc_get_cases();
?>
<section class="hero">
    <div class="container hero-grid">
        <div>
            <div class="eyebrow"><?php echo esc_html( verstkadoc_home_text( 'home_eyebrow' ) ); ?></div>
            <h1><?php echo esc_html( verstkadoc_home_text( 'home_title' ) ); ?></h1>
            <p class="lead"><?php echo esc_html( verstkadoc_home_text( 'home_lead' ) ); ?></p>
            <div class="actions">
                <a class="btn primary" href="<?php echo esc_url( $quote_url ); ?>"><?php echo esc_html( verstkadoc_home_text( 'home_cta' ) ); ?></a>
                <a class="btn secondary" href="<?php echo esc_url( $services_url ); ?>"><?php echo esc_html( verstkadoc_home_text( 'home_secondary' ) ); ?></a>
            </div>
            <p class="note"><?php echo esc_html( verstkadoc_home_text( 'home_note' ) ); ?></p>
        </div>
        <div class="doc-stage" aria-hidden="true">
            <div class="sheet back"></div>
            <div class="sheet mid"></div>
            <div class="sheet front">
                <div class="kicker"><?php echo esc_html( verstkadoc_home_text( 'doc_kicker' ) ); ?></div>
                <div class="bar"></div>
                <div class="doc-title"><?php echo wp_kses_post( nl2br( esc_html( verstkadoc_home_text( 'doc_title' ) ) ) ); ?></div>
                <div class="lines"><i></i><i></i><i></i><i></i></div>
                <div class="table"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow"><?php echo esc_html( verstkadoc_home_text( 'services_eyebrow' ) ); ?></div>
                <h2><?php echo esc_html( verstkadoc_home_text( 'services_title' ) ); ?></h2>
            </div>
            <p><?php echo esc_html( verstkadoc_home_text( 'services_intro' ) ); ?></p>
        </div>
        <div class="grid4">
            <?php foreach ( $services as $service ) : ?>
                <article class="card">
                    <div class="icon"><?php echo esc_html( $service['number'] ); ?></div>
                    <h3><?php echo esc_html( $service['title'] ); ?></h3>
                    <p><?php echo esc_html( $service['summary'] ); ?></p>
                    <a class="link" href="<?php echo esc_url( $service['url'] ); ?>"><?php echo esc_html( verstkadoc_home_text( 'more' ) ); ?></a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow"><?php echo esc_html( verstkadoc_home_text( 'process_eyebrow' ) ); ?></div>
                <h2><?php echo esc_html( verstkadoc_home_text( 'process_title' ) ); ?></h2>
            </div>
            <p><?php echo esc_html( verstkadoc_home_text( 'process_intro' ) ); ?></p>
        </div>
        <div class="steps">
            <?php foreach ( $steps as $step ) : ?>
                <div class="step">
                    <div class="num"><?php echo esc_html( $step['number'] ); ?></div>
                    <h3><?php echo esc_html( $step['title'] ); ?></h3>
                    <p><?php echo esc_html( $step['summary'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow"><?php echo esc_html( verstkadoc_home_text( 'audience_eyebrow' ) ); ?></div>
                <h2><?php echo esc_html( verstkadoc_home_text( 'audience_title' ) ); ?></h2>
            </div>
        </div>
        <div class="aud">
            <?php foreach ( $audiences as $audience ) : ?>
                <article class="box">
                    <div class="eyebrow"><?php echo esc_html( $audience['eyebrow'] ); ?></div>
                    <h3><?php echo esc_html( $audience['title'] ); ?></h3>
                    <p><?php echo esc_html( $audience['summary'] ); ?></p>
                    <a class="btn secondary" href="<?php echo esc_url( $audience['url'] ); ?>"><?php echo esc_html( $audience['button'] ); ?></a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow"><?php echo esc_html( verstkadoc_home_text( 'cases_eyebrow' ) ); ?></div>
                <h2><?php echo esc_html( verstkadoc_home_text( 'cases_title' ) ); ?></h2>
            </div>
            <a class="link" href="<?php echo esc_url( $portfolio_url ); ?>"><?php echo esc_html( verstkadoc_home_text( 'cases_all' ) ); ?></a>
        </div>
        <div class="cases">
            <?php foreach ( $cases as $case ) : ?>
                <article class="case">
                    <div class="case-v"><div class="mini"></div></div>
                    <div class="case-c">
                        <div class="meta"><?php echo esc_html( $case['meta'] ); ?></div>
                        <h3>
                            <?php if ( ! empty( $case['url'] ) ) : ?><a href="<?php echo esc_url( $case['url'] ); ?>"><?php endif; ?>
                            <?php echo esc_html( $case['title'] ); ?>
                            <?php if ( ! empty( $case['url'] ) ) : ?></a><?php endif; ?>
                        </h3>
                        <p><?php echo esc_html( $case['summary'] ); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="quote">
    <div class="container quote-grid">
        <div>
            <div class="eyebrow"><?php echo esc_html( verstkadoc_home_text( 'quote_eyebrow' ) ); ?></div>
            <h2><?php echo esc_html( verstkadoc_home_text( 'quote_title' ) ); ?></h2>
            <p><?php echo esc_html( verstkadoc_home_text( 'quote_text' ) ); ?></p>
            <div class="actions">
                <a class="btn secondary" href="<?php echo esc_url( $quote_url ); ?>"><?php echo esc_html( verstkadoc_home_text( 'quote_cta' ) ); ?></a>
            </div>
        </div>
        <aside class="quote-box">
            <strong><?php echo esc_html( verstkadoc_home_text( 'quote_box_title' ) ); ?></strong>
            <p><?php echo esc_html( verstkadoc_home_text( 'quote_box_text' ) ); ?></p>
        </aside>
    </div>
</section>
<?php get_footer(); ?>
