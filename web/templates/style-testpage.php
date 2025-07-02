<?php
/*
Template Name: Test Pages
Template Post Type: page
*/

get_header();

function svg() {
    return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 112c-8.8 0-16 7.2-16 16l0 22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1l0-22.1c0-8.8-7.2-16-16-16L64 112zM48 212.2L48 384c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-171.8L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64l384 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128z"/></svg>';
}


$hasContent = !empty( get_the_content() );

?>

<main>
    <div class="container text-center my-30">
        <h1>Test page for styling</h1>
    </div>

    <?php if ($hasContent) : ?>
        <a href="#content">Check added blocks</a>
    <?php endif; ?>
    
    <div class="container mt-30">
        <div class="row">
            <div class="col-6">
                <p>Real headers</p>
                <h1>Header 1</h1>
                <h2>Header 2</h2>
                <h3>Header 3</h3>
            </div>
            <div class="col-6">
                <div class="col-12">
                    <p>Headers by class</p>
                    <div class="h1">Header 1</div>
                    <div class="h2">Header 2</div>
                    <div class="h3">Header 3</div>
                </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum nostrum nisi error.
                        Sunt est voluptate nobis nulla veniam magni, et sint atque eaque quae eveniet?
                        Quod odio similique consequatur deleniti dicta saepe accusantium! Atque, beatae.
                    </p>
            </div>
        </div>
    </div>

    <div class="container mt-30">
        <div class="row">
            <div class="col-6">
                <h1>All used SVG's</h1>
                <?php 
                
                    $directory = get_template_directory() . '/src/images/icons/';
                    $svgFiles = glob($directory . '/*.svg');
                    
                    foreach ($svgFiles as $filePath) {
                        $filename = pathinfo($filePath, PATHINFO_FILENAME);
                        $x = get_template_directory_uri() . '/src/images/icons/' . $filename;
                        echo '<img width="80" height="80" src="'.$x.'.svg" alt="'.$filename.'">';
                    }

                ?>
            </div>
        </div>
    </div>
    
    <hr>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Buttons (a)</h2>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-primary">Primary button</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Buttons (button element)</h2>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-primary">Primary button</button>
            </div>
        </div>
    </div>


    <hr>


<div class="hexagon-grid">
<?php 
$data = [
    ["company_name" => "company 1", "company_color" => "blue"],
    ["company_name" => "company 2", "company_color" => "red"],
    ["company_name" => "company 3", "company_color" => "orange"],
    ["company_name" => "company 4", "company_color" => "pink"],
    ["company_name" => "company 5", "company_color" => "green"],
    ["company_name" => "company 6", "company_color" => "purple"],
    ["company_name" => "company 7", "company_color" => "yellow"],
    ["company_name" => "company 8", "company_color" => "cyan"],
    ["company_name" => "company 9", "company_color" => "magenta"],
    ["company_name" => "company 10", "company_color" => "teal"],
    ["company_name" => "company 11", "company_color" => "lime"],
    ["company_name" => "company 12", "company_color" => "indigo"],
    // ["company_name" => "company 13", "company_color" => "gray"],
    // ["company_name" => "company 14", "company_color" => "brown"],
    // ["company_name" => "company 15", "company_color" => "maroon"],
    // ["company_name" => "company 16", "company_color" => "navy"],
    // ["company_name" => "company 17", "company_color" => "olive"],
    // ["company_name" => "company 18", "company_color" => "coral"],
    // ["company_name" => "company 19", "company_color" => "gold"],
    // ["company_name" => "company 20", "company_color" => "silver"],
    // ["company_name" => "company 21", "company_color" => "beige"],
    // ["company_name" => "company 22", "company_color" => "lavender"]
];

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
            echo '<div class="hexagon-wrapper" style="--special-color:'.$c['company_color'].';"><div class="company-name">'.$c['company_name'].'</div></div>';
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






    <hr>

    <div class="container">
        <div class="row">
            
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="text" placeholder="Voorbeeld...">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <textarea placeholder="Dit is een voorbeeld tekst..."></textarea>
            </div>
        </div>
    </div>

    <hr>

    <div class="container mt-30">
        <h2>Lists</h2>
        <ul class="ul">
            <li>Unordered item 1</li>
            <li>Unordered item 2</li>
        </ul>
    </div>

    <hr>

    <div class="container mt-30">
        <h2>Typography & Inline Elements</h2>
        <p>This is <strong>strong</strong>, <em>emphasized</em>, <u>underlined</u>, and <a href="#">a link</a>.</p>
        <blockquote>A blockquote example for style testing.</blockquote>
        <p><code>Inline code sample</code></p>
        <pre><code>Preformatted text
        with multiple lines</code></pre>
    </div>

    <hr>

    <div class="container mt-30">
        <h2>Loading / Spinner</h2>
        <div class="spinner">Loading...</div>
    </div>

    <?php if ($hasContent) : ?>
        <div class="mt-120" id="content">
            <?php the_content(); ?>
        </div>
    <?php endif; ?>
</main>




<?php get_footer(); ?>