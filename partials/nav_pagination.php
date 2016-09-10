<div i-o-section>
    <?php if( get_next_posts_link() ) : ?>
        <div i-o-button="fireBrick double"><?php next_posts_link('&larr; Starsze') ?></div>
    <?php endif; ?>

    <?php if( get_previous_posts_link() ) : ?>
        <div i-o-button="fireBrick double"><?php previous_posts_link('Nowsze &rarr;') ?></div>
    <?php endif; ?>
</div>
