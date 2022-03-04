<div class="archive-hero">
    <div class="archive-hero-container">

        <? if (have_posts()) : ?>
            <header>
                <? if (get_search_query() == '') : // Пустой запрос ?>
                    <h1><?php echo 'Поиск'; ?></h1>
                    <br/>
                    <? get_search_form(); ?>
                <? else : // Есть посты по запросу ?>
                    <h1><? printf(__('Результаты поиска: %s'), '<span>' . get_search_query() . '</span>'); ?></h1>
                    <br/>
                    <? get_search_form(); ?>
                <? endif; ?>
            </header>
        <? else : // По запросу не найдено ?>
            <header>
                <h1><? printf(__('По запросу: %s'), '<span>' . get_search_query() . '</span>'); ?></h1>
                <p>Ничего не найдено, попробуйте еще раз.</p>
                <br/>
                <? get_search_form(); ?>
            </header>
        <? endif; ?>

    </div>
</div>