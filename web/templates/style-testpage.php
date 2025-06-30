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
                <h4>Header 4</h4>
                <h5>Header 5</h5>
                <h6>Header 6</h6>
            </div>
            <div class="col-6">
                <p>Headers by class</p>
                <div class="h1">Header 1</div>
                <div class="h2">Header 2</div>
                <div class="h3">Header 3</div>
                <div class="h4">Header 4</div>
                <div class="h5">Header 5</div>
                <div class="h6">Header 6</div>
            </div>
            <div class="col-12">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum nostrum nisi error.
                    Sunt est voluptate nobis nulla veniam magni, et sint atque eaque quae eveniet?
                    Quod odio similique consequatur deleniti dicta saepe accusantium! Atque, beatae.
                </p>
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
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-secondary">Secondary button</a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-success">Success button</a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-warning">Warning button</a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-danger">Danger button</a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-disabled">Disabled button</a>
            </div>
        </div>
    </div>

    <div class="container mt-30">
        <div class="row">
            <div class="col-12">
                <h2>Buttons with svg (a)</h2>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-primary">Primary button <?= svg(); ?></a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-secondary">Secondary button <?= svg(); ?></a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-success">Success button <?= svg(); ?></a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-warning">Warning button <?= svg(); ?></a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-danger">Danger button <?= svg(); ?></a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <a href="#" class="btn-disabled">Disabled button <?= svg(); ?></a>
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
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-secondary">Secondary button</button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-success">Success button</button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-warning">Warning button</button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-danger">Danger button</button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-disabled">Disabled button</button>
            </div>
        </div>
    </div>

    <div class="container mt-30">
        <div class="row">
            <div class="col-12">
                <h2>Buttons with svg (button element)</h2>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-primary">Primary button <?= svg(); ?></button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-secondary">Secondary button <?= svg(); ?></button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-success">Success button <?= svg(); ?></button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-warning">Warning button <?= svg(); ?></button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-danger">Danger button <?= svg(); ?></button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-16">
                <button class="btn-disabled">Disabled button <?= svg(); ?></button>
            </div>
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="row">
            
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="text" placeholder="text">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="password" placeholder="password">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="email" placeholder="email">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="tel" placeholder="tel">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="url" placeholder="url">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="number" placeholder="number">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="range" placeholder="range">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="date" placeholder="date">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="time" placeholder="time">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="color" placeholder="color">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="file">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="search" placeholder="search">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <label>
                    <input type="checkbox"> Checkbox
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <label>
                    <input type="radio" name="example-radio"> Radio 1
                </label><br>
                <label>
                    <input type="radio" name="example-radio"> Radio 2
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <textarea placeholder="textarea"></textarea>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <select>
                    <option value="">Select an option</option>
                    <option>Option 1</option>
                    <option>Option 2</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="datetime-local" placeholder="datetime-local">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="month" placeholder="month">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="week" placeholder="week">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="hidden" value="hidden value">
            </div>
        

            <!-- Form validation -->
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="text" class="is-valid" value="Valid input">
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="text" class="is-invalid" value="Invalid input">
                <small class="form-text text-danger">Error message</small>
            </div>

            <!-- Disabled & readonly -->
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="text" value="Disabled input" disabled>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-16">
                <input type="text" value="Readonly input" readonly>
            </div>
        </div>
    </div>

    <hr>

    <div class="container mt-30">
        <h2>Lists</h2>
        <ul>
            <li>Unordered item 1</li>
            <li>Unordered item 2</li>
        </ul>
        <ol>
            <li>Ordered item 1</li>
            <li>Ordered item 2</li>
        </ol>
    </div>

    <hr>

    <div class="container mt-30">
        <h2>Table</h2>
        <table class="table">
            <thead>
                <tr><th>#</th><th>Name</th><th>Email</th></tr>
            </thead>
            <tbody>
                <tr><td>1</td><td>Alice</td><td>alice@example.com</td></tr>
                <tr><td>2</td><td>Bob</td><td>bob@example.com</td></tr>
            </tbody>
        </table>
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