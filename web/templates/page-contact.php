<?php
/*
Template Name: Contact pagina
Template Post Type: page
*/

get_header();
?>

<main>
    <?php if (get_field('hero_image')) : ?>
        <div class="page-hero-image-wrapper">
            <div class="hero-image" style="--imageURL: url('<?= wp_get_attachment_image_url(get_field('hero_image'), 'full'); ?>')"></div>
            <div class="contactpage-coworker-view">
                <?php
                $coworkers = get_field('show_coworkers');
                if ($coworkers) :
                    $group_sizes = [4, 3, 2, 1];
                    $group_index = 0;
                    $current_index = 0;

                    while ($current_index < count($coworkers)) :
                        $size = $group_sizes[$group_index % count($group_sizes)];
                        $row_items = array_slice($coworkers, $current_index, $size);

                        $offset_map = [
                            4 => 0,
                            3 => 1,
                            2 => 3,
                            1 => 4,
                        ];
                        $offset = $offset_map[$size] ?? 0;
                        ?>

                        <div class="row small-gutters justify-content-center">
                            <?php foreach ($row_items as $i => $coworker) :
                                $name = get_field('name', $coworker);
                                $function_name = get_field('function_name', $coworker);
                                $image = get_field('image', $coworker);

                                $offset_class = ($i === 0 && $offset > 0) ? 'offset-lg-' . $offset : '';

                                $corner_class = '';
                                if ($size === 1) {
                                    $corner_class = 'corner-both';
                                } elseif ($i === 0) {
                                    $corner_class = 'corner-bl';
                                } elseif ($i === $size - 1) {
                                    $corner_class = 'corner-tr';
                                }
                                ?>
                                <div class="col-6 col-lg-3 mt-16 <?= $offset_class ?>">
                                    <div class="contactpage-coworker-wrapper <?= $corner_class ?>">
                                        <div class="image-wrapper">
                                            <?= wp_get_attachment_image($image, null, false, ["class" => "", "alt" => ""]); ?>
                                        </div>
                                        <div class="coworker-text-wrapper">
                                            <h2><?= $name; ?></h2>
                                            <p><?= $function_name; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <?php
                        $current_index += $size;
                        $group_index++;
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php the_content(); ?>
</main>

<?php get_footer(); ?>
