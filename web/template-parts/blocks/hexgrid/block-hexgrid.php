<?php
/*
*  Name: Hexgrid block
*  Title: Hexgrid block
*  Description: This is an hexagon grid block
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: hexagon, companies, bedrijven
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'hexgrid';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

$args = [
    'post_type' => 'bedrijven',
    'posts_per_page' => -1,
];

$query = new WP_Query($args);

$data = [];

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        $companyName = get_the_title();
        $companyColor = get_field('color', get_the_ID());
        $companyToggle = get_field('black_white_toggle', get_the_ID());
        $companyURL = get_field('company_url', get_the_ID());


        $data[] = [
            'company_name' => $companyName,
            'company_color' => $companyColor ?: '#ccc',
            'company_toggle' => $companyToggle ? true : false,
            'companyURL' => $companyURL ?: '' ,
        ];
    }
    wp_reset_postdata();
}


?>

<section id="<?= $id; ?>" class="<?= $class; ?>">

    <div class="hexagon-grid">
    <?php 


    $index = 0;
    $row = 0;

    while ($index < count($data)) {
        echo '<div class="hexagon-grid-row">';

        $isOdd = $row % 2 !== 0;

        // Left empty wrappers
        echo str_repeat('<div class="hexagon-wrapper-empty"><div class="company-name"></div></div>', $isOdd ? 3 : 1);

        // Company wrappers
        $filled = 0;
        for ($i = 0; $i < 4; $i++) {
            if ($index < count($data)) {
                $c = $data[$index++];
                if ($c['company_toggle']) {
                    $extraClass = 'text-black';
                } else {
                    $extraClass = 'text-white';
                }

                if ($c['companyURL'] !== '') {
                    echo '<a href="'.$c['companyURL'].'" target="_blank" class="hexagon-wrapper" style="--special-color:'.$c['company_color'].';"><div class="company-name '.$extraClass.'">'.$c['company_name'].'</div></a>';
                } else {
                    echo '<div class="hexagon-wrapper" style="--special-color:'.$c['company_color'].';"><div class="company-name '.$extraClass.'">'.$c['company_name'].'</div></div>';
                }

                $filled++;
            } else {
                echo '<div class="hexagon-wrapper-empty"><div class="company-name"></div></div>';
            }
        }

        // Right empty wrappers
        echo str_repeat('<div class="hexagon-wrapper-empty"><div class="company-name"></div></div>', $isOdd ? 1 : 3);

        echo '</div>';
        $row++;
    }
    ?>
    </div>
</section>